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
}
