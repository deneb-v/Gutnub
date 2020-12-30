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
        // $projectList = Project::getProjectListbyUser(Auth::user()->id);
        $latestUpdate = Project::getProjectUpdate(Auth::user()->id);

        $projectList = Auth::user()->projectMember;

        return view('home', ['projectList' => $projectList, 'latestUpdate' => $latestUpdate]);
    }

    public function projectView($id)
    {
        // $projectList = Project::getProjectNameListbyUser(Auth::user()->id);
        // $project = Project::getProject($id);
        // $collabolator = Project_member::getProjectMember($id);
        // $latestFile = File::getLatestFileDetail($id);
        // $history = File::getHistory($id);

        $projectList = Auth::user()->projectMember;
        $project = Project::where('projectID',$id)->first();
        $collabolator = $project->projectMember;
        $history = $project->file->sortByDesc('created_at');
        $latestFile = $history->first();

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

        $drive = new GdriveController();
        $folderID = $drive->createFolderIn(Auth::user()->gutnubFolderID, $projectName);

        // Project::addProject($folderID, $projectName, $dueDate);
        $project = new Project();
        $project->projectID = $folderID;
        $project->projectName = $projectName;
        $project->projectDueDate = $dueDate;

        // Project_member::addProjectMember($folderID, Auth::user()->id, 'owner');
        $project_member = new Project_member();
        $project_member->projectID = $folderID;
        $project_member->userID = Auth::user()->id;
        $project_member->role = 'owner';

        $project->save();
        $project_member->save();
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
        $user = User::where('email',$email)->first();

        if ($user == null) {
            return back()->with('error', 'User is not Gutnub user');
        }

        if (!Project_member::isMemberUnique($id, $user->id)) {
            return back()->with('error', 'User already join this project');
        }

        $drive->addPermission($id, $email);
        // Project_member::addProjectMember($id, $user->id, 'member');
        $project_member = new Project_member();
        $project_member->projectID = $id;
        $project_member->userID = $user->id;
        $project_member->role = 'member';
        $project_member->save();
        return redirect()->route('projectView', ['id' => $id])->with('success', $user->name . ' successfully added');
    }

    public function uploadFile(Request $req, $id)
    {
        $drive = new GdriveController();

        $fileID = $drive->createFile($req->file('file_upload'), $id);
        // File::addFile($fileID, $id, Auth::user()->id, $req->file('file_upload')->getClientOriginalName(), $req->txt_description);

        $file = new File();
        $file->fileID = $fileID;
        $file->projectID = $id;
        $file->userID = Auth::user()->id;
        $file->fileName = $req->file('file_upload')->getClientOriginalName();
        $file->description = $req->txt_description;

        $file->save();

        return redirect()->route('projectView', ['id' => $id])->with('success', 'File successfuly uploaded');
    }

    public function downloadFile($id, $fileID){
        $drive = new GdriveController();
        $file = $drive->getFile($fileID);

        return redirect($file->webContentLink);
    }

    public function test(){
        $user = Auth::user();

        // dd(File::where('projectID', '1B0455EPen4KXUZJXj19KQw8D4oe_Slei')->orderBy('created_at', 'DESC')->first());
        dd(Project::where('projectID','1B0455EPen4KXUZJXj19KQw8D4oe_Slei')->first()->file->sortByDesc('created_at')->first());
        // dd(Auth::user()->projectMember);
    }
}
