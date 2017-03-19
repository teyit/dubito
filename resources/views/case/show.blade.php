@extends('layout.app')
@section('content')
    <div class="main-content container-fluid">

        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-divider">
                        <div class="row">
                            <div class="col-md-9">
                                <h2 style="font-weight: bold;margin:0px 0px 20px 0px;">{{$case->title}}</h2>

                                <span class="md-mr-20"><span class="mdi mdi-account"></span> {{$case->user->name or ""}}</span>
                                <span class="md-mr-20"><span class="mdi mdi-check"></span> {{$case->category->title or ""}}</span>
                                <span class="md-mr-20"><span class="mdi mdi-account"></span> {{$case->topic->title or ""}}</span>
                                <span class="md-mr-20">
                                    <div class="btn-group btn-hspace">
                                        <button type="button" data-toggle="dropdown" class="btn btn-primary case-status-dropdown case-status-dropdown">
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
                                            @endif
                                            <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                                        <ul role="menu" class="dropdown-menu case-status-menu">
                                            <li><a href="#" id="completed">Completed</a></li>
                                            <li><a href="#" id="no_analysis">No Analysis</a></li>
                                            <li><a href="#" id="in_progress">In Progress</a></li>
                                            <li><a href="#" id="cancelled">Cancelled</a></li>
                                            <li><a href="#" id="suspended">Suspended</a></li>
                                            <li><a href="#" id="to_be_tweeted">To be Tweeted</a></li>
                                        </ul>
                                    </div>
                                </span>
                            </div>
                            <div class="col-md-3">
                                <div class="panel-subtitle" style="float: right;margin-top:10px;">
                                    <p><span class="mdi mdi-calendar"></span> Created at:  {{$case->created_at}}</p>
                                    <p><span class="mdi mdi-calendar"></span> Updated at:  {{$case->updated_at}}</p>
                                </div>
                            </div>
                        </div>

                    </div>



                    <div class="row">

                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Tags</div>
                                <div class="panel-body">
                                    <form action="{{route('case.tag.store',$case->id)}}" method="post" class="form-inline">
                                        <div class="form-group">
                                            <select  name="tags[]" multiple="multiple" class=" form-control tags">
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
                                            <textarea name="description" rows="6" class="form-control" id="case-description">{{$case->description or ''}}</textarea>
                                        </div>
                                        <div class="form-group pull-right">
                                            <button data-case-id="{{$case->id}}" class="btn btn-success">Save</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="panel-heading">Images</div>
                                <div class="panel-body">
                                    <div class="gallery-container">
                                     @foreach($case->files as $file)
                                        <div class="item">
                                            <div class="photo">
                                                <div class="img"><img src="{{$file->file_url}}" alt="Gallery Image">
                                                    <div class="over">
                                                        <div class="info-wrapper">
                                                            <div class="info">
                                                                <div class="title">Boats On The Ocean</div>
                                                                <div class="date">Jun 23 2016</div>
                                                                <div class="func"><a class="remove-file-from-case" data-file-id="{{$file->id}}" href="javascript:;"><i class="icon mdi mdi-delete"></i></a><a href="{{$file->file_url}}" class="image-zoom"><i class="icon mdi mdi-search"></i></a></div>
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
                        </div>
                    </div>
                </div>

                <div class="panel panel-default panel-table">
                    <div class="panel panel-default">

                        <div class="panel-heading">Links &nbsp;<button  data-toggle="modal"  data-target="#case-link-create"  class="btn btn-success btn-sm btn-link-modal" >Add Link</button>
                        </div>
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
                                            <button type="button" data-toggle="dropdown" class="btn btn-default" aria-expanded="false"><span class="mdi mdi-chevron-down"></span><span class="sr-only">Toggle Dropdown</span>&nbsp;</button>
                                            <ul role="menu" class="dropdown-menu">
                                                <li><a class="link-edit-btn" href="javascript:;" data-id="{{$link->id}}" >Edit</a></li>
                                                <li><a class="link-delete" data-id="{{$link->id}}" href="javascript:;">Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>

                <div class="panel-heading">Reports</div>

                @foreach($case->reports as $report)
                    <div class="panel panel-flat">

                        <div class="timeline-content">
                            <div class="timeline-avatar"><img src="{{$report->account_picture}}" alt="{{$report->account_name}}" class="circle"></div>
                            <div class="timeline-header">
                                <!--<span class="timeline-time">4:34 PM</span>-->
                                <div><p class="timeline-autor">{{$report->account_name}}</p></div>
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
                                                        <div class="func"><a class="add-image-to-case" data-file-id="{{$f->id}}" href="javascript:;"><i class="icon mdi mdi-plus"></i></a><a href="{{$f->file_url}}" class="image-zoom"><i class="icon mdi mdi-search"></i></a></div>
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
                                <div class="panel-heading">Evidence</div>
                                <div class="panel-body">
                                    <form id="case-description-form">
                                        <div class="form-group">
                                            <textarea name="description" class="form-control" id="case-description">{{$case->description or ''}}</textarea>
                                        </div>
                                        <div class="form-group pull-right">

                                            <input type="file" name="file-1" id="file-1" data-multiple-caption="{count} files selected" multiple class="inputfile">
                                            <label for="file-1" class="btn-default"> <i class="mdi mdi-attachment"></i><span>Browse files...</span></label>


                                            <button data-case-id="{{$case->id}}" class="btn btn-success">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
        <script src="{{asset('assets/lib/jquery.magnific-popup/jquery.magnific-popup.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/lib/masonry/masonry.pkgd.min.js')}}" type="text/javascript"></script>
    <script>

        $(function(){
             var status = '{{$case->status}}';
            if(status == 'completed'){
                $('.case-status-dropdown').addClass('btn-success');
            }else if(status == 'cancelled'){
                $('.case-status-dropdown').addClass('btn-danger');
            }else if(status == 'in_progress'){
                $(".case-status-dropdown").addClass('btn-warning');
            }else if(status == 'to_be_tweeted'){
                $(".case-status-dropdown").addClass('btn-primary');
            }else if(status == 'no_analysis'){
                $(".case-status-dropdown").addClass('btn-no-analysis');
            } else if(status == 'suspended'){
                $(".case-status-dropdown").addClass('btn-suspended');
            }

            $('.add-image-to-case').on('click',function(){
                var file_id =  $(this).data('file-id');
                $.ajax({
                    method:"post",
                    url:"{{route("case.file.store",$case->id)}}",
                    data:{_token:$("#_token").val(),file_id:file_id},
                    success:function(response){
                        if(!response){
                                $.gritter.add({
                                    title: 'Error',
                                    text: 'this image have already was added',
                                    class_name: 'color danger'
                                });
                        }else{
                            $.gritter.add({
                                title: 'Success',
                                text: 'Image  was added succesfully',
                                class_name: 'color success'
                            });

                            window.location.reload();
                        }
                    }

                });

            });

        });

        $('.remove-file-from-case').on('click',function(){
            var file_id =  $(this).data('file-id');
            $.ajax({
                method:"post",
                url:"{{route("case.file.remove",$case->id)}}",
                data:{_token:$("#_token").val(),file_id:file_id},
                success:function(response){
                    if(response){
                        $.gritter.add({
                            title: 'Success',
                            text: 'Image  was removed succesfully',
                            class_name: 'color success'
                        });

                        window.location.reload();
                    }
                }

            });
        });


        $(".tags").select2({width: '240px',placeholder:"Tags"});

        $('.tags').on('change',function(){
            var tags = $('.tags').val();

            $.ajax({
                url:"{{route('case.tag.store',$case->id)}}",
                method:"post",
                data:{tags:tags},
                success:function(response){
                    console.log(response);
                    if(response){
                        $.gritter.add({
                            title: 'Success',
                            text: 'Tags   was updated succesfully',
                            class_name: 'color success'
                        });
                    }
                }


            })
        });


        $('.link-delete').on('click',function(){
            var that = $(this);
            dubitoConfirm(function(result){
                console.log(result);
                if(result == true){
                    var id =  that.data('id');
                    $.ajax({
                        method:"DELETE",
                        url:"/links/"+id,
                        data:{_token:$("#_token").val()},
                        success:function(data){
                            if(data){
                                window.location.reload();
                            }
                        }
                    })
                }
            });
        });

        $('#case-description-form').on('submit',function(event){
            event.preventDefault();
            $.ajax({
                method:"put",
                url:"{{route('cases.update',$case->id)}}",
                data:$(this).serialize(),
                success:function(response){
                    if(response){
                        $.gritter.add({
                            title: 'Success',
                            text: 'Description was added successfuly',
                            class_name: 'color success'
                        });
                    }
                }
            });

        })

        var a = $(".gallery-container");
        a.masonry({
            columnWidth: 0,
            itemSelector: ".item"
        });


        $('.case-status-menu a').click(function(){
            text = $(this).text() + ' <span class="icon-dropdown mdi mdi-chevron-down"></span>';
            $('.case-status-dropdown').html(text);
            status = $(this).attr('id');


            $('.case-status-dropdown').removeClass('btn-success');
            $('.case-status-dropdown').removeClass('btn-danger');
            $(".case-status-dropdown").removeClass('btn-warning');
            $(".case-status-dropdown").removeClass('btn-primary');
            $(".case-status-dropdown").removeClass('btn-no-analysis');
            $(".case-status-dropdown").removeClass('btn-suspended');

            if(status == 'completed'){
               $('.case-status-dropdown').addClass('btn-success');
           }else if(status == 'cancelled'){
               $('.case-status-dropdown').addClass('btn-danger');
           }else if(status == 'in_progress'){
               $(".case-status-dropdown").addClass('btn-warning');
           }else if(status == 'to_be_tweeted'){
               $(".case-status-dropdown").addClass('btn-primary');
           }else if(status == 'no_analysis'){
               $(".case-status-dropdown").addClass('btn-no-analysis');
           } else if(status == 'suspended'){
               $(".case-status-dropdown").addClass('btn-suspended');
           }


            $.ajax({
                method:"put",
                url:"{{route("case.status.update",$case->id)}}",
                data:{_token:$("#_token").val(),status:status},
                success:function(response){
                    if(response){
                        $.gritter.add({
                            title: 'Success',
                            text: 'Status was update successfuly',
                            class_name: 'color success'
                        });
                    }
                }
            });
        });




    </script>
@endsection