<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'picture';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['url', 'description'];
	
	public function getAbsolutePictureUrl()
	{
		return asset('/uploaded/' . $this->url);
	}
}
