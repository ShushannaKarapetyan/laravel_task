<?php

use App\Project;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('messages.{project}', function ($user, Project $project) {
    return $project->participants->contains($user);
});
