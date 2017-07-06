@extends('layout.app')
@section('content')
    <div class="main-content container-fluid">

        <div class="row">
            <div class="col-md-8">
                @include('case.sections.main',$case)
                @include('case.sections.images',$case)
                @include('case.sections.links',$case)
                @include('case.sections.press',$case)
                @include('case.sections.reports',$case)
            </div>


            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Add New Comment</div>
                                <div class="panel-body">
                                    <form action="{{route("evidences.store")}}" method="POST" name="evidence-form-ajax"
                                          id="evidence-form-ajax" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <textarea name="text" required class="form-control"
                                                      id="evidence-text">{{$evidence->text or ''}}</textarea>
                                        </div>
                                        <div class="form-group pull-left">
                                            <ul class="evidence-file-name">
                                            </ul>

                                        </div>
                                        <div class="form-group pull-right">

                                            <input type="hidden" name="case_id" value="{{$case->id}}">
                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                                            <input type="file" name="file[]" id="file-1"
                                                   data-multiple-caption="{count} files selected" multiple
                                                   class="inputfile evidence-file">
                                            <label for="file-1" class="btn-default"> <i
                                                        class="mdi mdi-attachment"></i><span>Browse files...</span></label>

                                            <input type="hidden" name="case_id" value="{{$case->id}}">
                                            <button data-case-id="{{$case->id}}" class="btn btn-success">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-divider">Comments<span class="panel-subtitle"></span></div>
                    <div class="panel-body">

                        @if(!$case->evidences->isEmpty())
                            <ul class="user-timeline">

                                @foreach($case->evidences as $evidence)
                                    <li class="latest">
                                        <span class="timeline-autor">{{$evidence->user->name or "Deleted User"}}</span> - <span
                                                style="color:#8c8c8c;padding-left:5px;">{{\Carbon\Carbon::parse($evidence->created_at)->format("d.m.Y")}}</span>
                                        <div class="user-timeline-description">{{$evidence->text or ''}}</div>
                                        <div class="gallery-container evidence-gallery-container">
                                            @foreach($evidence->files as $file)
                                                <div class="item">
                                                    <div class="photo">
                                                        <div class="img"><img class="img-respınsive"
                                                                              src="{{Storage::disk('s3')->url($file->file_url)}}"
                                                                              alt="Gallery Image">
                                                            <div class="over">
                                                                <div class="info-wrapper">
                                                                    <div class="info">
                                                                        <div class="func evidence-func"><a
                                                                                    class="add-file-to-case"
                                                                                    data-file-id="{{$file->id}}"
                                                                                    href="javascript:;"><i
                                                                                        class="icon mdi mdi-plus"></i></a><a
                                                                                    href="{{Storage::disk('s3')->url($file->file_url)}}"
                                                                                    class="image-zoom"><i
                                                                                        class="icon mdi mdi-search"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>


            </div>
        </div>


    </div>


    @include('case.partials.create_link_modal')
    @include('case.partials.edit_link_modal')
    @include('report.partials.assign_to_case_modal')


@endsection
@section("script")
    <script src="{{asset('assets/lib/jquery.magnific-popup/jquery.magnific-popup.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/lib/masonry/masonry.pkgd.min.js')}}" type="text/javascript"></script>
    @include('case.partials.js')
    <style>

        .select2-container--default .select2-selection--multiple, .select2-container--default .select2-selection--single {
            border: .153846rem solid #ebebeb;
            border-radius: 0
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding: 0 15px;
            height: 2.923078rem;
            line-height: 2.923078rem;
            font-size: 1.077rem;
            color: #878787
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 3.076924rem;
            width: 30px
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border: 0;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            margin: 0
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b:after {
            content: "";
            font-family: "Stroke 7";
            font-size: 25px;
            font-weight: 400;
            line-height: 3.076924rem;
            color: #878787
        }

        .select2-container--default .select2-selection--multiple {
            min-height: 42px;
            line-height: 1
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            padding: 4px 12px;
            min-height: 3.23077rem
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            border-radius: 0;
            background-color: #f2f2f2;
            color: #6e6e6e;
            border-width: 0;
            padding: 4px 6px;
            line-height: 18px
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #7a7a7a;
            margin-right: 3px
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #616161
        }

        .select2-container--default .select2-selection--multiple .select2-search--inline .select2-search__field {
            line-height: 2
        }

        .select2-container--default.select2-container--default.select2-container--focus .select2-selection--multiple {
            border: .153846rem solid #ebebeb
        }

        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b:after {
            content: ""
        }

        .select2-container--default .select2-results__group {
            font-size: 12px;
            color: #6e6e6e
        }

        .select2-container--default .select2-results__option {
            padding: 10px 6px
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #f7f7f7
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #2cc185
        }

        .select2-container--default .select2-dropdown {
            border-width: .153846rem;
            border-color: #ebebeb
        }

        .select2-container--default .select2-dropdown--above, .select2-container--default .select2-dropdown--below {
            border-radius: 0;
            -webkit-box-shadow: none;
            box-shadow: none
        }

        .select2-container--default .select2-search--dropdown {
            background-color: #fff;
            border-bottom: .153846rem solid #ebebeb
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            background-color: transparent;
            border-width: 0;
            outline: 0
        }
    </style>
@endsection
