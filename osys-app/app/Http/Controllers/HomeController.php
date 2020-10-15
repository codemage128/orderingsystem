<?php namespace App\Http\Controllers;
use App\Menu;

class HomeController extends Controller {
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
	public function index()
	{
		view()->share('title', 'Home');
		
		$menu = new Menu;
		return view('home',array(
			'menus' => $menu->getThreeHighestRatingMenu(),
		));
	}
}
