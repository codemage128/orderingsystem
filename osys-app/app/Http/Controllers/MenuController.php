<?php namespace App\Http\Controllers;
use App\Menu;
use App\Category;

class MenuController extends Controller {
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
	public function getSearch()
	{
		view()->share('title', 'Search');
		
		return view('menu.search',array(
			'categories'=>Category::get(),
		));
	}
	
	public function getDetail($id)
	{
		view()->share('title', 'Detail');
		
		$menu = Menu::find($id);
		return view('menu.detail', array(
			'menu'=>$menu
		));
	}
	
	/**
	 * @return string
	 */
	public function getJsondata()
	{
		$menu = new Menu;
		return $menu->getMenuJsonData();
	}

}
