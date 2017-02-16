@extends('layout.app')
@section("content")

        <div class="page-head">
            <h2 class="page-head-title">Cases</h2>
        </div>
        <div class="main-content container-fluid">
            <!--Basic forms-->
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-heading panel-heading-divider">Case<span class="panel-subtitle">Add Case</span></div>
                        <div class="panel-body">
                            <form method="post" action="{{route("cases.store")}}">
                                {{ csrf_field() }}
                                <div class="form-group xs-pt-10">
                                    <label>Title</label>
                                    <input type="text" name="title" value="" required placeholder="Enter case title" class="form-control">
                                </div>
                                <div class="form-group xs-pt-10">
                                    <label>Select Topic</label>
                                    <select name="topic_id" class="form-control">
                                        @foreach($topics as $topic)
                                        <option value="{{$topic->id}}">{{$topic->title}}</option>
                                        @endforeach
                                    </select>
                                 </div>
                                <div class="form-group xs-pt-10">
                                    <button type="submit" class="btn btn-space btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default panel-table">
                        <div class="panel-heading">Case List
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Topic</th>
                                    <th class="actions"></th>
                                    <th class="actions"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cases as $case)
                                <tr>
                                    <td>{{$case->title}}</td>
                                    <td>{{$case->topic->title}}</td>
                                    <td class="actions"><a href="{{route("cases.edit",$case->id)}}" class="icon"><i class="mdi mdi-edit"></i></a></td>
                                    <td class="actions">
                                        <form method="post" action="{{route("cases.destroy",$case->id)}}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                           <button class="btn btn-danger btn-xs"><i class="mdi mdi-delete"></i></button>
                                        </form>
                                    </td>
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