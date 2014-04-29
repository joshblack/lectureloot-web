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
	 * Defines a many-to-one relationship between User and Wager.
	 *
	 * @return Eloquent Relationship
	 */
	public function wagers()
	{
		return $this->hasMany('Wager');
	}

	/**
	 * Defines a many-to-many relationship between User and Course.
	 *
	 * @return Eloquent Relationship
	 */
	public function courses()
	{
		return $this->belongsToMany('Course');
	}

	/**
	 * Defines a many-to-one relationship between User and Checkin.
	 *
	 * @return Eloquent Relationship
	 */
	public function checkins()
	{
		return $this->hasMany('Checkin');
	}

	/**
	 * Defines a one-to-one relationship between User and Token.
	 *
	 * @return Eloquent Relationship
	 */
	public function token()
	{
		return $this->hasOne('Token');
	}

	public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}
}