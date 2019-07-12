@extends('layouts.main')
@section('content')

<div class="main-container">
    <!-- Page header start -->
    <div class="page-title">
        <div class="row gutters">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <h5 class="title">Welcome Dear <strong>Jhon</strong></h5>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="daterange-container">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Download CSV"
                        class="download-reports">
                        <i class="icon-download1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page header end -->

    <!-- Content wrapper start -->
    <div class="content-wrapper">
        @if (count($errors) > 0)
        <div class="col-sm-12">
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                <span class="badge badge-pill badge-success">Warnings!</span> {{ $error }}
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
        @if (session('warning'))
        <div class="col-sm-12">
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                <span class="badge badge-pill badge-success">Warnings!</span> {{ session('warning') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif

        <!-- Row start -->
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                @include('files.links')


                <div class="card-body pt-0">
                    <div class="tab-content" id="myTabContent7">
                        <div class="tab-pane fade show active" id="get_types" role="tabpanel"
                            aria-labelledby="home-tab7">


                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Location</th>
                                            <th>Time</th>
                                            <th>Duration</th>
                                            <th>Tags</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                George Orwell
                                            </td>
                                            <td>JPN</td>
                                            <td>10:00am</td>
                                            <td>12 Mins</td>
                                            <td>Lead</td>
                                            <td><a href="#" class="text-info">Edit</a></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Row end -->

    <!-- Content wrapper end -->
</div>
</div>

@endsection