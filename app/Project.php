<?php

namespace App;

use App\Activity;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Project extends Model
{
	use RecordsActivity;

	protected $guarded = [];

	public $old = [];

	public function path()
	{
		return "/projects/{$this->id}";
	}

	public function owner()
	{
		return $this->belongsTo(User::class);
	}

	public function tasks()
	{
		return $this->hasMany(Task::class);
	}

	public function addTask($body)
	{
		return $this->tasks()->create(compact('body'));
	}

    protected function activityChanges()
    {
    	if ($this->wasChanged()) {
		   	return [
	    		'before'  => Arr::except(array_diff($this->old, $this->getAttributes()), 'updated_at'),
	    		'after'   => Arr::except($this->getChanges(), 'updated_at'),
		    ];   
    	} 
    }

	public function activity()
	{
		return $this->hasMany(Activity::class)->latest();
	}
}
