<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Status;
use App\User;

class ItemController extends Controller
{
    public function showItems() {
        $items = Item::all();
        $categories = Category::all();
        // $orders = Order::all();
        /*soft deleted models will automatically be excluded from query results. 
        However, you may force soft deleted models to appear in a result */
        $orders = Order::withTrashed()->get();
        return view('items.catalog', compact(['items', 'categories', 'orders']));
    }

    public function itemDetails($id) {
        //enclosed in try catch to be able to clear cart after dropping database so i can forget session cart
        try {
            $item = Item::find($id);
            $category = Category::find($item->category_id);
            $category = $category->name;
            return view("items.item_details", compact(['item', 'category']));
        } catch(\Exception $e) {
            Session::forget('cart');
            return back();
        }
    }

    public function showAddItemForm() {
    	$categories = Category::all();
    	return view("items.add_item", compact("categories"));
    }

    public function saveNewItem(Request $request) {
        // dd($request);
    	$rules = array(
    		"name"=> "required",
    		"description"=>"required",
    		"price"=>"required|numeric",
    		"image"=>"required|image|mimes:jpeg,jpg,gif,svg|max:2048"
    	);

    	//to validate
    	$this->validate($request, $rules);
    	//if validation fails, it would not proceed to the next step

    	$item = new Item;
    	$item->name =$request->name;
    	$item->description=$request->description;
    	$item->price=$request->price;
    	$item->category_id=$request->category;

        // image argument came from the name attribute of our form
    	$image=$request->file('image');
        //returns time/seconds since epoch unix
        // getClientOriginalExtension() returns file extension
    	$image_name=time(). "." .$image->getClientOriginalExtension();
    	$destination = "images/";

        //move(destination_path, file_name)
    	$image->move($destination, $image_name);

    	$item->image_path=$destination.$image_name;
    	$item->save();

    	Session::flash("success_message","$item->name was successfully added!");
    	return back();
    }

    public function editItem($id, Request $request) {
        $item = Item::find($id);

        //validations
        $rules = array(
            'name'=>'required',
            'description'=>'required',
            'price'=>"required|numeric",
            'image'=>"image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        );

        $this->validate($request,$rules);
        $item->name = $request->name;
        $item->description=$request->description;
        $item->price=$request->price;
        $item->category_id=$request->category;

        if($request->file('image')!=null) { //if i uploaded an image
            $image=$request->file('image');
            $image_name=time().".".$image->getClientOriginalExtension();
            $destination="images/";
            $image->move($destination,$image_name);
            $item->image_path=$destination.$image_name;
        }

        $item->save();
        Session::flash("success_message","Changes made to $item->name have been successfully saved!");
        return redirect("/menu/$id");
    }

    public function showEditForm($id, Request $request){
        $item = Item::find($id);
        $categories = Category::all();
        return view("items.edit_form", compact(['item', 'categories']));
    }

    public function deleteItem($id) {
        $item = Item::find($id);
        $item->delete();
        Session::flash('success_message', "$item->name has been successfully deleted!");
        return redirect("/catalog");
    }


    //request = since you're expecting input from a route parameter
    public function addToCart($id, Request $request) {

        if ($request->quantity == 0) {
            $item = Item::find($id);
            Session::flash("error_message", "Please indicate the quantity of $item->name before adding to cart!");
            return back();
        }
        //if there is an existing cart, get it. if none, initialize it
        if(Session::has('cart')) {
            $cart = Session::get('cart'); //get method
        } else {
            $cart = []; //initialize session
        }

        //if item in cart already has quantity, add to it. if none, assign to quantity
        if(isset($cart[$id])) {
            $cart[$id] += $request->quantity; //addition assignment operator; add value to variable
        } else {
            $cart[$id] = $request->quantity; //asignment operator; assign value to variable
        }

        //put the cart in a session
        Session::put('cart', $cart); //this is the traditional session; PUT == store item in session

        // dd(Session::get('cart'));
        $item = Item::find($id);

        if($request->quantity > 1){
            Session::flash("success_message","$request->quantity $item->name were added successfully saved!");
        } else {
            Session::flash("success_message","$request->quantity $item->name was added successfully saved!");
        }
        return redirect("/catalog");
    }

    public function showCart() {
        $item_cart = [];
        $total = 0; 
        
        $lineItems = [];
        $user = Auth::user();

        try {
            $cart = Session::get('cart');

            foreach($cart as $id => $quantity) {
                $item = Item::find($id);
                // dd($item);
                $item->quantity=$quantity; 
                $item->subtotal = 
                $item->price * $quantity; 

                $total += $item->subtotal;
                $item_cart[] = $item;

                //gather details of ordered items into an array
                $lineItems[] = [
                    'name' => $item->name,
                    'description' => $item->description,
                    'images' => ['https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png'],
                    // 'images' => [ $item->image], //pag naka live
                    'amount' => str_replace(".", "", $item->price),
                    'currency' => 'usd',
                    'quantity' => (int)$quantity,
                ];
               
            }

                
            //set the api key for stripe
            \Stripe\Stripe::setApiKey('sk_test_EWR9FtmaOVnCrrrPrih3iIAd00ennTPY2A');

            //create stripe session and pass ordered items and other details
            //stripe will then provide us with an id that we can use as reference for the payment
            $stripe_session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => $user->email,
                'line_items' => $lineItems,
                // 'success_url' => 'https://example.com/success',
                'success_url' => 'http://127.0.0.1:8000/transaction_complete',
                'cancel_url' => 'https://example.com/menu/mycart',
            ]);
            
            //assign returned session id of stripe to a variable and return it to cart content
            $CHECKOUT_SESSION_ID = $stripe_session['id'];
            // dd($CHECKOUT_SESSION_ID);
            return view("items.cart_content", compact("item_cart", "total", "CHECKOUT_SESSION_ID"));
        } catch (\Exception $e) {
            return view("items.cart_content", compact("item_cart", "total"));
        }
    }

    public function deleteCartItem($id) {
        // we want to remove the specific id in the Session 'cart'
        $item = Item::find($id);
        Session::forget("cart.$id"); //this is the same as cart[$id];
        Session::flash('success_message', "$item->name has been successfully deleted from your cart!");

        if(Session::get('cart') != []) {
            return back();
        } else {
            Session::forget('cart');
            return redirect('/catalog');
        }
    }

    public function clearCart() {
        Session::forget("cart");
        Session::flash("success_message", "Your cart is now empty!");
        return redirect("/catalog");
    }

    public function changeItemQuantity($id, Request $request) {
        $cart = Session::get('cart');
        $cart[$id] = $request->quantity;
        Session::put("cart", $cart);
        return redirect("/menu/mycart");
    }

    public function checkout() {
        //users can manually edit url to transaction complete to bypass stripe payment hence...
        // ==================================================================================
        // as suggested by stripe, we can manually update order status to pending for review and confirmation by seller/admin
        $order = new Order;
        //we need to make sure that the user that's trying to checkout is logged in. else, we would encounter an error with Auth::user
        $order->user_id = Auth::user()->id;
        $order->status_id = 1; //all orders should have a default status pending
        $order->total = 0;
        $order->save();

        $total=0;
            // dd($order);
            // dd(Session::get('cart'));
        foreach(Session::get('cart') as $item_id => $quantity) {
            // dd(Session::get('cart'));
            // dd($order);

            //items()->attach() is a function that allows us to insert the item to the item_order table for that specific order_id along with any other columns that we want to include, in this case, the quantity column
            $order->items()->attach($item_id, ['quantity'=>$quantity]);
            //attach means insert to the pivot table
            //syntax attach(yung other fk, [other columns we want to include in the associative array])

            //update order total
            $item = Item::find($item_id);
            $total += $item->price * $quantity;
        }
        //save the the total to the current order
        $order->total = $total;
        $order->save();
 
        //remove the current session  cart and return to catalog
        Session::forget('cart');
        return view('orders.order_confirmation', compact('order'));
        // return a view page that displays transaction summary, transaction number and thank you message.
    }


    public function showOrders() {
        //1.) all orders, excluding soft deleted ones
        $orders = Order::all();

        //2.) all orders, including soft deleted ones
        // $orders = Order::onlyTrashed()->get(); //for admin

        //3.) orders of signed-in user, inclusing soft deleted ones
        // $orders=Order::withTrashed()->where("orders.user_id", Auth::user()->id)->get(); 
       
        $statuses = Status::all();
        $users = User::all();
        return view("orders.order_history", compact("orders", "statuses", "users"));
    }

    public function changeOrderStatus ($id, Request $request) {
        $status = Status::find($request->new_order_status); 
        // $order = Order::where('id', $id)
        //         ->first(); //get method returns a collection
        $order = Order::find($id);
        $order->status_id = $status->id;
        $order->save();
        Session::flash("success_message", "Order #$order->id is now set to $status->status_name!");
        return back();
    }

    public function deleteOrder($id) {
        // dd($id);
        $order = Order::find($id);
        $order->delete();
        return back()
        ->with('delete_message', "Order #$id has been successfully deleted!")
        ->with('undo_url', "/restore_order/$id");
    }

    public function restoreOrder($id){
        $order = Order::onlyTrashed()->where('id', $id)->first();
        // dd($order);
        $order->restore();
        Session::flash("success_message", "Order #$order->id has been restored!");
        return back();
    }

}
