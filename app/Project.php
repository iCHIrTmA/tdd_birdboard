<?php

namespace App;

use App\Activity;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
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

    public function recordActivity($description)
    {	
    	$this->activity()->create([
    		'description' => $description,
    		'changes'     => $description === 'updated' ? [
    			'before'  => array_diff($this->old, $this->getAttributes()),
    			'after'   => $this->getChanges(),
    		] : null,
    	]);
    }

	public function activity()
	{
		return $this->hasMany(Activity::class)->latest();
	}
}
