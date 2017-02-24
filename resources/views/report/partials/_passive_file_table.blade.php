<div class="panel panel-default panel-table">
    <div class="panel-body">
        <table class="table table-condensed table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Report</th>
                <th>File Type</th>
                <th>File</th>
                <th class="actions">Activate</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reportfiles as $rfile)
                @if($rfile->status == 0)
                    <tr>
                        <td>{{$rfile->id}}</td>
                        <td>{{$rfile->report->title or "no report title"}}</td>
                        <td>{{$rfile->file_type or "no file type"}}</td>
                        <td>
                            @if(explode('/',$rfile->file_type)[0] == 'image')
                            <img src="{{Storage::disk('s3')->url($rfile->file_url)}}" alt="">
                            @else
                            <a href="{{Storage::disk('s3')->url($rfile->file_url)}}">Download File</a>
                            @endif
                        </td>
                        <td class="actions">
                            <form action="{{route('report_files.status',$rfile->id)}}" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="PUT">
                                <button  class="btn btn-success">Activate</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach

            </tbody>
        </table>
    </div>

</div>
