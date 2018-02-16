<div class="panel panel-default panel-table">
    <div class="panel panel-default">
        <div class="panel-heading panel-heading-divider">
            Links &nbsp;
            <button data-toggle="modal"  data-target="#case-link-create" class="btn btn-success btn-sm btn-link-modal">Add Link</button>
        </div>
        <div class="panel-body">
        @if(!$links->isEmpty())

            <table class="table table-condensed table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th style="width:180px;">Created At</th>
                    <th style="width:270px;" class="actions"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($links as $link)
                    <tr>
                        <td>{{$link->id}}</td>
                        <td><p style="word-wrap: break-word; width:400px; ">
                                {{$link->meta_title}}
                            </p></td>
                        <td>{{$link->created_at}}</td>
                        <td>

                                <div class="btn-group xs-mt-5 xs-mb-10">
                                    <a target="_blank" href="{{$link->teyitlink}}" class="btn btn-default"><span class="mdi mdi-bookmark"></span> Teyitlink</a>
                                    <a target="_blank" href="{{$link->link}}" class="btn btn-default"><span class="mdi mdi-globe-alt"></span> Orginal</a>
                                    <a class="link-delete btn btn-danger" data-id="{{$link->id}}" href="javascript:;"><span class="mdi mdi-delete"></span> Delete</a>
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
</div>
