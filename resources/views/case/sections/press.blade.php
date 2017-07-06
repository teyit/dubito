<div class="panel panel-default panel-table">
    <div class="panel panel-default">
        <div class="panel-heading">
            Press results
        </div>
        <table class="table table-condensed table-striped">
            <thead>
            <tr>
                <th>Title</th>
                <th>Source</th>
                <th>Created at</th>
                <th class="actions"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($case->press() as $p)
                <tr>
                    <td>{{$p['title']}}</td>
                    <td>{{parse_url($p['url'],PHP_URL_HOST)}}</td>
                    <td>{{date("d-m-Y  H:i",strtotime($p['date']))}}</td>

                    <td>

                        <button type="button" class="btn btn-space btn-default">
                            <i class="icon mdi mdi-archive"></i>
                        </button>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>