<?php

class Course extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	/**
	 * Defines a one-to-many relationship between Course and User.
	 *
	 * @return Eloquent Relationship
	 */
	public function users()
	{
		return $this->belongsToMany('User');
	}

	/**
	 * Defines a many-to-one relationship between Course and Meeting.
	 *
	 * @return Eloquent Relationship
	 */
	public function meetings()
	{
		return $this->hasMany('Meeting');
	}

	/**
	 * Adds a search scope to the Course model.
	 * Searches courses for a given query.
	 *
	 * @param Eloquent Query, search query
	 * @return Eloquent Collection
	 */
	public function scopeSearch($query, $search)
	{
		return $query->where('courseTitle', 'LIKE', "%$search%")
							->orWhere('deptCode', 'LIKE', "%$search%")
							->orWhere('courseNumber', 'LIKE', "%$search%")
							->orWhere('instructor', 'LIKE', "%$search%")
							->orWhere(function($query) use ($search)
							{
								$deptCode = substr($search, 0, 3);
								$courseNumber = substr($search, 3);
								$query->where('deptCode', 'LIKE', "%$deptCode%")
											->where('courseNumber', 'LIKE', "%$courseNumber%");
							});
	}

}
