@extends('layout.app')
@section("content")

        <div class="page-head">
            <h2 class="page-head-title">Tags</h2>
        </div>
        <div class="main-content container-fluid">
            <!--Basic forms-->
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-heading panel-heading-divider">Tag<span class="panel-subtitle">{{$type == "create" ? "Add" : "Edit"}} Tag</span></div>
                        <div class="panel-body">
                         @include("tag._form")
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default panel-table">
                        <div class="panel-heading">Tag List
                        </div>
                        <div class="panel-body">
                           @include("_list")
                        </div>
                </div>
            </div>


        </div>
    </div>

@endsection