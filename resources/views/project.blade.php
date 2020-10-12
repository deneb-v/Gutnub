@extends('layout/mainlayout')

@section('content')
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="{{asset('dropzone/dist/min/dropzone.min.css')}}">

<!-- JS -->
<script src="{{asset('dropzone/dist/min/dropzone.min.js')}}" type="text/javascript"></script>



<div class="container-fluid">
  <h1>{{ $project->projectName }}</h1>
  <p>Due date: {{ $project->projectDueDate }}</p>

  <div class="row">
    {{-- Left Side --}}
    <div class="col-xl-6">
      {{-- Colaborator --}}
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h2 class="m-0 font-weight-bold text-primary">Collaborator</h2>
          <button class="btn btn-primary btn-sm">Add Collaborator</button>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-2 align-items-center text-center">
              <button class="btn-circle btn-lg">JD</button>
              <p class="text-center">Jhon Doe</p>
            </div>
            <div class="col-2 align-items-center text-center">
              <button class="btn-circle btn-lg">SS</button>
              <p class="text-center">Shanna S</p>
            </div>
          </div>
        </div>
      </div>
      {{-- End Colaborator --}}

      {{-- Latest Project File --}}
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h2 class="m-0 font-weight-bold text-primary">Latest Project File</h2>
          <button class="btn btn-primary btn-sm" data-toggle='modal' data-target="#modal_uploadfile">Upload File</button>
        </div>
        <div class="card-body">
          <p>
            Uploaded by: <b> Jhon Doe </b> <br>
            Time: <b>21 November 2020, 22.01 </b><br>
            Description: <b>add santa to the document</b> <br>
          </p>

          <div class="col-xl-12 col-md-12 mb-12">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body d-flex flex-row justify-content-between">
                <span> <i class="fas fa-folder"></i>  Merry Chrismas.docx</span>
                <span><i class="fas fa-arrow-circle-down"></i></span>
              </div>
            </div>
          </div>
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


{{-- Modal --}}
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
              <form action="{{ route('user.fileupload') }}" class="dropzone" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{{$project->projectID}}">
                  {{-- {{ csrf_field() }} --}}
                  {{-- <input type="file" name="file" id=""> --}}
                  {{-- <div class="form-group">
                      <label>Project name</label>
                      <input type="text" class="form-control" id="txt_projectName" name="txt_projectName">
                  </div>
                  <div class="form-group">
                      <label>Due date</label>
                      <input type="datetime-local" class="form-control" id="txt_projectDate" name="txt_projectDate">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">New project</button>
                  </div> --}}
              </form>
          </div>
      </div>
  </div>
</div>


    <!-- Script -->
    <script>
      var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
  
      Dropzone.autoDiscover = false;
      var myDropzone = new Dropzone(".dropzone",{ 
          maxFilesize: 3,  // 3 mb
          acceptedFiles: ".jpeg,.jpg,.png,.pdf",
      });
      myDropzone.on("sending", function(file, xhr, formData) {
         formData.append("_token", CSRF_TOKEN);
      }); 
      </script>
@endsection
