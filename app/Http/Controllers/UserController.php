<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function homeView(){
        $projectList = Project::getAll();
        return view('home',['projectList' => $projectList]);
    }

    public function projectView($id){
        $project = Project::getProject($id);
        return view('project',['project'=>$project]);
    }

    public function addProject(Request $req){
        $rules=[
            'txt_projectName' => 'required',
            'txt_projectDate' => 'required|after:today'
        ];
        $attribute=[
            'txt_projectName' => 'Project name',
            'txt_projectDate' => 'Due date'
        ];
        $message=[
            'required' => ':attribute must be filled.',
            'after' => ':attribute must be '
        ];

    }
}
