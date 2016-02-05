<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $guarded = [];

	//This is the inverse many-to-one of the one-to-many relationship in the Project Model
	public function project()
	{
		return $this->belongsTo('App\Project');
	}
}
