@extends('layout.app')
@section('content')
<div class="main-content container-fluid report-modal">
    <div class="row">
        <div class="col-md-8">
            @foreach($reports as $report)
                <div class="panel panel-flat">
                    <div class="panel-heading">
                    <a data-toggle="modal" data-target="#myModal2" href="">
                        <b><span>@</span>{{$report->account_name}}</b> - {{substr($report->description,0,50)}}... 
                        <div class="tools">
                            
                        </div>
                    </a></div>
                    <div class="panel-body">
                        {{$report->description}}
                    </div>
                    <div class="panel-footer clearfix">
                        {{$report->created_at->diffForHumans()}} / {{$report->source}}
                        <div class="tools">
                         <button class="btn btn-space btn-success btn-sm"><i class="icon icon-left mdi mdi-cloud-done"></i> Assign to a case</button>
                         <button class="btn btn-space btn-danger btn-sm"><i class="icon icon-left mdi mdi-cloud-done"></i> Archive</button>
                         &nbsp;
                        </div>
                        
                    </div>
                </div>            
            @endforeach
            @for($i=0;$i<10;$i++)
                <div class="panel panel-flat">
                    <div class="panel-heading"><a data-toggle="modal" data-target="#myModal2" href="">IŞİD'li Ebu Hanzala’nın Ankara’da konferans vereceği iddiası doğru mu ?</a></div>
                    <div class="panel-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam at atque dolor, ducimus eum exercitationem facilis iste laborum magni nulla officiis, quam temporibus totam! Alias ipsum officia quam sed voluptatibus!
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog custom-width" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <div class="tab-navigation">
                    <ul role="tablist" class="nav nav-tabs nav-justified">
                        <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab" aria-expanded="true">Description</a></li>
                        <li role="presentation" class=""><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab" aria-expanded="false">Files</a></li>
                    </ul>
                </div>
            </div>

            <div class="modal-body">
                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </p>
            </div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->


{{--<div class="panel panel-default panel-table">--}}
    {{--<div class="panel-heading">Reports--}}
       {{--&nbsp;  <a href="/reports/create" class="btn btn-success"> Add Report</a>--}}
    {{--</div>--}}
    {{--<div class="panel-body">--}}
        {{--<table class="table">--}}
            {{--<thead>--}}
            {{--<tr>--}}
                {{--<th>ID</th>--}}
                {{--<th>Detail</th>--}}
                {{--<th>Title</th>--}}
                {{--<th>Case</th>--}}
                {{--<th>Created At</th>--}}
                {{--<th class="actions">Edit</th>--}}
                {{--<th class="actions">Delete</th>--}}
            {{--</tr>--}}
            {{--</thead>--}}
            {{--<tbody>--}}
            {{--@foreach($reports as $report)--}}
                {{--<tr>--}}
                    {{--<td>{{$report->id}}</td>--}}
                    {{--<td><a href="{{route('reports.show',$report->id)}}" class="icon"><i class="mdi mdi-arrow-right"></i></a></td>--}}
                    {{--<td><b><a href="{{route('reports.show',$report->id)}}"> {{$report->title}}</a></b></td>--}}
                    {{--<td>{{$report->cases->title or  "There is no case"}}</td>--}}
                    {{--<td>{{$report->created_at}}</td>--}}
                    {{--<td class="actions"><a href="{{route("reports.edit",$report->id)}}" class="icon"><i class="mdi mdi-edit"></i></a></td>--}}
                    {{--<td class="actions">--}}
                        {{--<form method="post" action="{{route("reports.destroy",$report->id)}}">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--{{ method_field('DELETE') }}--}}
                            {{--<button class="btn btn-danger btn-xs"><i class="mdi mdi-delete"></i></button>--}}
                        {{--</form>--}}
                    {{--</td>--}}
                {{--</tr>--}}
            {{--@endforeach--}}

            {{--</tbody>--}}
        {{--</table>--}}
    {{--</div>--}}
{{--</div>--}}
</div>
@endsection