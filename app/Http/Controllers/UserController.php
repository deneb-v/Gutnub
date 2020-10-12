<?php

namespace App\Http\Controllers;

use App\File;
use App\Project;
use App\Project_member;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function homeView()
    {
        $projectList = Project::getProjectListbyUser(Auth::user()->id);
        return view('home', ['projectList' => $projectList]);
    }

    public function projectView($id)
    {
        $projectList = Project::getProjectNameListbyUser(Auth::user()->id);
        $project = Project::getProject($id);
        $collabolator = Project_member::getProjectMember($id);
        $latestFile = File::getLatestFileDetail($id);
        $history = File::getHistory($id);

        return view('project',['project'=>$project,
            'projectList'=>$projectList,
            'collabolator'=>$collabolator,
            'latestFile'=>$latestFile,
            'history' => $history
            ]);
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

    public function addColabolator(Request $req, $id)
    {
        $rules = [
            'txt_email' => 'required|email|ends_with:@gmail.com',
        ];
        $attribute = [
            'txt_email' => 'Collabolator email',
        ];
        $message = [
            'required' => ':attribute must be filled.',
            'email' => ':attribute must be valid email',
            'ends_with' => ':attribute must be google email'
        ];
        $this->validate($req, $rules, $message, $attribute);

        $email = $req->txt_email;
        $drive = new GdriveController();
        $user = User::findUser($email);

        if ($user == null) {
            return back()->with('error', 'User is not Gutnub user');
        }

        if (!Project_member::isMemberUnique($id, $user->id)) {
            return back()->with('error', 'User already join this project');
        }

        $drive->addPermission($id, $email);
        Project_member::addProjectMember($id, $user->id, 'member');
        return redirect()->route('projectView', ['id' => $id])->with('success', $user->name . ' successfully added');
    }

    public function uploadFile(Request $req, $id){
        $drive = new GdriveController();

        $fileID = $drive->createFile($req->file('file_upload'), $id);
        File::addFile($fileID, $id, Auth::user()->id, $req->file('file_upload')->getClientOriginalName(), $req->txt_description);

        return redirect()->route('projectView',['id' => $id])->with('success', 'File successfuly uploaded');
    }

    public function downloadFile($id, $fileID){
        $drive = new GdriveController();
        $file = $drive->getFile($fileID);

        return redirect($file->webContentLink);
    }
}
