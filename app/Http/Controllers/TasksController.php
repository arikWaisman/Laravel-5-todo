<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TasksController extends Controller
{
	protected $rules = [
				'name' => ['required', 'min:3'],
				'slug' => ['required'],
				'description' => ['required'],
	];

	/**
	 * Display a listing of the resource
	 * @param Project $project
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index(Project $project){

	    return view('tasks.index', compact('project'));

    }

	/**
	 * display the form for creating a new resource
	 * @param Project $project
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create(Project $project){

		return view('tasks.create', compact('project'));

	}

	/**
	 * Store a newly created resource in the DB
	 * @param Project $project
	 */
	public function store(Project $project, Request $request){

		$this->validate($request, $this->rules);


		$input = Input::all();
		$input['project_id'] = $project->id;
		Task::create($input);

		return Redirect::route('projects.show', $project->slug)->with('message', 'Task Created');

	}

	/**
	 * display the specified resource from the database
	 * @param Project $project
	 * @param Task $task
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show(Project $project, Task $task){

		return view('tasks.show', compact('project', 'task'));

	}

	/**
	 * show the form for editing the specified resource
	 * @param Project $project
	 * @param Task $task
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit(Project $project, Task $task){

		return view('tasks.edit', compact('project', 'task'));

	}

	/**
	 * Update the specified resource in the database
	 * @param Project $project
	 * @param Task $task
	 */
	public function update(Project $project, Task $task){

		$input = array_except(Input::all(), '_method');
		$task->update($input);

		return Redirect::route('projects.tasks.show', [$project->slug, $task->slug])->with('message', 'Task Updated');

	}

	/**
	 * Remove the specified resource from storage
	 * @param Project $project
	 * @param Task $task
	 */
	public function destroy(Project $project, Task $task, Request $request){

		$this->validate($request, $this->rules);

		$task->delete();

		return Redirect::route('projects.show', $project->slug)->with('message', 'Task Deleted');

	}
}
