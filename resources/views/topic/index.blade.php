@extends('layout.app')
@section('content')
<div class="main-content container-fluid">

<div class="panel panel-default panel-table">
    <div class="panel-heading">Topic List &nbsp;  <button  data-toggle="modal"  data-target="#topic-create" class="btn btn-success">Add Topic</button>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Created At</th>
                <th class="actions">Edit</th>
                <th class="actions">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($topics as $topic)
                <tr>
                    <td>{{$topic->title}}</td>
                    <td>{{$topic->created_at}}</td>
                    <td class="actions"><a class="topic-edit-btn icon" data-id="{{$topic->id}}" href="javascript:;" ><i class="mdi mdi-edit"></i></a></td>
                    <td class="actions">
                        <form method="post" action="{{route("topics.destroy",$topic->id)}}">
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
@endsection

@include('topic.partials.create_modal')
@include('topic.partials.edit_modal')