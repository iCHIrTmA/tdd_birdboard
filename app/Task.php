<?php

namespace App;

use App\Activity;
use App\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Task extends Model
{
    use RecordsActivity;

    public $old = [];

    protected $guarded = [];
    protected $touches = ['project'];
    protected $casts = [
        'completed' => 'boolean'
    ];

    public function complete()
    {
        $this->update(['completed' => true]);

        $this->recordActivity('completed_task');
    }

    public function incomplete()
    {
        $this->update(['completed' => false]);

        $this->recordActivity('incompleted_task');
    }

    public function project()
    {
    	return $this->belongsTo(Project::class);
    }

    public function path()
    {
    	return "/projects/{$this->project->id}/tasks/{$this->id}";
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
        return $this->morphMany(Activity::class, 'subject')->latest();
    }
}
