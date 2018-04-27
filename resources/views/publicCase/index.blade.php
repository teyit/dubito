@extends('layout.publicCases')
@section('content')
<div class="main-content container-fluid"  style="padding:0">
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
                                            <span style="color:white !important">Sonuçlandı</span>
                                            <i style="color:white !important;margin-top:4px;font-size:18px;margin-left:4px" class="material-icons">&#xE895;</i>
                                        </div>
                                    </a>
                                    </td>
                                    @else
                                    <td style="min-width: 100px">
                                    <a data-title="Select status" data-value="{{$case->status}}" data-pk="{{$case->id}}"  data-type="select" href="#" class="editable editable-click case-status-editable case-status-{{$case->status}}">
                                            <span style="color:white !important">Sonuçlandı</span>
                                    </a>
                                    </td>
                                    @endif
                                
                                @elseif($case->status==="in_progress")
                                <td style="min-width: 100px">
                                    <a  style="color:white !important"  data-title="Select status" data-value="{{$case->status}}" data-pk="{{$case->id}}"  data-type="select" href="#" class="editable editable-click case-status-editable case-status-{{$case->status}}">İnceleniyor</a>
                                </td>
                                @elseif($case->status==="no_analysis")
                                <td style="min-width: 100px;display:flex;align-items:center">
                                    <ahref="#" data-toggle="popover" title="Sebep" data-content="{{$case->no_analysis_reason}}" href="#" class="editable editable-click case-status-editable case-status-{{$case->status}}">
                                        <div style="display:flex;align-items:center">    
                                            <span  style="color:white !important">Sonuçlanamadı</span>
                                            <i style="color:white !important;margin-top:6px;font-size:18px;margin-left:4px" class="material-icons">&#xE8FD;</i>
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

                    {{$cases->links()}}
                </div>

                
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();   
        });
    </script>
</div>
@endsection
