<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project_member extends Model
{

    protected $primaryKey = null;
    protected $table='project_members';
    protected $fillable=[
        'projectID',
        'userID',
        'role'
    ];

    public $incrementing = false;

    public function user(){
        return $this->belongsTo('App\User', 'userID');
    }

    public function project(){
        return $this->belongsTo('App\Project', 'projectID', 'projectID');
    }

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
        // WHERE p.projectID = '1hEA_1rzj8obVAWa_akWBgEax80lEt63z'
        $member =  DB::table('projects as p')
            ->join('project_members as pm','p.projectID','=','pm.projectID')
            ->join('users as u', 'pm.userID', '=', 'u.id')
            ->where('p.projectID','=',$id)
            ->get([
                'u.name as name',
                'u.profilePicture as profilePicture',
                'pm.role as role'
            ]);
        return $member;
    }

    static public function isMemberUnique($projectID, $userID){
        $member = DB::table('project_members as pm')
            ->where([
                ['pm.projectID','=',$projectID],
                ['pm.userID','=',$userID]
            ])->get();
        // dd(empty($member));
        if(!empty($member)){
            return true;
        }
        else{
            return false;
        }
    }
}
