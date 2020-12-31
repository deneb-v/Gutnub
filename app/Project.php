<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'projectID';
    protected $fillable = [
        'projectID',
        'projectName',
        'projectDueDate'
    ];
    public $incrementing = false;

    public function projectMember(){
        return $this->hasMany('App\Project_member', 'projectID', 'projectID');
    }

    public function file(){
        return $this->hasMany('App\File', 'projectID', 'projectID');
    }

    public function remainingTime(){
        $second = intval(round((strtotime($this->projectDueDate) - time())));
        $day = intval($second/86400);
        $hour = intval($second/3600);
        $minute = intval($second/60);
        if($second < 0){
            return ['time' => null, 'unit' => null, 'second' => PHP_INT_MAX ];
        }
        if($day != 0){
            return ['time' => $day, 'unit' => 'Days', 'second' => $second];
        }
        else if($day == 0 && $hour != 0){
            return ['time' => $hour, 'unit' => 'Hours', 'second' => $second];
        }
        else if($hour == 0 && $minute != 0){
            return ['time' => $minute, 'unit' => 'Minutes', 'second' => $second];
        }
        else if($minute == 0){
            return ['time' => $second, 'unit' => 'Seconds', 'second' => $second];
        }
    }
}
