<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Project;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class ProjectsController extends Controller
{
    /**
     * @param Project $project
     * @return Factory|JsonResponse|View
     */
    public function show(Project $project)
    {
        $project->load('messages');
        $authUser = auth()->user();

        if (request()->ajax()) {
            return Response::json(['user' => $authUser, 'project' => $project]);
        }

        return view('projects.messages');
    }

    /**
     * @param Project $project
     * @return mixed
     */
    public function store(Project $project)
    {
        $message = $project->messages()->create(request()->only(['body'])
            + ['project_id' => $project->id, 'user_id' => auth()->id()]);

        MessageSent::dispatch($message);

        return $message;
    }
}
