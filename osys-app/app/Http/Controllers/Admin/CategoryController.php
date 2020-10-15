<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller {

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
		return view('admin.category.index', [
			'categories' => Category::get(),
		]);
	}
	
	public function getSave($id, $name)
	{
		if($id == 0)
		{
			$category = new Category;
		}
		else
		{
			$category = Category::find($id);
		}
		
		$category->name = $name;
		$category->save();
		
		return $category->toJson();
	}
}
