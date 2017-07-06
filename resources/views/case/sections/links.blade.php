<div class="panel panel-default panel-table">
    <div class="panel panel-default">
        <div class="panel-heading">
            Links &nbsp;
            <button data-toggle="modal"  data-target="#case-link-create" class="btn btn-success btn-sm btn-link-modal">Add Link</button>
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