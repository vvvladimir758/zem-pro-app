<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('projects.index');
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request, ImageController $image)
    {

        
        $data = [
            'title'       => $request->get('title'),
            'description' => $request->get('description'),
            'user_id'     => Auth::id()
        ];
        
        if ($request->file()) {
            $data = array_merge($data, $image->store($request));
        }
        
        $project = Project::create($data);
        $data['id'] = $project->id;
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project,Request $request)
    {
       return view('projects.show')->with('project',$project);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, project $project, ImageController $image)
    {
        $data = [
            'title'       => $request->get('title'),
            'description' => $request->get('description'),
            'user_id'     => Auth::id()
        ];
        
        if ($request->file()) {
            $data = array_merge($data, $image->store($request));
        }
        
        if($request->get('delImg') != 'false'){
            $data['image_id'] = NULL;
        }
      
        $project->update($data);
        
        $data['id'] = $project->id;
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->destroy($project->id);
    }
}
