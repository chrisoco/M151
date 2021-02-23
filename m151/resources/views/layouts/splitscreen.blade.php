@extends('layouts.app')
@section('content')
    <h2 class="mt-3 mb-4 text-center">
        @yield('title')
    </h2>

    <style>
        @media (min-width: 768px) {
            .col-md-border:not(:last-child) {
                border-right: 2px solid #d7d7d7;
            }
            .col-md-border + .col-md-border {
                border-left: 2px solid #d7d7d7;
                margin-left: -1px;
                padding-left: 30px;
            }
        }
    </style>

    <div class="container-fluid p-0">
        <div class="row" style="height: 78vh;">

            <div class="col-md-6 col-md-border d-flex justify-content-end mb-5 pr-5">

                <div class="h-100 d-inline-block mt-4">

                    @yield('contentLeft')

                </div>

            </div>

            <div class="col-md-6 col-md-border d-flex mb-5 pl-5">

                <div class="h-100 d-inline-block mt-4">

                    @yield('contentRight')

                </div>

            </div>

        </div>

    </div>
@endsection
