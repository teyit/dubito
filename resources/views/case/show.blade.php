@extends('layout.app')
@section('content')
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-md-8">
                @include('case.sections.main',$case)
                @include('case.sections.images',$case)
                @include('case.sections.links',$case)
                @include('case.sections.reports',$case)
                @include('case.sections.press',$case)
            </div>
            <div class="col-md-4">
                @include('case.sections.evidence',$case)
            </div>
        </div>
    </div>
    @include('case.partials.create_link_modal')
    @include('case.partials.edit_link_modal')
    @include('report.partials.assign_to_case_modal')
@endsection
@section("script")
    <script src="{{asset('assets/lib/jquery.magnific-popup/jquery.magnific-popup.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/lib/masonry/masonry.pkgd.min.js')}}" type="text/javascript"></script>
    @include('case.partials.js')
@endsection