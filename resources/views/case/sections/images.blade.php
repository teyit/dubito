<div class="panel panel-default">
    <div class="panel-heading">
        <form action="{{route("case.image.store",$case->id)}}" method="post" enctype="multipart/form-data">
        Images &nbsp;
            <input type="file" name="case_file[]" id="file-2"
                   data-multiple-caption="{count} files selected" multiple
                   class="inputfile">
            <label for="file-2" class="btn-default"> <i
                        class="mdi mdi-attachment"></i><span>Add Images</span></label>
            <button class="btn btn-success" type="submit">Save</button>

        </form>

    </div>
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
                                            <a href="{{ConverterFileLink($file->file_url)}}" download>
                                                <i class="icon mdi mdi-download"></i>
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