@extends('layout/mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                data-target="#modal_newproject">New project</button>
        </div>

        <div class="row mb-3 ml-1">
            <div class="owl-carousel owl-theme">
                @foreach ($projectList->sortBy(fn($p, $key) => $p->project->remainingTime()['second']) as $item)
                    <div class="item" style="width: 340px">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h5 font-weight-bold text-primary text-uppercase mb-1">
                                            {{ $item->project->projectName }}
                                        </div>

                                        <div class="row">
                                            <div class="col-7 h6 mb-0 font-weight-bold text-gray-800">Due Date:
                                                <br>{{ substr($item->project->projectDueDate, 0, 10) }}
                                            </div>
                                            <div class="col-5 h2">
                                                @if ($item->project->remainingTime()['unit'] != null)
                                                    {{ $item->project->remainingTime()['time'] }}<span class="text-xs">
                                                        {{ $item->project->remainingTime()['unit'] }}
                                                        Left</span>
                                                @else
                                                    --
                                                    <span class="text-xs">
                                                        Left
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- Ongoing Project --}}

        </div>

        <div class="row">
            {{-- Left Side --}}
            <div class="col-xl-12">
                {{-- latest upload --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h2 class="m-0 font-weight-bold text-primary">Latest update</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <table id="tbl_latest" class="table">
                                <thead>
                                    <tr>
                                        <th>Project Name</th>
                                        <th>Time Uploaded</th>
                                        <th>Uploaded by</th>
                                        <th>Filename</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projectList as $item)
                                        @foreach ($item->project->file->sortByDesc('created_at') as $file)
                                            <tr>
                                                <td>{{ $item->project->projectName }}</td>
                                                <td>{{ $file->created_at }}</td>
                                                <td>{{ $file->user->name }}</td>
                                                <td>{{ $file->fileName }}</td>
                                                <td>{{ $file->description }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End of Left Side --}}

        </div>

    </div>
    {{-- Modal --}}
    <div class="modal fade" id="modal_newproject" tabindex="-1" aria-labelledby="modal_newproject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('createProject') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
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
            $(".owl-carousel").owlCarousel({
                items: 3,
                margin: 0,
                loop: false,
                autowidth: true,
                autoplay: true,
                autoplayTimeout: 3000,
                rewind: true,
                responsive: {
                    1000: {
                        items: 3
                    },
                    600: {
                        items: 2,
                    },
                    500: {
                        items: 1,
                    }
                }
            });

            $('#tbl_latest').DataTable({
                paging: false,
                searching: false,
            });
        });

    </script>

@endsection
