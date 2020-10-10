<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table='files';
    protected $primarykey='fileID';
    protected $fillable=[
        'fileID',
        'projectID',
        'userID',
        'filename'
    ];
}
