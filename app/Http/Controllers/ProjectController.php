<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Customer;
use Session;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Projects';
        $page_description = 'View Project';
        $projects = Project::all();
        return view('projects.index',compact('page_title','page_description', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $project_number = Project::max('project_number');
                        
        if($project_number == null){
            $project_number = "1001";
        
        }else{
            $project_number = $project_number + 1;
        }

        $page_title = 'Project';
        $page_description = 'Create Project';
        $customers = Customer::all();
        return view('projects.create',compact('page_title','page_description','project_number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $project = new Project;
        $project->project_number = $request->project_no;
        $project->customer_id = $request->customer_id;
        $project->project_name = $request->project_name;
        $project->project_type = $request->project_type;
        $project->project_details = $request->project_details;
        $project->project_status = $request->project_status;
        $project->project_start_date = $request->project_start_date;
        $project->project_end_date = $request->project_end_date;
        $project->project_per_hour_cost = $request->project_per_hour_cost;
        $project->project_estimate_cost = $request->project_estimate_cost;
        $project->save();

        Session::flash('success', 'Project created successfully');

        return redirect()->route('project.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
