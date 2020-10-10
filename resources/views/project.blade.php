@extends('layout/mainlayout')

@section('content')
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
          <button class="btn btn-primary btn-sm">Upload File</button>
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
@endsection
