<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
