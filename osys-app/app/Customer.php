<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['email'];
	
	/**
	 * @param email string A customer's email address
	 * @return integer Register a customer's email and returns its PK
	 */
	public function getCustomerID($email)
	{
		$entity = $this->where('email', '=', $email)->first();
		
		if ($entity != NULL)
			return $entity->id;
		
		$this->insert(array('email'=>$email));
		
		return $this->where('email', '=', $email)->first()->id;
	}
	
	public function getOrderList()
	{
		$orderList = Order::where('status_id','=',Status::getIDByName('Requested'))
							->where('customer_id','=',$this->id)
							->orderBy('update_datetime','desc')
							->get();
		return $orderList;
	}

}
