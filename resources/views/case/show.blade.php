@extends('layout.app')
@section('content')
    <div class="main-content container-fluid">

        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="">
                                    <div class="row panel-heading panel-heading-divider">
                                        <div class="col-md-8" style="padding:0">
                                            {{$case->title}}@if($case->google_document_id) <a target="_blank"
                                                                                              class="btn btn-primary new-google-document"
                                                                                              href="https://docs.google.com/document/d/{{$case->google_document_id}}/edit">Go
                                                to Analysis</a>@endif
                                            <span class="panel-subtitle" style="margin-top:5px;">
																					<span style="margin-right:10px; display:inline-block"><span
                                                                                                style="margin-right:5px;"
                                                                                                class="mdi mdi-calendar"></span> Created at: {{$case->created_at}}</span>
																					<span class="mdi mdi-calendar"></span> Updated at: {{$case->updated_at}}
																				</span>
                                        </div>
                                        <div class="col-md-4 text-right" style="padding:0">
																			<span class="">
																				<div class="btn-group btn-hspace">
																						<button type="button"
                                                                                                data-toggle="dropdown"
                                                                                                class="btn btn-primary case-status-dropdown case-status-dropdown">
																								 @if($case->status == 'completed')
                                                                                                Completed
                                                                                            @elseif($case->status == 'in_progress')
                                                                                                In Progress
                                                                                            @elseif($case->status == 'no_analysis')
                                                                                                No Analysis
                                                                                            @elseif($case->status == 'cancelled')
                                                                                                Cancelled
                                                                                            @elseif($case->status == 'suspended')
                                                                                                Suspended
                                                                                            @elseif($case->status == 'to_be_tweeted')
                                                                                                To be Tweeted
                                                                                            @elseif($case->status == 'pending')
                                                                                                Pending
                                                                                            @endif
                                                                                            <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
																						<ul role="menu"
                                                                                            class="dropdown-menu case-status-menu">
																								<li><a href="#"
                                                                                                       id="completed">Completed</a></li>
																								<li><a href="#"
                                                                                                       id="no_analysis">No Analysis</a></li>
																								<li><a href="#"
                                                                                                       id="in_progress">In Progress</a></li>
																								<li><a href="#"
                                                                                                       id="cancelled">Cancelled</a></li>
																								<li><a href="#"
                                                                                                       id="suspended">Suspended</a></li>
																								<li><a href="#"
                                                                                                       id="to_be_tweeted">To be Tweeted</a></li>
																								<li><a href="#"
                                                                                                       id="pending">Pending</a></li>
																						</ul>
																				</div></span><span class=""><button
                                                        data-status="{{$case->is_archived}}"
                                                        class="btn btn-{{$case->is_archived == 'archived' ? 'danger' : "warning"}} case-is-archived-btn">{{$case->is_archived == 'archived' ? 'Remove Archive' : "Send to Archive"}}</button></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="padding:0 0 0 20px; margin-bottom:5px;">
                                    <div class="col-md-6">
                                        <span class="mdi mdi-account"></span><strong style="padding-left:10px;">Assign
                                            User: </strong><a id="assign-user-case" data-title="Assign user to case"
                                                              data-value="{{$case->user->id}}" data-type="select"
                                                              href="#"
                                                              class="editable editable-click">{{$case->user->name or ''}}</a>
                                        {{--<select name="" id="" class="form-control assign-user-to-case input-xs" style="width:auto;">--}}
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <span class="md-mr-20"><span
                                                    class="mdi mdi-check"></span> {{$case->category->title}}</span>
                                        <span class="md-mr-20"><span
                                                    class="mdi mdi-labels"></span> {{$case->topic->title}}</span>
                                    </div>
                                </div>
                                {{--<span class="md-mr-20"><span class="mdi mdi-collection-text"></span> {{$case->reports->count()}} Reports</span>--}}
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Tags</div>
                                <div class="panel-body">
                                    <form action="{{route('case.tag.store',$case->id)}}" method="post"
                                          class="form-inline select2">
                                        <div class="form-group" style="width:100%;">
                                            <select name="tags[]" multiple="multiple" class="form-control tags">
                                                @foreach($allTags as $tag)
                                                    @if(in_array($tag->id,$selectedTags))
                                                        <option value="{{$tag->id}}" selected>{{$tag->title}}</option>
                                                    @else
                                                        <option value="{{$tag->id}}">{{$tag->title}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="panel-heading">Description</div>
                                <div class="panel-body">
                                    <form id="case-description-form">
                                        <div class="form-group">
                                            <textarea name="description" id="description-ta" rows="6" class="form-control"
                                                      id="case-description">{{$case->description or ''}}</textarea>
                                        </div>
                                        <div class="form-group pull-right">
                                            <button data-case-id="{{$case->id}}" class="btn btn-success">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">Images</div>
                    <div class="panel-body">
                        <div class="gallery-container">
                            @foreach($case->files as $file)
                                <div class="item">
                                    <div class="photo">
                                        <div class="img"><img src="{{ConverterFileLink($file->file_url)}}"
                                                              alt="Gallery Image">
                                            <div class="over">
                                                <div class="info-wrapper">
                                                    <div class="info">
                                                        <div class="func"><a class="remove-file-from-case"
                                                                             data-file-id="{{$file->id}}"
                                                                             href="javascript:;"><i
                                                                        class="icon mdi mdi-delete"></i></a><a
                                                                    href="{{ConverterFileLink($file->file_url)}}"
                                                                    class="image-zoom"><i
                                                                        class="icon mdi mdi-search"></i></a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>


                <div class="panel panel-default panel-table">
                    <div class="panel panel-default">

                        <div class="panel-heading">Links &nbsp;<button data-toggle="modal"
                                                                       data-target="#case-link-create"
                                                                       class="btn btn-success btn-sm btn-link-modal">Add
                                Link
                            </button>
                        </div>
                        @if(!$links->isEmpty())
                            <table class="table table-condensed table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Link</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="actions"></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($links as $link)
                                    <tr>

                                        <td>{{$link->id}}</td>
                                        <td id="list-link-{{$link->id}}">{{$link->link}}</td>
                                        <td>{{$link->created_at}}</td>
                                        <td>{{$link->updated_at}}</td>
                                        <td>
                                            <div class="btn-group btn-space">
                                                <button type="button" data-toggle="dropdown" class="btn btn-default"
                                                        aria-expanded="false"><span class="mdi mdi-chevron-down"></span><span
                                                            class="sr-only">Toggle Dropdown</span>&nbsp;
                                                </button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li><a class="link-edit-btn" href="javascript:;"
                                                           data-id="{{$link->id}}">Edit</a></li>
                                                    <li><a class="link-delete" data-id="{{$link->id}}"
                                                           href="javascript:;">Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-default" role="alert">
                                There are no links in this case
                            </div>
                        @endif
                    </div>
                </div>

                <div class="panel-heading">Reports</div>

                @foreach($case->reports as $report)
                    <div class="panel panel-border-color panel-border-color-info">

                        <div class="timeline-content">
                            <div class="timeline-avatar"><img src="/assets/img/avatar1.png"
                                                              alt="{{$report->account_name}}" class="circle"></div>
                            {{-- <div class="timeline-avatar"><img src="{{$report->account_picture}}" alt="{{$report->account_name}}" class="circle"></div> --}}
                            <div class="timeline-header">
                                <!--<span class="timeline-time">4:34 PM</span>-->
                                <div><p class="timeline-autor">Deneme Account Name {{$report->account_name}}</p></div>
                                <p class="timeline-activity">{{$report->text}}</p>
                            </div>
                            <div class="timeline-gallery">
                                @foreach($report->files as $f)
                                    <div class="gallery-container">
                                        <div class="item">
                                            <div class="photo">
                                                <div class="img"><img src="{{$f->file_url}}" alt="Gallery Image">
                                                    <div class="over">
                                                        <div class="info-wrapper">
                                                            <div class="info">
                                                                <div class="func"><a class="add-file-to-case"
                                                                                     data-file-id="{{$f->id}}"
                                                                                     href="javascript:;"><i
                                                                                class="icon mdi mdi-plus"></i></a><a
                                                                            href="{{$f->file_url}}"
                                                                            class="image-zoom"><i
                                                                                class="icon mdi mdi-search"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<img src="{{$f->file_url}}" alt="Thumbnail" class="gallery-thumbnail">--}}
                                @endforeach
                            </div>
                        </div>

                        <div class="panel-footer clearfix">
                            {{$report->created_at->diffForHumans()}} / {{$report->source}}
                            <div class="tools">

                                {{--<button  data-id="{{$report->id}}"  class="btn btn-space btn-success btn-sm report-assign-case"><i class="icon icon-left mdi mdi-cloud-done"></i> Assign to a case</button>--}}
                                {{--<button class="btn btn-space btn-danger btn-sm"><i class="icon icon-left mdi mdi-cloud-done"></i> Archive</button>--}}
                                {{--&nbsp;--}}
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>


            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Add New Evidence</div>
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
                    <div class="panel-heading panel-heading-divider">Evidences<span class="panel-subtitle"></span></div>
                    <div class="panel-body">

                        @if(!$case->evidences->isEmpty())
                            <ul class="user-timeline">

                                @foreach($case->evidences as $evidence)
                                    <li class="latest">
                                        <span class="timeline-autor">{{$evidence->user->name}}</span> - <span
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
