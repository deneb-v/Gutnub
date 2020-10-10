<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project_member extends Model
{
    protected $table='project_members';
    protected $fillable=[
        'projectID',
        'userID',
        'role'
    ];

    static public function addProjectMember($projectID, $userID, $role){
        Project_member::create([
            'projectID' => $projectID,
            'userID' => $userID,
            'role' => $role,
        ]);
    }

    static public function getProjectMember($id){
                // SELECT u.name, u.profilePicture, pm.role
        // FROM projects p
        // JOIN project_members pm ON p.projectID = pm.projectID
        // JOIN users u ON pm.userID = u.id
        $member =  DB::table('projects as p')
            ->join('project_members as pm','p.projectID','=','pm.projectID')
            ->join('users as u', 'pm->userID', '=', 'u->id')
            ->where('p.id','=',$id)
            ->get([
                'u.name as name',
                'u.profilePicture as profilePicture',
                'pm.role as role'
            ]);
    }
}
