@extends('layout.app')
@section('content')
    <div class="main-content container-fluid">



        <div class="user-info-list panel panel-default">
            <div class="panel-heading panel-heading-divider"><b>{{$case->title}} </b><span class="panel-subtitle">{{$case->topic->title}} - {{$case->category->title}}</span></div>
            <div class="panel-body">
                <table class="no-border no-strip skills">
                    <tbody class="no-border-x no-border-y">
                    <tr>
                        <td class="icon"><span class="mdi mdi-account-box"></span></td>
                        <td class="item dubito-meta">Created By<span class="icon s7-portfolio"></span></td>
                        <td>{{$case->user->name or ""}}</td>
                    </tr>
                    <tr>
                        <td class="icon"><span class="mdi mdi-calendar"></span></td>
                        <td class="item dubito-meta">Created at<span class="icon s7-gift"></span></td>
                        <td>{{$case->created_at}}</td>
                    </tr>
                    <tr>
                        <td class="icon"><span class="mdi mdi-calendar"></span></td>
                        <td class="item dubito-meta">Updated at<span class="icon s7-gift"></span></td>
                        <td>{{$case->updated_at}}</td>
                    </tr>
                    <tr>
                        <td class="icon"><span class="mdi mdi-check"></span></td>
                        <td class="item dubito-meta">Status<span class="icon s7-gift"></span></td>
                        <td>{{$case->status}}</td>
                    </tr>
                    <tr>
                        <td class="icon"><span class="mdi mdi-tag"></span></td>
                        <td class="item dubito-meta">Tags<span class="icon s7-gift"></span></td>
                        <td>  <form action="{{route('case.tag.store',$case->id)}}" method="post" class="form-inline">
                                <div class="form-group">
                                    <select name="tags[]" multiple="multiple" class=" form-control tags">
                                        @foreach($allTags as $tag)
                                            @if(in_array($tag->id,$selectedTags))
                                                <option value="{{$tag->id}}" selected>{{$tag->title}}</option>
                                            @else
                                                <option value="{{$tag->id}}">{{$tag->title}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                            </form></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>



        <div class="panel panel-default panel-table">
            <div class="panel panel-default">
                <div class="panel-heading">Reports</div>

                <div class="panel panel-default panel-table">
                    <div class="panel-body">
                        <table class="table table-condensed table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Source</th>
                                <th>Account Name</th>
                                <th>text</th>
                                <th>status</th>
                                <th>created_at</th>
                                <th>updated_at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($case->reports as $reports)
                            <tr>
                                <td>{{$reports->id}}</td>
                                <td>{{$reports->source}}</td>
                                <td>{{$reports->accound_name}}</td>
                                <td>{{$reports->text}}</td>
                                <td>{{$reports->status}}</td>
                                <td>{{$reports->created_at}}</td>
                                <td>{{$reports->updated_at}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>


            </div>
        </div>
        </div>



@endsection
@section("script")
    <script>
        $(".tags").select2({width: '240px'});

        $('.tags').on('change',function(){
            var tags = $('.tags').val();

            $.ajax({
                url:"{{route('case.tag.store',$case->id)}}",
                method:"post",
                data:{tags:tags},
                success:function(response){
                    console.log(response);
                }


            })
        });

    </script>
@endsection