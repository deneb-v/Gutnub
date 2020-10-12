<?php

namespace App\Http\Controllers;

use App\Project;
use App\Project_member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function homeView()
    {
        $projectList = Project::getAll();
        return view('home', ['projectList' => $projectList]);
    }

    public function projectView($id)
    {
        $projectList = project::getAll();
        $project = Project::getProject($id);





        return view('project', ['project' => $project, 'projectList' => $projectList]);
    }

    public function addProject(Request $req)
    {
        $rules = [
            'txt_projectName' => 'required|unique:projects,projectName',
            'txt_projectDate' => 'required|after:today'
        ];
        $attribute = [
            'txt_projectName' => 'Project name',
            'txt_projectDate' => 'Due date'
        ];
        $message = [
            'required' => ':attribute must be filled.',
            'after' => ':attribute must be '
        ];
        $this->validate($req, $rules, $message, $attribute);
        $projectName = $req->txt_projectName;
        $dueDate = $req->txt_projectDate;
        // dd($req);
        $drive = new GdriveController();
        // dd($drive);
        $folderID = $drive->createFolderIn(Auth::user()->gutnubFolderID, $projectName);

        Project::addProject($folderID, $projectName, $dueDate);
        Project_member::addProjectMember($folderID, Auth::user()->id, 'owner');
        return redirect()->route('projectView', ['id' => $folderID]);
    }

    public function fileupload(Request $req)
    {
        if ($req->hasFile('file')) {

            $destinationpath = 'files/' . $req->input('id');

            if (!file_exists($destinationpath)) {
                mkdir($destinationpath, 0755, true);
            }

            $extension = $req->file('file')->getClientOriginalExtension();

            // $validextensions = array('zip', '7z');

            // if (in_array(strtolower($extension), $validextensions)) {
            $fileName = $req->file('file')->getClientOriginalName() . time() . '.' . $extension;

            $req->file('file')->move($destinationpath, $fileName);
            // }
        }
    }
}
