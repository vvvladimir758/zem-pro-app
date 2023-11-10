<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class StatisticController extends Controller
{
    public function index(){
        
        $notes = Project::where('user_id',Auth::id())
                   ->with('tasks.timeSpent')
                   ->get();

        $noteList = [];
        foreach($notes as $note){
            
            $timeTotal = 0;
            
            foreach ($note->tasks as $n){
                 
                $n->timeSpent->sum(function($ts) use (&$timeTotal) {

                    return $timeTotal += time2sec($ts->time_spent);
        
                    });
            
            }

            $noteList[]    = [
                               'project_id'    => $note->id, 
                               'project_title' => $note->title,     
                               'count_task'    => $note->tasks->count(),
                               'time_spent'    => sec2HrMin($timeTotal)
                            ];
                
        }
          
        
         return view('statistic.index',
            [
                'noteList'=>$noteList   
            ]);
    }
    

}
