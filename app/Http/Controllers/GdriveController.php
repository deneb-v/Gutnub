<?php

namespace App\Http\Controllers;

use Exception;
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Google_Service_Drive_Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GdriveController extends Controller
{
    private $drive;
    public function __construct($refresh_token=null)
    {
        $client = new Google_Client();
            Storage::disk('local')->put('client_secret.json', json_encode([
                'web' => config('services.google')
            ]));
        $client->setAuthConfig(Storage::path('client_secret.json'));

        if($refresh_token==null){
            $client->refreshToken(Auth::user()->refresh_token);
        }
        else{
            $client->refreshToken($refresh_token);
        }

        $this->drive = new Google_Service_Drive($client);
        // $this->middleware(function ($request, $next) use ($client) {
        //     return $next($request);
        // });
    }

    public function getDrive(){
        $this->ListFolders('root');
    }

    public function ListFolders($id){

        $query = "mimeType='application/vnd.google-apps.folder' and '".$id."' in parents and trashed=false";

        $optParams = [
            'fields' => 'files(id, name)',
            'q' => $query
        ];

        $results = $this->drive->files->listFiles($optParams);

        if (count($results->getFiles()) == 0) {
            print "No files found.\n";
        } else {
            print "Files:\n";
            foreach ($results->getFiles() as $file) {
                // dump($file->getName(), $file->getID());
                print "name: ".$file->getName()." id: ".$file->getID().".\n";
            }
        }
    }

    function uploadFile(Request $request){
        if($request->isMethod('GET')){
            return view('upload');
        }else{
            $this->createFile($request->file('file'));
        }
    }

    function createStorageFile($storage_path){
        $this->createFile($storage_path);
    }

    function createFile($file, $parent_id = null){
        $name = gettype($file) === 'object' ? $file->getClientOriginalName() : $file;
        $fileMetadata = new Google_Service_Drive_DriveFile([
            'name' => $name,
            'parents' => array($parent_id)
        ]);

        $content = gettype($file) === 'object' ?  File::get($file) : Storage::get($file);
        $mimeType = gettype($file) === 'object' ? File::mimeType($file) : Storage::mimeType($file);

        $file = $this->drive->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => $mimeType,
            'uploadType' => 'multipart',
            'fields' => 'id'
        ]);
        return $file->id;
    }

    function deleteFileOrFolder($id){
        try {
            $this->drive->files->delete($id);
        } catch (Exception $e) {
            return false;
        }
    }

    function createFolder($folder_name){
        $folder_meta = new Google_Service_Drive_DriveFile(array(
            'name' => $folder_name,
            'mimeType' => 'application/vnd.google-apps.folder'));
        // dd($folder_meta);
        $folder = $this->drive->files->create($folder_meta, array(
            'fields' => 'id'));
        return $folder->id;
    }

    function createFolderIn($parent, $folder_name){
        $meta = new Google_Service_Drive_DriveFile();
        $meta->setName($folder_name);
        $meta->setMimeType('application/vnd.google-apps.folder');
        $meta->setParents(array($parent));
        $folder = $this->drive->files->create($meta, array(
            'fields' => 'id'
        ));
        return $folder->id;
    }

    function addPermission($folderID, $email){
        $permission = new Google_Service_Drive_Permission();
        $permission->setEmailAddress($email);
        $permission->setRole('writer');
        $permission->settype('user');

        $this->drive->permissions->create($folderID,$permission);
    }

    function getFile($fileID){
        $file = $this->drive->files->get($fileID,array(
            'fields' => ['webContentLink','name']
        ));
        return $file;
    }
}
