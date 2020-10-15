<?php namespace App\Http\Controllers;
use App\Menu;
use App\Cart;
use App\Customer;
use App\Order;
use App\Status;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class CartController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('guest');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getList()
	{
		view()->share('title', 'My Cart');
	
		$cart = new Cart;
		$list = $cart->getCartList();
		
		return view('cart.list', array(
			'list'=>$list,
			'totalPrice'=>$cart->getTotalPrice(),
		));
	}
	
	public function getConfirm()
	{
		view()->share('title', 'Confirm');
		
		$cart = new Cart;
		$list = $cart->getCartList();
		
		return view('cart.confirm', array(
			'list'=>$list,
			'totalPrice'=>$cart->getTotalPrice(),
		));
	}
	
	public function postConfirm(Request $req)
	{
		$this->validate($req, [
			'email' => 'required|email',
		]);

		view()->share('title', 'Success!!!');
		
		$customer = new Customer;
		$customer_id = $customer->getCustomerID($req->get('email'));
		$status_id = Status::getIDByName('Requested');
		$cart = new Cart;
		if( !empty($req->get('_token')) ){
			foreach($cart->getCartList() as $item)
			{
				$order = Order::where('customer_id','=',$customer_id)->where('menu_id','=',$item['menu_id'])->where('status_id','=',$status_id)->first();
				// If unmanaged order of the menu for the current customer remains in order table, update the quantity
				if($order != NULL)
				{
					$order->quantity += $item['quantity'];
				}
				// else create new order of the menu in order table
				else
				{
					$order = new Order;
					$order->customer_id = $customer_id;
					$order->menu_id = $item['menu_id'];
					$order->quantity = $item['quantity'];
					$order->status_id = $status_id;
				}
				$order->save();
				
				$menu = Menu::find($item['menu_id']);
				$menu->rating += $item['quantity'];
				$menu->save();
			}
			
			$cart->removeAllCart();
			
			return view('cart.success');
		}
	}
	
	public function getRemove($key)
	{
		$cart = new Cart;
		$cart->removeCartLine($key);
		return Redirect::to('/cart/list');
	}
	
	/**
	 * Ajax action
	 */
	public function getAdd($menu_id, $quantity = 1)
	{
		$cart = new Cart();
		$cart->menu_id = $menu_id;
		$cart->quantity = $quantity;
		$cart->addToCart();
	}

}
