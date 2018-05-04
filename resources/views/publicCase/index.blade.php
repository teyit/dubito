@extends('layout.publicCases')
@section('content')
<div class="main-content container-fluid"  style="padding:0">
<div class="search-container" style="padding-top:16px;padding-bottom:16px">
                <form class="input-group input-group-sm">

                    <input  id="q" type="text" name="search" value="{{ app('request')->input('search') }}
" placeholder="İddia Ara..." class="form-control search-input"><span class="input-group-btn">
                  <button type="submit" class="btn btn-primary" style="padding-left:32px;padding-right:32px">Ara</button></span>
                  <span class="input-group-btn" style="margin-left:8px">
                  <button style="margin-left:8px" type="button" class="btn btn-primary" onClick="window.location.reload()">Güncelle</button></span>
                  </form>
            </div>
    <div class="row">
        <div class="col-sm-12" style="padding:0">
            <div class="panel panel-default panel-table">
                <div class="panel-body">
                    <table id="case-datatable" class="table case-datatable">
                        <thead>
                            <tr>
                                <th >İddia</th>
                                <th >Hazırlayan</th>
                                <th >Durum</th>
                                
                                <th >Kategori</th>
                                <th >Oluşturulma Tarihi</th>
                            </tr>
                        </thead>

                        <tfoot>
                        <tr>
                        <th>İddia</th>
                        <th>Hazırlayan</th>
                        <th>Durum</th>    
                        <th>Kategori</th>
                        <th>Oluşturulma Tarihi</th>
                        </tr>
                        </tfoot>

                        <tbody>

                        @foreach($cases as $case)

                            <tr>
                                <td>
                               
                                <span >{{$case->title}}</span>
                                </td>
                                <td>
                                    @if($case->user)
                                    <span>{{$case->user->name}}</span>
                                    @else
                                        <span style="color:#999999"><i>Kişi Atanmadı</i></span>
                                @endif
                                @if($case->status==="verified")
                                
                                @if($case->is_published === 1 && $case->published_link )
                                <td style="min-width: 100px;display:flex;align-items:center">
                                    <a target="_blank" data-title="Select status" data-value="{{$case->status}}" data-pk="{{$case->id}}"  data-type="select" href="{{$case->published_link}}" class="editable editable-click case-status-editable case-status-{{$case->status}}">
                                        <div style="display:flex;align-items:center">    
                                            <span>Sonuçlandı</span>
                                            <i style="margin-top:4px;font-size:18px;margin-left:4px" class="material-icons">&#xE895;</i>
                                        </div>
                                    </a>
                                    </td>
                                    @else
                                    <td style="min-width: 100px">
                                    <a data-title="Select status" data-value="{{$case->status}}" data-pk="{{$case->id}}"  data-type="select" href="#" class="editable editable-click case-status-editable case-status-{{$case->status}}">
                                            <span>Sonuçlandı</span>
                                    </a>
                                    </td>
                                    @endif
                                
                                @elseif($case->status==="in_progress")
                                <td style="min-width: 100px">
                                    <a data-title="Select status" data-value="{{$case->status}}" data-pk="{{$case->id}}"  data-type="select" href="#" class="editable editable-click case-status-editable case-status-{{$case->status}}">İnceleniyor</a>
                                </td>
                                @elseif($case->status==="no_analysis")
                                <td style="min-width: 100px;display:flex;align-items:center">
                                    <ahref="#" data-toggle="popover" title="Sebep" data-content="{{$case->no_analysis_reason}}" href="#" class="editable editable-click case-status-editable case-status-{{$case->status}}">
                                        <div style="display:flex;align-items:center">    
                                            <span>Sonuçlanamadı</span>
                                            <i style="margin-top:6px;font-size:18px;margin-left:4px" class="material-icons">&#xE8FD;</i>
                                        </div>
                                    </a>
                                </td>
                                @else
                                <td style="min-width: 100px">
                                    <a data-title="Select status" data-value="{{$case->status}}" data-pk="{{$case->id}}"  data-type="select" href="#" class="editable editable-click case-status-editable case-status-{{$case->status}}">{{$case->statusLabels[$case->status] or ""}}</a>
                                </td>
                                @endif
                                <td>{{$case->category->title or ""}}</td>
                                <td>{{$case->created_at->format("d-m-Y h:i")}}</td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div style="margin-left:20px;">{{$cases->appends($_GET)->links()}}</div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();   
        });
    
    window.addEventListener('message', function (event) {
    // Need to check for safty as we are going to process only our messages
    // So Check whether event with data(which contains any object) contains our message here its "FrameHeight"
   if (event.data == "FrameHeight") {

        //event.source contains parent page window object 
        //which we are going to use to send message back to main page here "abc.com/page"
        
        //parentSourceWindow = event.source;
        
        //Calculate the maximum height of the page
        var body = document.body, html = document.documentElement;
        var height = Math.max(body.scrollHeight, body.offsetHeight,
            html.clientHeight, html.scrollHeight, html.offsetHeight);
       
       // Send height back to parent page "abc.com/page"
        event.source.postMessage({ "FrameHeight": height }, "*");       
    }
});
    </script>
</div>
@endsection
