<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuPicture extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'menu_picture';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['menu_id', 'picture_id', 'disp_order'];
	
	public function getPicture()
	{
		return Picture::find($this->picture_id);
	}
}
