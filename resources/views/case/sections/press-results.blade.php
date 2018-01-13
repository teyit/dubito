<table class="table table-condensed table-striped">
    <thead>
    <tr>
        <th style="width:440px;">Title</th>
        <th>Source</th>
        <th style="width:170px;">Created at</th>
        <th style="width:130px;" class="actions"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($results as $p)
        <tr id="press-line-{{$p['id']}}">
            <td><a href="{{$p['url']}}" target="_blank">{{$p['title']}}</a></td>
            <td>{{parse_url($p['url'],PHP_URL_HOST)}}</td>
            <td>{{date("d-m-Y  H:i",strtotime($p['date']))}}</td>
            <td>

                <div class="btn-group btn-space">
                    <button data-title="{{$p['title']}}" data-id="{{$p['id']}}" data-url="{{$p['url']}}" data-status="1" type="button" class="press-item btn btn-default">
                        <i class="icon mdi mdi-check"></i>
                    </button>
                    <button data-title="{{$p['title']}}" data-id="{{$p['id']}}" data-url="{{$p['url']}}" data-status="0" type="button" class="press-item btn btn-default">
                        <i class="icon mdi mdi-close"></i>
                    </button>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>