@extends('layout/mainlayout')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modal_newproject">New project</button>
    </div>
  <div class="row">
    {{-- Left Side --}}
    <div class="col-xl-6">
      {{-- latest upload --}}
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h2 class="m-0 font-weight-bold text-primary">Latest upload</h2>
        </div>
        <div class="card-body">
          <div class="row">
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
          </div>
        </div>
      </div>
    </div>
    {{-- End of Left Side --}}

    <div class="col-xl-6">
        {{-- latest upload --}}
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h2 class="m-0 font-weight-bold text-primary">Notification</h2>
          </div>
          <div class="card-body">
            <div class="row">
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
            </div>
          </div>
        </div>
      </div>
    </div>


</div>
@endsection
