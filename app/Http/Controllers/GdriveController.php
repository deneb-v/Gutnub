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
    public function __construct(Google_Client $client)
    {
        $this->middleware(function ($request, $next) use ($client) {
            $client->refreshToken(Auth::user()->refresh_token);
            $this->drive = new Google_Service_Drive($client);
            return $next($request);
        });
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
                dump($file->getName(), $file->getID());
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

    public function test(){
        // $this->createFolder('gutnub not github');
        // dd($this->drive->files);

        // 1HD-0o-OZouFNPofrfZUDbYR7M8Ddyhtg

        // $permission = new Google_Service_Drive_Permission();
        // $permission->setEmailAddress('galaxyrean@gmail.com');
        // $permission->setRole('writer');
        // $permission->settype('user');

        // dd($this->drive);
        // $testupd = $this->drive->permissions->create('1DdLo-01SlmRYPFAlRsm6c5h6XYmaDeHt',$permission);

        $folder_meta = new Google_Service_Drive_DriveFile(array(
            'name' => 'woohooo',
            'mimeType' => 'application/vnd.google-apps.folder',));

        $folder_meta->setParents('1DdLo-01SlmRYPFAlRsm6c5h6XYmaDeHt');

        $this->createFile('test.txt','1DdLo-01SlmRYPFAlRsm6c5h6XYmaDeHt');
        // $file = $this->drive->files->insert($folder_meta, [
        //     'fields' => [
        //         'id',
        //         ]
        // ]);
        dd($folder_meta);

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

        dd($file->id);
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
}
