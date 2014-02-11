<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Defines what methods can be passed to the create field
	 *
	 * @var array
	 */
	protected $fillable = ['emailAddress', 'password', 'username', 'firstName', 'lastName'];

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * Set the relationship between the User and Wager Models.
	 *
	 * @return relationship
	 */
	public function wagers()
	{
		return $this->hasMany('Wager');
	}

	/**
	 * Set the relatinship between the User and Schedule Models.
	 *
	 * @return relationship
	 */
	public function schedule()
	{
		return $this->hasOne('Schedule');
	}

}