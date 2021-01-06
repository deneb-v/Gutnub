@extends('layout/mainlayout')

@section('content')
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dropzone/dist/min/dropzone.min.css') }}">

    <!-- JS -->
    <script src="{{ asset('dropzone/dist/min/dropzone.min.js') }}" type="text/javascript"></script>

    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger mt-3" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif

        <div class="d-flex flex-row align-items-center">
            <h1>{{ $project->projectName }}</h1>
            <a class="pl-3" href="#" data-toggle="modal" data-target="#modal_editproject">
                <i class="fas fa-cog"></i>
            </a>
        </div>
        <p>Due date: {{ $project->projectDueDate }}</p>

        <div class="row">
            {{-- Left Side --}}
            <div class="col-xl-6">
                {{-- Colaborator --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h2 class="m-0 font-weight-bold text-primary">Collaborator</h2>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_addColabolator">Add
                            Collaborator</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($collabolator as $item)
                                <div class="col-2 align-items-center text-center">
                                    <img class="rounded-circle" src="{{ $item->user->profilePicture }}" style="width: 50px">
                                    <p class="text-center mb-0" data-placement="bottom" data-toggle="tooltip"
                                        title="{{ $item->user->name }}">{{ Str::limit($item->user->name, 7, '..') }}</p>
                                    @if ($item->role == 'owner')
                                        <span class="badge badge-success">Owner</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- End Colaborator --}}

                {{-- Latest Project File --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h2 class="m-0 font-weight-bold text-primary">Latest Project File</h2>
                        {{-- DropZone --}}
                        {{-- <button class="btn btn-primary btn-sm" data-toggle='modal'
                            data-target="#modal_uploadfile">Upload File</button> --}}
                        {{-- Select File --}}
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#model_upload">Upload
                            File</button>
                    </div>
                    <div class="card-body">

                        @if ($latestFile == null)
                            <p class="text-center">No file uploaded</p>
                        @else
                            <p>
                                Uploaded by: <b> {{ $latestFile->user->name }} </b> <br>
                                Time: <b>{{ $latestFile->created_at }}</b><br>
                                Description: <b>{{ $latestFile->description }}</b> <br>
                            </p>
                            <div class="col-xl-12 col-md-12 mb-12">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body d-flex flex-row justify-content-between">
                                        <span> <i class="fas fa-folder mr-1"></i>{{ $latestFile->fileName }}</span>
                                        <a target="blank"
                                            href="{{ route('downloadFile', ['id' => $project->projectID, 'fileID' => $latestFile->fileID]) }}">
                                            <i class="fas fa-arrow-circle-down"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
                {{-- End Colaborator --}}
            </div>
            {{-- End of Left Side --}}

            {{-- Right Side --}}
            <div class="col-xl-6">
                {{-- History --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h2 class="m-0 font-weight-bold text-primary">History</h2>
                    </div>
                    <div class="card-body">
                        {{-- History Table --}}
                        <table id="tbl_history" class="table">
                            <thead>
                                <tr>
                                    <th>Time Uploaded</th>
                                    <th>Uploaded by</th>
                                    <th>Filename</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($history as $item)
                                    <tr>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->fileName }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <a target="blank"
                                                href="{{ route('downloadFile', ['id' => $project->projectID, 'fileID' => $item->fileID]) }}">
                                                <i class="fas fa-arrow-circle-down"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- End of History Table --}}
                    </div>
                </div>
                {{-- End of History --}}
            </div>
            {{-- End of Right Side --}}
        </div>

    </div>


    {{-- Modal --}}
    {{-- Modal Dropzone --}}
    <div class="modal fade" id="modal_uploadfile" tabindex="-1" aria-labelledby="modal_uploadfile" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.fileupload') }}" class="dropzone" method="POST"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{ $project->projectID }}">
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Add Colaborator--}}
    <div class="modal fade" id="modal_addColabolator" tabindex="-1" aria-labelledby="modal_addColabolator"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add colabolator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addColllabolator', ['id' => $project->projectID]) }}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="txt_projectName" name="txt_email">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal upload --}}
    <div class="modal fade" id="model_upload" tabindex="-1" aria-labelledby="model_upload" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload file</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('uploadFile', ['id' => $project->projectID]) }}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" class="form-control-file" id="file_upload" name="file_upload">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control" id="txt_description" name="txt_description" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal edit project --}}
    <div class="modal fade" id="modal_editproject" tabindex="-1" aria-labelledby="modal_editproject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('editproject', ['id' => $project->projectID]) }}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Project name</label>
                            <input type="text" class="form-control" id="txt_projectName" name="txt_projectName"
                                value="{{ $project->projectName }}">
                        </div>
                        <div class="form-group">
                            <label>Due date</label>
                            <input type="datetime-local" class="form-control" id="txt_projectDate" name="txt_projectDate"
                                value="{{ date('Y-m-d\TH:i', strtotime($project->projectDueDate)) }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#tbl_history').DataTable({
                paging: false,
                searching: false,
                scrollX: 500
            });
        });

        // <!-- Script DropZone -->
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone(".dropzone", {
            maxFilesize: 3, // 3 mb
            acceptedFiles: ".jpeg,.jpg,.png,.pdf",
        });
        myDropzone.on("sending", function(file, xhr, formData) {
            formData.append("_token", CSRF_TOKEN);
        });

    </script>
@endsection
