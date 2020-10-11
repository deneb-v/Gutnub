<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    protected $table='projects';
    protected $primarykey='projectID';
    protected $fillable=[
        'projectID',
        'projectName',
        'projectDueDate'
    ];

    static public function getAll(){
        return Project::all();
    }

    static public function getProjectNameListbyUser($id){
        $project = DB::table('projects as p')
            ->join('project_members as pm','p.projectID','=','pm.projectID')
            ->where('pm.userID','=',$id)
            ->get([
                'p.projectID as projectID',
                'p.projectName as projectName'
            ]);

        return $project;
    }

    static public function getProject($id){
        return Project::where('projectID', $id)->first();
    }

    static public function addProject($folderID, $projectName, $dueDate ){
        Project::create([
            'projectID' => $folderID,
            'projectName' => $projectName,
            'projectDueDate' => $dueDate
        ]);
    }
}
