@extends('layouts.main')
@section('content')

<div class="main-container">
    <!-- Page header start -->
    <div class="page-title">
        <div class="row gutters">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <h5 class="title">Welcome Dear <strong>{{$key}}</strong></h5>
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
                                            <th>№ </th>
                                            <th>File Name</th>
                                            <th>Type</th>
                                            <th>Size</th>
                                            <th>Url</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($files as $i => $item)
                                        <tr>
                                            <td>{{$i+1}}</td>
                                            <td>{{$item->file_name}}</td>
                                            <td>{{$item->file_type}}</td>
                                            @php
                                            $SizeFile = $item->file_size / 1024 / 1024
                                            @endphp
                                            <td>{{ substr($SizeFile, 0, 5). 'MB' }}</td>
                                            <td><a href="{{ asset($item->file_url_name)}}" class="text-info">Get
                                                    Link</a></td>
                                            <td><a href="#" class="text-info">Edit</a></td>
                                        </tr>
                                        @endforeach
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