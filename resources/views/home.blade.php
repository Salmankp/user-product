@extends('layouts.app')
@section('content')

<!--===========header start===========-->
    @include('_partials.navbar')

    <!--===========app body start===========-->
    <div class="app-body">

        <!--main contents start-->
        <main class="main-content main_area_width">

            <div class="container-fluid">

                <!--page title start-->
{{--                <div class="page-title pl-0">--}}
{{--                    <h4 class="mb-0"> Home--}}
{{--                    </h4>--}}
{{--                    <ol class="breadcrumb mb-0 pl-0 pt-1 pb-0">--}}
{{--                        <li class="breadcrumb-item active">/home</li>--}}
{{--                    </ol>--}}
{{--                </div>--}}
                <!--page title end-->

                <!--state widget start-->
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                            <span class="bg-primary rounded-circle text-center wb-icon-box">
                                                <i class="icon-people text-light f24"></i>
                                            </span>
                                    </div>
                                    <div class="col-9">
                                        <h6 class="mt-1 mb-0">Total Products</h6>
                                        <p class="f12 mb-0"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                            <span class="bg-primary rounded-circle text-center wb-icon-box">
                                                <i class="icon-people text-light f24"></i>
                                            </span>
                                    </div>
                                    <div class="col-9">
                                        <h6 class="mt-1 mb-0">Total Users</h6>
                                        <p class="f12 mb-0"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--state widget end-->

            </div>
        </main>
        <!--main contents end-->

    </div>
    <!--===========app body end===========-->
    @include('_partials.footer')
@endsection
