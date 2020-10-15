<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'order';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['customer_id', 'menu_id', 'quantity', 'status_id'];
	
	public function getMenu()
	{
		return Menu::find($this->menu_id);
	}
	
	public function getCustomerEmailAddress()
	{
		return Customer::find($this->customer_id)->email;
	}
	
	public function getStatusName()
	{
		return Status::find($this->status_id)->name;
	}

}
