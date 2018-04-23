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
                                    <span>{{$case->title}}</span>

                                </td>
                                <td>
                                    @if($case->user)
                                    <span>{{$case->user->name}}</span>
                                    @else
                                        <span>Kişi Atanmadı</span>
                                @endif
                                @if($case->status==="verified")
                                <td style="min-width: 100px">
                                    <a data-title="Select status" data-value="{{$case->status}}" data-pk="{{$case->id}}"  data-type="select" href="#" class="editable editable-click case-status-editable case-status-{{$case->status}}">Sonuçlandı</a>
                                </td>
                                @elseif($case->status==="in_progress")
                                <td style="min-width: 100px">
                                    <a data-title="Select status" data-value="{{$case->status}}" data-pk="{{$case->id}}"  data-type="select" href="#" class="editable editable-click case-status-editable case-status-{{$case->status}}">İnceleniyor</a>
                                </td>
                                @elseif($case->status==="no_analysis")
                                <td style="min-width: 100px">
                                    <a data-title="Select status" data-value="{{$case->status}}" data-pk="{{$case->id}}"  data-type="select" href="#" class="editable editable-click case-status-editable case-status-{{$case->status}}">Sonuçlanamadı</a>
                                </td>
                                @else
                                <td style="min-width: 100px">
                                    <a data-title="Select status" data-value="{{$case->status}}" data-pk="{{$case->id}}"  data-type="select" href="#" class="editable editable-click case-status-editable case-status-{{$case->status}}">{{$case->statusLabels[$case->status] or ""}}</a>
                                </td>
                                @endif
                                <td>{{$case->category->title or ""}}</td>
                                <td>{{$case->created_at}}</td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection