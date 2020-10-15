<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'menu';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['category_id', 'name', 'price', 'description', 'rating', 'deleted'];
	
	/**
	 * Get category of current menu
	 *
	 * @return string
	 */
	public function getCategory()
    {
        return Category::find($this->category_id)->name;
    }
	
	/**
	 * Filter records 
	 */
	public function scopePopular($query)
	{
		return $query->where('deleted', '=', 0);
	}
	
	public function getFirstPictureUrl()
	{
		$menuPicture = MenuPicture::where('menu_id', '=', $this->id)->where('disp_order', '=', 0)->first();
		
		if($menuPicture == NULL)
			return NULL;
			
		return $menuPicture->getPicture()->getAbsolutePictureUrl();
	}
	
	public function getPictures()
	{
		return MenuPicture::where('menu_id', '=', $this->id)->get();
	}
	
	public function getRatingImageUrl()
	{
		if($this->rating < 100)
		{
			return asset('/images/user-rating-0.png');
		}
		else if($this->rating >= 100 && $this->rating <=500)
		{
			return asset('images/user-rating-1.png');
		}
		else if($this->rating >= 500 && $this->rating <=1500)
		{
			return asset('images/user-rating-2.png');
		}
		else if($this->rating >= 1500 && $this->rating <=3000)
		{
			return asset('images/user-rating-3.png');
		}
		else if($this->rating >= 3000 && $this->rating <=5000)
		{
			return asset('images/user-rating-4.png');
		}
		else if($this->rating >= 5000)
		{
			return asset('images/user-rating-5.png');
		}
	}
	
	public function getThreeHighestRatingMenu()
	{
		$menus = $this->popular()->select('id','name','price','rating')->orderBy('rating','desc')->take(3)->get();
		
		$data = array();
		$index = 0;
		foreach($menus as $menu)
		{
			$data[$index]['id'] = $menu->id;
			$data[$index]['name'] = $menu->name;
			$data[$index]['price'] = $menu->price;
			$data[$index]['picture'] = $menu->getFirstPictureUrl();
			$data[$index]['rating'] = $menu->getRatingImageUrl();
			$index ++;
		}
		
		return $data;
	}
	
	public function getAllMenu()
	{
		$menus = $this->popular()->select('id','name','price','rating','category_id')->get();
		
		$data = array();
		$index = 0;
		foreach($menus as $menu)
		{
			$data[$index]['id'] = $menu->id;
			$data[$index]['name'] = $menu->name;
			$data[$index]['price'] = $menu->price;
			$data[$index]['picture'] = $menu->getFirstPictureUrl();
			$data[$index]['rating'] = $menu->getRatingImageUrl();
			$data[$index]['category_id'] = $menu->category_id;
			$data[$index]['url'] = url('/menu/detail/'.$menu->id);

			$index ++;
		}
	}
	
	public function getMenuJsonData()
	{
		$menus = $this->popular()->select('id','name','price','rating','category_id')->get();
		
		$data = array();
		$index = 0;
		foreach($menus as $menu)
		{
			$data[$index]['id'] = $menu->id;
			$data[$index]['name'] = $menu->name;
			$data[$index]['price'] = $menu->price;
			$data[$index]['picture'] = $menu->getFirstPictureUrl();
			$data[$index]['rating'] = $menu->getRatingImageUrl();
			$data[$index]['category_id'] = $menu->category_id;
			$data[$index]['url'] = url('/menu/detail/'.$menu->id);

			$index ++;
		}
		
		return json_encode($data);
	}
}
