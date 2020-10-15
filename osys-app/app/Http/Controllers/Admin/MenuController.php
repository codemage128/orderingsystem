<?php namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Category;
use App\Picture;
use App\MenuPicture;

class MenuController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getIndex(Request $req)
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
			$menus = Menu::popular()->orderBy($sort,$by)->paginate(config('app.perpage'));
		}
		else
		{
			$menus = Menu::popular()->paginate(config('app.perpage'));
		}
		
		$menus->setPageName('page');
		$menus->setPath(url('/admin/menu'));
		return view('admin.menu.index', array(
			'menus' => $menus,
			'sort' => $sort,
			'type' => $type,
		));
	}
	
	public function getCreate()
	{
		return view('admin.menu.create',array(
			'categories'=>Category::get(),
		));
	}
	
	public function postCreate(Request $req)
	{
		$data = $req->get('data');
		$menu = new Menu;
		$menu->category_id = $data['category_id'];
		$menu->name = $data['name'];
		$menu->price = $data['price'];
		$menu->description = $data['description'];
		
		$this->validate($req, [
			'data.category_id' => 'required',
			'data.name' => 'required|max:64',
			'data.price' => 'required|numeric',
		]);
		$menu->save();
		
		$pictures = $req->get('picture');
		if(isset($pictures))
		{
			$index = 0;
			foreach($pictures as $picture)
			{
				$menuPicture = new MenuPicture;
				$menuPicture->menu_id = $menu->id;
				$menuPicture->picture_id = $picture;
				$menuPicture->disp_order = $index;
				$menuPicture->save();
				$index++;
			}
		}

		/*
		if($req->hasFile('file'))
		{
			$file = $req->file('file');
			$fileName = time().'.'.$file->getClientOriginalExtension();
			try{
				$file->move('./uploaded', $fileName);
				$picture_id = Picture::firstOrCreate(['url'=>$fileName])->id;
				
				$menuPicture = new MenuPicture;
				$menuPicture->menu_id = $menu->id;
				$menuPicture->picture_id = $picture_id;
				$menuPicture->save();
			} catch(Exception $e) {
			}
		}
		*/

		return Redirect::to('/admin/menu');
	}
	
	public function getEdit($id)
	{
		return view('admin.menu.edit',array(
			'menu'=>Menu::find($id),
			'categories'=>Category::get(),
		));
	}
	
	public function postEdit(Request $req)
	{
		$data = $req->get('data');
		$menu = Menu::find($data['id']);
		$menu->category_id = $data['category_id'];
		$menu->name = $data['name'];
		$menu->price = $data['price'];
		$menu->description = $data['description'];
		$this->validate($req, [
			'data.category_id' => 'required',
			'data.name' => 'required|max:64',
			'data.price' => 'required|numeric',
		]);		
		$menu->save();
		
		$pictures = $req->get('picture');
		if(isset($pictures))
		{
			$index = 0;
			$menuPictures = $menu->getPictures();
			foreach($menuPictures as $menuPicture)
			{
				$menuPicture->disp_order = $index;
				$menuPicture->save();
				$index++;
			}
			
			foreach($pictures as $picture)
			{
				$menuPicture = new MenuPicture;
				$menuPicture->menu_id = $menu->id;
				$menuPicture->picture_id = $picture;
				$menuPicture->disp_order = $index;
				$menuPicture->save();
				$index++;
			}
		}
		
		/*
		if($req->hasFile('file'))
		{
			$file = $req->file('file');
			$fileName = time().'.'.$file->getClientOriginalExtension();
			try{
				$file->move('./uploaded', $fileName);
				$picture_id = Picture::firstOrCreate(['url'=>$fileName])->id;
				
				$menuPicture = MenuPicture::where('menu_id','=',$menu->id)->first();
				$isUpdate = true;
				
				if($menuPicture == NULL)
				{
					$isUpdate = false;
					$menuPicture = new MenuPicture;
					$menuPicture->menu_id = $menu->id;
				}
				
				if($isUpdate)
				{
					$picture = Picture::find($menuPicture->picture_id);
					unlink('./uploaded/'.$picture->url);
				}
				
				$menuPicture->picture_id = $picture_id;
				$menuPicture->save();
				
				if($isUpdate)
				{
					$picture->delete();
				}
				
			} catch(Exception $e) {
			}
		}
		*/
		return Redirect::to('/admin/menu');
	}
	
	public function getDelete($id)
	{
		$menu = Menu::find($id);
		$menu->deleted = true;
		$menu->save();
	}
	
	public function postUpload(Request $req)
	{
		if($req->hasFile('picture'))
		{
			$file = $req->file('picture');
			$fileName = time().'.'.$file->getClientOriginalExtension();
			try{
				$file->move('./uploaded', $fileName);
				$picture = Picture::firstOrCreate(['url'=>$fileName]);
				return json_encode([
					'id'=>$picture->id,
					'url'=>asset('/uploaded/'.$picture->url),
				]);
			} catch(Exception $e) {
			}
		}
	}
	
	public function getDeletepicture($id) {
		$picture = Picture::find($id);
		unlink('./uploaded/'.$picture->url);
		$picture->delete();
	}

}
