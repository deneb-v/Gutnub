@extends('layout/mainlayout')

@section('content')
<div class="container-fluid">
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{$err}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{Session::get('success')}}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger mt-3" role="alert">
            {{Session::get('error')}}
        </div>
    @endif
    <div class="modal fade" id="modal_addColabolator" tabindex="-1" aria-labelledby="modal_addColabolator" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add colabolator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addColllabolator', ['id' => $project->projectID]) }}" method="POST" enctype="multipart/form-data">
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

    <div class="modal fade" id="model_upload" tabindex="-1" aria-labelledby="model_upload" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add colabolator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('uploadFile', ['id' => $project->projectID]) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" class="form-control-file" id="file_upload" name="file_upload">
                        </div>
                        <div class="form-group">
                            <label>File</label>
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
  <h1>{{ $project->projectName }}</h1>
  <p>Due date: {{ $project->projectDueDate }}</p>

  <div class="row">
    {{-- Left Side --}}
    <div class="col-xl-6">
      {{-- Colaborator --}}
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h2 class="m-0 font-weight-bold text-primary">Collaborator</h2>
          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_addColabolator">Add Collaborator</button>
        </div>
        <div class="card-body">
          <div class="row">
              @foreach ($collabolator as $item)
                <div class="col-2 align-items-center text-center">
                    <img class="rounded-circle" src="{{ $item->profilePicture }}" style="width: 50px">
                    <p class="text-center mb-0" data-placement="bottom" data-toggle="tooltip" title="{{ $item->name }}">{{ Str::limit($item->name, 7, '..') }}</p>
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
          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#model_upload">Upload File</button>
        </div>
        <div class="card-body">
            @if ($latestFile!=null)
                <p>
                Uploaded by: <b> {{ $latestFile->userName }} </b> <br>
                Time: <b>{{ $latestFile->created_at }}</b><br>
                Description: <b>{{ $latestFile->description }}</b> <br>
                </p>
                <div class="col-xl-12 col-md-12 mb-12">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body d-flex flex-row justify-content-between">
                      <span> <i class="fas fa-folder"></i>{{ $latestFile->filename }}</span>
                      <a href="#"><i class="fas fa-arrow-circle-down"></i></a>
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
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>
                  Time Uploaded
                </th>
                <th>
                  Uploaded by
                </th>
                <th>
                  Description
                </th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  21 Nov 2020, 22.01
                </td>
                <td>
                  Jhon Doe
                </td>
                <td>
                  add santa to document
                </td>
                <td class="text-center">
                  <i class="fas fa-arrow-circle-down"></i>
                </td>
              </tr>
              <tr>
                <td>
                  21 Nov 2020, 22.01
                </td>
                <td>
                  Jhon Doe
                </td>
                <td>
                  add santa to document
                </td>
                <td class="text-center">
                  <i class="fas fa-arrow-circle-down"></i>
                </td>
              </tr>
              <tr>
                <td>
                  21 Nov 2020, 22.01
                </td>
                <td>
                  Jhon Doe
                </td>
                <td>
                  add santa to document
                </td>
                <td class="text-center">
                  <i class="fas fa-arrow-circle-down"></i>
                </td>
              </tr>
              <tr>
                <td>
                  21 Nov 2020, 22.01
                </td>
                <td>
                  Jhon Doe
                </td>
                <td>
                  add santa to document
                </td>
                <td class="text-center">
                  <i class="fas fa-arrow-circle-down"></i>
                </td>
              </tr>

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
@endsection
