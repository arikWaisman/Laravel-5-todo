<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{
    protected $rules = [
                'name' => ['required','min:3'],
                'slug' => ['required'],
    ];

    /**
     * Display A listing of the resource
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {

        $projects = Project::all();
	    return view('projects.index', compact('projects'));

    }

    /**
     * Show form for creating a new resource
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {

        return view('projects.create');

    }

    /**
     * Store a newly created resource in the database
     * @return response
     */
    public function store(Request $request){

        $this->validate($request, $this->rules);

        $input = Input::all();
        Project::create($input);

        return Redirect::route('projects.index')->with('message', 'Project Created');

    }

    /**
     * display the resource from the database
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Project $project){

        return view('projects.show', compact('project'));

    }

    /**
     * Show the form for editing the specified resource
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Project $project){

        return view('projects.edit', compact('project'));

    }

    /**
     * update the specified resource in the database
     * @param Project $project
     */
    public function update(Project $project, Request $request){

        $this->validate($request, $this->rules);


        $input = array_except(Input::all(), '_method');
        $project->update($input);

        return Redirect::route('projects.show', $project->slug)->with('message', 'Project Updated');

    }

    /**
     * Delete the specified resource from the database
     * @param Project $project
     */
    public function destroy (Project $project){

        $project->delete();

        return Redirect::route('projects.index')->with('message', 'Project Deleted');

    }
}
