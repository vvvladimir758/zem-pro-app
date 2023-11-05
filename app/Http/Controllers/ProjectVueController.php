<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectVueController extends Controller
{
    public function index(){
        return response()->json(Project::where('user_id', Auth::id())
            ->with('image')
            ->orderBy('id', 'desc')
            ->paginate(3)
            );
    }
    
    public function show(Request $request){
        
      return  Project::where('id', $request->project)
        ->with('image')
        ->with('tasks.timeSpent')
        ->first()
        ->toJson();

    }
}
