<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project; 
use App\Cv;
class ProjectController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function addProject(Request $request){
        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->link = $request->link;
        $project->image = $request->image;
        $project->cv_id = $request->cv_id;
        $project->save();
        return Response()->json(array(
            'status' => true,
            'id'     => $project->id
        ));
    }

    public function updateProject(Request $request){
    	$project = Project::find($request->id);
        $project->title = $request->title;
        $project->description = $request->description;
        $project->link = $request->link;
        $project->image = $request->image;
        $project->cv_id = $request->cv_id;

        $project->save();
        return Response()->json(array(
            'status' => true
        ));
    }

    public function deleteProject($id){
    	$project = Project::find($id);
        $project->delete();
        return Response()->json(array(
            'status' => true
        ));
    }
}
