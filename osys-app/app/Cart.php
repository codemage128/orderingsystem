<?php namespace App;
use Illuminate\Support\Facades\Session;

class Cart {
	public $menu_id;
	public $quantity;
	
	public function addToCart()
	{
		$isNewItem = true;
		
		if(Session::get('cart')!=NULL)
		{
			foreach(Session::get('cart') as $k=>$v)
			{
				if($v['menu_id']==$this->menu_id)
				{
					Session::put('cart.'.$k.'.quantity', $v['quantity'] + $this->quantity);
					$isNewItem = false;
					break;
				}
			}
		}
		
		if($isNewItem)
		{
			$item['menu_id'] = $this->menu_id;
			$item['quantity'] = $this->quantity;
			Session::push('cart',$item);
		}
	}
	
	public function removeAllCart()
	{
		Session::forget('cart');
	}
	
	public function removeCartLine($key)
	{
		Session::forget('cart.'.$key);
	}
	
	public function getCartList()
	{
		$list = Session::get('cart');
		if(!isset($list))
			return NULL;
		
		$data = array();
		$index = 0;
		foreach($list as $key=>$value)
		{
			$data[$index]['key'] = $key;
			$data[$index]['menu_id'] = $value['menu_id'];
			$data[$index]['quantity'] = $value['quantity'];
			
			$menu = Menu::select('id','name','price')->find($value['menu_id']);
			
			$data[$index]['name'] = $menu->name;
			$data[$index]['price'] = $menu->price;
			$data[$index]['total'] = $menu->price * $value['quantity'];
			$data[$index]['picture'] = $menu->getFirstPictureUrl();
			$index++;
		}
		
		return $data;
	}
	
	public function getTotalPrice()
	{
		$list = Session::get('cart');
		if(!isset($list))
			return 0;
		
		$sum = 0;
		foreach($list as $item)
		{
			$menu = Menu::select('price')->find($item['menu_id']);
			$sum += $menu->price * $item['quantity'];
		}
		
		return $sum;
	}
}