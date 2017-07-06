<div class="panel panel-default">
    <div class="panel-heading">Images</div>
    <div class="panel-body">
        <div class="gallery-container">
            @foreach($case->files as $file)
                <div class="item">
                    <div class="photo">
                        <div class="img"><img src="{{ConverterFileLink($file->file_url)}}"  alt="Gallery Image">
                            <div class="over">
                                <div class="info-wrapper">
                                    <div class="info">
                                        <div class="func">
                                            <a class="remove-file-from-case" data-file-id="{{$file->id}}" href="javascript:;">
                                                <i class="icon mdi mdi-delete"></i>
                                            </a>
                                            <a href="{{ConverterFileLink($file->file_url)}}" class="image-zoom">
                                                <i class="icon mdi mdi-search"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>