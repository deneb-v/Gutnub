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

    public function user(){
        return $this->belongsTo('App\User', 'userID');
    }

    public function project(){
        return $this->belongsTo('App\Project', 'projectID', 'projectID');
    }

    static public function addFile($fileID, $projectID, $userID, $filename, $description)
    {
        File::create([
            'fileID' => $fileID,
            'projectID' => $projectID,
            'userID' => $userID,
            'filename' => $filename,
            'description' => $description
        ]);
    }

    static public function getLatestFileDetail($projectID)
    {
        $fileDetail = DB::table('files as f')
            ->join('users as u', 'f.userID', '=', 'u.id')
            ->where('f.projectID', '=', $projectID)
            ->orderBy('created_at', 'desc')
            ->get([
                'f.fileID as fileID',
                'f.filename as filename',
                'u.name as userName',
                'f.created_at as created_at',
                'f.description as description'
            ])
            ->first();
        return $fileDetail;
    }

    static public function getHistory($projectID)
    {
        $history = DB::table('files as f')
            ->join('users as u', 'f.userID', '=', 'u.id')
            ->where('f.projectID', '=', $projectID)
            ->orderBy('created_at', 'desc')
            ->get([
                'f.fileID as fileID',
                'f.filename as filename',
                'u.name as userName',
                'f.created_at as created_at',
                'f.description as description'
            ]);
        return $history;
    }
}
