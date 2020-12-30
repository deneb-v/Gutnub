<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    protected $table = 'projects';
    protected $primarykey = 'projectID';
    protected $fillable = [
        'projectID',
        'projectName',
        'projectDueDate'
    ];

    public function projectMember(){
        return $this->hasMany('App\Project_member', 'projectID', 'projectID');
    }

    public function file(){
        return $this->hasMany('App\File', 'projectID', 'projectID');
    }

    static public function getAll()
    {
        return Project::all();
    }

    static public function getProjectNameListbyUser($id)
    {
        $project = DB::table('projects as p')
            ->join('project_members as pm', 'p.projectID', '=', 'pm.projectID')
            ->where('pm.userID', '=', $id)
            ->get([
                'p.projectID as projectID',
                'p.projectName as projectName'
            ]);

        return $project;
    }

    static public function getProjectListbyUser($id)
    {
        $project = DB::table('projects as p')
            ->join('project_members as pm', 'p.projectID', '=', 'pm.projectID')
            ->where('pm.userID', '=', $id)
            ->get();

        return $project;
    }

    static public function getProject($id)
    {
        return Project::where('projectID', $id)->first();
    }

    static public function addProject($folderID, $projectName, $dueDate)
    {
        Project::create([
            'projectID' => $folderID,
            'projectName' => $projectName,
            'projectDueDate' => $dueDate
        ]);
    }

    static public function getProjectUpdate($userID){
        // $data = DB::select('SELECT y.projectName, y.updated_at, y.name, y.fileName, y.description FROM (SELECT pm.projectID FROM users u JOIN project_members pm ON pm.userID = u.id where u.id = ?) as x, (SELECT p.projectID, p.projectName, f.updated_at, x.name , x.fileName, x.description FROM (SELECT a.id AS id, a.name AS Name, f.fileName, f.description, p.projectID FROM users a JOIN files f ON f.userID = a.id JOIN projects p ON p.projectID = f.projectID ) as x, users u JOIN project_members pm ON pm.userID = u.id JOIN projects p ON p.projectID = pm.projectID JOIN files f ON f.projectID = p.projectID WHERE x.id = u.id AND p.projectID = x.projectID GROUP BY x.fileName, p.projectName, x.name, p.projectID) as y WHERE x.projectID = y.projectID', [1, $userID]);
        $data = [];
        return $data;
    }
}
