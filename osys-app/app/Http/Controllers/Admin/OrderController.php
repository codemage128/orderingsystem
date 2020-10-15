<?php namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Status;
use App\Customer;
use App\Order;

class OrderController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getIndex()
	{
		$customers = Customer::get();
		$data = array();
		$index = 0;
		foreach($customers as $customer)
		{
			$item = $customer->getOrderList();
			
			if(!empty($item->first()))
			{
				$data[$index]['id'] = $customer->id;
				$data[$index]['email'] = $customer->email;
				$data[$index]['update_datetime'] = $item->first()->update_datetime;
				$index++;
			}
		}
		return view('admin.order.index', array(
			'data' => $data,
		));
	}
	
	public function getReply($id)
	{
		$customer = Customer::find($id);
		
		$data = array();
		$index = 0;
		$sum = 0;
		foreach($customer->getOrderList() as $order)
		{
			$menu = $order->getMenu();
			$data[$index]['name'] = $menu->name;
			$data[$index]['category'] = $menu->getCategory();
			$data[$index]['price'] = $menu->price;
			$data[$index]['quantity'] = $order->quantity;
			$data[$index]['total'] = $menu->price * $order->quantity;
			$sum += $data[$index]['total'];
			$index++;
		}
		
		return view('admin.order.reply', array(
			'customer' => $customer,
			'data' => $data,
			'sum' => $sum,
		));
	}
	
	public function postReply(Request $req)
	{
		if(!empty($req->get('_token')))
		{
			$customer = Customer::find($req->get('customer_id'));
			$status_id = Status::getIDByName('Response');
			foreach($customer->getOrderList() as $order)
			{
				$order->status_id = $status_id;
				$order->save();
			}
			return Redirect::to('/admin/order');
		}
	}
	
	public function getHistory(Request $req)
	{
		$page = $req->get('page');
		$sort = $req->get('sort');
		$type = $req->get('type');
		$req->request->set('page', $page);
		
		if(isset($sort))
		{
			if($type)
				$by = 'asc';
			else
				$by = 'desc';
			$orders = Order::where('status_id','=',Status::getIDByName('Response'))->orderBy($sort, $by)->paginate(config('app.perpage'));
		}
		else
		{
			$orders = Order::where('status_id','=',Status::getIDByName('Response'))->paginate(config('app.perpage'));
		}
				
		$orders->setPageName('page');
		$orders->setPath(url('/admin/order/history'));
		
		return view('admin.order.history', array(
			'orders' => $orders,
			'sort' => $sort,
			'type' => $type,
			'indexOffset' =>($page==0?0:$page-1)*config('app.perpage'),
		));
	}
}
