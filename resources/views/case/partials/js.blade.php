<script>

    $(function () {

        $("#checkinsucc").on('change',function(){
            var is_published = + $(this).prop('checked');
            if(is_published == 1){
                var text = 'Case has been marked as published';
            }else{
                var text = 'Case mark has been removed.';
            }
            $.ajax({
                method: "post",
                url: '/setPublished/{{$case->id}}',
                data: {_token: $('#_token').val(), is_published: is_published},
                success: function (response) {
                    console.log(response);
                    if (response) {
                        $.gritter.add({
                            title: 'Success',
                            text: text,
                            class_name: 'color success'
                        });
                    }

                }
            });
        });
        //Archive case
        $('.case-is-archived-btn').on('click', function () {
            var _this = $(this);
            var status = $(this).data('status');
            var newStatus;
            if (status === 'archived') {
                newStatus = 'ongoing';
            } else {
                newStatus = 'archived';
            }

            $.ajax({
                method: "post",
                url: '/setFolder/{{$case->id}}',
                data: {_token: $('#_token').val(), folder: newStatus},
                success: function (response) {
                    console.log(response);
                    if (response) {
//                          _this.attr('disabled',true);
//                          _this.text("Remove  Archive");
                        $.gritter.add({
                            title: 'Success',
                            text: 'Case was send to archive successfuly',
                            class_name: 'color success'
                        });

                        window.location.reload()
                    }

                }
            });
        });

        //backlog case
        $('.case-is-backlog-btn').on('click', function () {
            var _this = $(this);
            var status = $(this).data('status');
            var newStatus;
            if (status === 'is_in_backlog') {
                newStatus = 'ongoing';
            } else {
                newStatus = 'is_in_backlog';
            }
            console.log(status);
            $.ajax({
                method: "post",
                url: '/setFolder/{{$case->id}}',
                data: {_token: $('#_token').val(), folder: newStatus},
                success: function (response) {
                    console.log(response);
                    if (response) {
//                          _this.attr('disabled',true);
//                          _this.text("Remove  Archive");
                        $.gritter.add({
                            title: 'Success',
                            text: 'Case was send to backlog successfuly',
                            class_name: 'color success'
                        });

                        window.location.reload()
                    }

                }
            });
        });


        //Evidence input file change
        $('.evidence-file').on('change', function () {
            var names = [];
            for (var i = 0; i < $(this).get(0).files.length; ++i) {
                names.push($(this).get(0).files[i].name);
            }

            $('.evidence-file-name li,b').remove();

            $('.evidence-file-name').append('<b>Selected Files:</b>');

            $.each(names, function (index, name) {
                $('.evidence-file-name').append('<li>' + name + '</li>');
            })

        });


        //Assign user to case

        getUsers(function (result) {
            $('#assign-user-case').editable({
                type: 'select',
                title: 'Select status',
                url: "{{url("/assignUserToCase/$case->id")}}",
                pk: 1,
                source: result,
                success: function (response, value) {
                    if (response) {
                           $('.account-img').attr("src",response.account_picture)
                        //$(this).parent().siblings('td').children('a.area').data('zona', newValue);
                        $.gritter.add({
                            title: 'Success',
                            text: 'User was assigned to case successfuly',
                            class_name: 'color success'
                        });
                    }

                }
            });

        });


        //category editable

        getCategoriesData(function (result) {

            console.log(result);

            $('#change-category').editable({
                type: 'select',
                title: 'Select Category',
                url: "{{route('change.category',$case->id)}}",
                pk: 1,
                source: result,
                success: function (response, value) {
                    if (response) {
                        //$(this).parent().siblings('td').children('a.area').data('zona', newValue);
                        $.gritter.add({
                            title: 'Success',
                            text: 'Category was assigned to case successfuly',
                            class_name: 'color success'
                        });
                    }

                }
            });

        });



        $('#change-title').editable({
            type: 'text',
            title: 'Change Title',
            url: "{{route('change.title',$case->id)}}",
            pk: 1,
            inputclass: 'case-title-editable',
            success: function (response, value) {
                if (response) {

                    //$(this).parent().siblings('td').children('a.area').data('zona', newValue);
                    $.gritter.add({
                        title: 'Success',
                        text: 'Case title was changed successfuly',
                        class_name: 'color success'
                    });
                }

            }
        });

        //Evidence form
        $('#activity-form-ajax').submit(function (e) { // capture submit
            e.preventDefault();
            
            var input = $("input", this);
            var text = input.val();
            input.val('');
            
            $.ajax({
                method: "POST",
                url: "{{route('case.activity.add',$case->id)}}",
                data: {_token: $("#_token").val(),text : text},
                success: function (data) {
                    var new_activity = $(".activity-item:last").clone()
                    new_activity.attr("data-id",data.id);
                    $(".badge-primary",new_activity).html(data.created_at);
                    $(".account-img",new_activity).attr('src',data.user.picture);
                    $(".activity-username",new_activity).html(data.user.name);
                    $(".activity-text",new_activity).html(data.text);


                    new_activity.removeClass('hidden');
                    new_activity.insertBefore('.list-group-item.disabled');
        
                    $.gritter.add({
                        title: 'Success',
                        text: 'Activity has been added.',
                        class_name: 'color success'
                    });
                }
            })
        });


        @foreach($case->activities as $a)

            $('.edit-activity-{{$a->id}}').editable({
                type: 'textarea',
                title: 'Edit Activity',
                url: "{{route('case.activity.update',[$case->id,$a->id])}}",
                pk: 1,
                source:"",
                success: function (response, value) {

                }
            });

        @endforeach


        //Evidence form
        $('#evidence-form-ajax').submit(function (e) { // capture submit
            e.preventDefault();
            var fd = new FormData($(this)[0]); // XXX: Neex AJAX2
            fd.append("file", fd);
            $.ajax({
                url: $(this).attr('action'),
                xhr: function () { // custom xhr (is the best)
                    var xhr = new XMLHttpRequest();
                    var total = 0;
                    $.each(document.getElementById('file-1').files, function (i, file) {
                        total += file.size;
                    });
                    xhr.upload.addEventListener("progress", function (evt) {

                        var loaded = (evt.loaded / total).toFixed(2) * 100; // percent
                        $('#progress').text('Uploading... ' + loaded + '%');
                    }, false);
                    return xhr;
                },
                type: 'post',
                processData: false,
                contentType: false,
                data: fd,
                success: function (response) {
                    if (response) {
                        $.gritter.add({
                            title: 'Success',
                            text: 'Evidence was added succesfully',
                            class_name: 'color success'
                        });
                    }

                    window.location.reload()
                }
            });
        });

        var status = '{{$case->status}}';
        if (status == 'completed') {
            $('#statusSelector .case-status-dropdown').addClass('btn-success');
        } else if (status == 'cancelled') {
            $('#statusSelector .case-status-dropdown').addClass('btn-danger');
        } else if (status == 'in_progress') {
            $("#statusSelector .case-status-dropdown").addClass('btn-warning');
        } else if (status == 'to_be_tweeted') {
            $("#statusSelector .case-status-dropdown").addClass('btn-primary');
        } else if (status == 'no_analysis') {
            $("#statusSelector .case-status-dropdown").addClass('btn-no-analysis');
        } else if (status == 'suspended') {
            $("#statusSelector .case-status-dropdown").addClass('btn-suspended');
        }


        //Add file to case

        $('.add-file-to-case').on('click', function () {
            var file_id = $(this).data('file-id');
            $.ajax({
                method: "post",
                url: "{{route("case.file.store",$case->id)}}",
                data: {_token: $("#_token").val(), file_id: file_id},
                success: function (response) {
                    if (!response) {
                        $.gritter.add({
                            title: 'Error',
                            text: 'this image have already was added',
                            class_name: 'color danger'
                        });
                    } else {
                        $.gritter.add({
                            title: 'Success',
                            text: 'Image  was added succesfully',
                            class_name: 'color success'
                        });

                        window.location.reload();
                    }
                }

            });

        });

    });


    //Remove file from case

    $('.remove-file-from-case').on('click', function () {
        var file_id = $(this).data('file-id');
        $.ajax({
            method: "post",
            url: "{{route("case.file.remove",$case->id)}}",
            data: {_token: $("#_token").val(), file_id: file_id},
            success: function (response) {
                if (response) {
                    $.gritter.add({
                        title: 'Success',
                        text: 'Image  was removed succesfully',
                        class_name: 'color success'
                    });

                    window.location.reload();
                }
            }

        });
    });



    //Tags save and config

    $(".tags").select2({width: '100%', placeholder: "Tags"});

    $('.tags').on('change', function () {
        var tags = $('.tags').val();

        $.ajax({
            url: "{{route('case.tag.store',$case->id)}}",
            method: "post",
            data: {tags: tags},
            success: function (response) {
                console.log(response);
                if (response) {
                    $.gritter.add({
                        title: 'Success',
                        text: 'Tags   was updated succesfully',
                        class_name: 'color success'
                    });
                }
            }


        })
    });



    //link Delete

    $('.link-delete').on('click', function () {
        var that = $(this);
        dubitoConfirm(function (result) {
            console.log(result);
            if (result == true) {
                var id = that.data('id');
                $.ajax({
                    method: "DELETE",
                    url: "/links/" + id,
                    data: {_token: $("#_token").val()},
                    success: function (data) {
                        if (data) {
                            window.location.reload();
                        }
                    }
                })
            }
        });
    });


    //Case description form
    $('#case-description-form').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            method: "put",
            url: "{{route('cases.update',$case->id)}}",
            data: $(this).serialize(),
            success: function (response) {
                if (response) {

                    $.gritter.add({
                        title: 'Success',
                        text: 'Description was added successfuly',
                        class_name: 'color success',
                        max_to_display:1

                    });
                }
            }
        });

    })



    // Description Auto Save //

    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();


    $('#description-ta').on('keyup', function (event) {
        event.preventDefault();
        $.ajax({
            method: "put",
            url: "{{route('cases.update',$case->id)}}",
            data: {_token:$("#_token").val(),description:$(this).val()},
            success: function (response) {
                if (response) {
                    delay(function(){
                        $.gritter.add({
                            title: 'Success',
                            text: 'Description was auto saved',
                            class_name: 'color success'
                        });
                    }, 1000 );


                }
            }
        });

    })



    //Gallery config//

    var a = $(".gallery-container");
    a.masonry({
        columnWidth: 0,
        itemSelector: ".item"
    });



    //Case status

    $('.case-status-menu a').click(function () {
        text = $(this).text() + ' <span class="icon-dropdown mdi mdi-chevron-down"></span>';
        $('.case-status-dropdown').html(text);
        status = $(this).attr('id');


        $('#statusSelector .case-status-dropdown').removeClass('btn-success btn-danger btn-warning btn-primary btn-no-analysis btn-suspended');


        if (status == 'completed') {
            $('#statusSelector .case-status-dropdown').addClass('btn-success');
        } else if (status == 'cancelled') {
            $('#statusSelector .case-status-dropdown').addClass('btn-danger');
        } else if (status == 'in_progress') {
            $("#statusSelector .case-status-dropdown").addClass('btn-warning');
        } else if (status == 'to_be_tweeted') {
            $("#statusSelector .case-status-dropdown").addClass('btn-primary');
        } else if (status == 'no_analysis') {
            $(".#statusSelector .case-status-dropdown").addClass('btn-no-analysis');
        } else if (status == 'suspended') {
            $("#statusSelector .case-status-dropdown").addClass('btn-suspended');
        } else if (status == 'pending') {
            $("#statusSelector .case-status-dropdown").addClass('btn-muted');
        }


        $.ajax({
            method: "put",
            url: "{{route("case.status.update",$case->id)}}",
            data: {_token: $("#_token").val(), status: status},
            success: function (response) {
                if (response) {
                    $.gritter.add({
                        title: 'Success',
                        text: 'Status was updated successfuly',
                        class_name: 'color success'
                    });
                }
            }
        });
    });

    $('.case-folder-menu a').click(function () {
        var text = $(this).text() + ' <span class="icon-dropdown mdi mdi-chevron-down"></span>';
        $('.case-folder-dropdown').html(text);
        var folder = $(this).attr('id');

        $.ajax({
            method: "put",
            url: "{{route("case.folder.update",$case->id)}}",
            data: {_token: $("#_token").val(), folder: folder},
            success: function (response) {
                if (response) {
                    $.gritter.add({
                        title: 'Success',
                        text: 'Folder was updated successfuly',
                        class_name: 'color success'
                    });
                }
            }
        });
    });


</script>