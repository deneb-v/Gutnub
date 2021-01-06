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

    static public function isMemberUnique($projectID, $userID){
        // $member = DB::table('project_members as pm')
        //     ->where([
        //         ['pm.projectID','=',$projectID],
        //         ['pm.userID','=',$userID]
        //     ])->get();

        $member = Project_member::where(
                ['pm.projectID','=',$projectID],
                ['pm.userID','=',$userID])->get();
        // dd(empty($member));
        if(!empty($member)){
            return true;
        }
        else{
            return false;
        }
    }
}
