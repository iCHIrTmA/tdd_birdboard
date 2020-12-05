<?php

namespace App\Observers;

use App\Activity;
use App\Project;

class ProjectObserver
{

    public function created(Project $project)
    {
        $project->recordActivity('created');      
    }

    public function updated(Project $project)
    {
        $project->recordActivity('updated');
    }

    // protected function recordActivity($type, $project)
    // {
    //     Activity::create([
    //         'project_id' => $project->id,
    //         'description' => $type,
    //     ]);
    // }
}
