<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class File extends Model
{
    protected $table = 'files';
    protected $primarykey = 'fileID';
    protected $fillable = [
        'fileID',
        'projectID',
        'userID',
        'fileName',
        'description'
    ];

    public $incrementing = false;

    public function user(){
        return $this->belongsTo('App\User', 'userID');
    }

    public function project(){
        return $this->belongsTo('App\Project', 'projectID', 'projectID');
    }
}
