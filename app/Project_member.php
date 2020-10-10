<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_member extends Model
{
    protected $table='project_member';
    protected $fillable=[
        'projectID',
        'userID',
        'role'
    ];
}
