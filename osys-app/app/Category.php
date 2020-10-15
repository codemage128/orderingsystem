<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'category';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name'];
	
	public $timestamps = false;
	
	/**
	 * Get menus of current category
	 *
	 * @return Menu
	 */
	public function getMenu()
    {
		return Menu::where('category_id', '=', $this->id)->get();
    }

}
