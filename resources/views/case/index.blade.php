@extends('layout.app')
@section('content')
<div class="main-content container-fluid">

<div class="panel panel-default panel-table">
    <div class="panel-heading">Case List &nbsp;<button  data-toggle="modal"  data-target="#case-create" class="btn btn-success">Add Case</button>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Topic</th>
                <th class="actions">Edit</th>
                <th class="actions">Delete</th>
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
@endsection

@include('case.partials.create_modal')