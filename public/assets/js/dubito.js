$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".autocomplete").select2({
        tags : true,
        width: "100%",
        maximumSelectionLength : 1
    });


    $(".tag").select2({
        tags : true,
        width: "100%"
    });



    $(".autocomplete-cases").select2({
        width: "100%",
        showSearchBox: true,
        minimumInputLength: 1,
        ajax: {
            url: "/api/cases",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: data
                };
            },
            cache: true
        }

    });


    $("#category-form-ajax").on('submit',function(e){

        $.ajaxSetup({
            header:$('meta[name="_token"]').attr('content')
        })
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:'/api/categories',
            data:$(this).serialize(),
            dataType: 'json',
            success: function(data){
                if(data == true){
                    getCategories(function (data) {
                        var $reportCategories = $(".report-categories");
                        $reportCategories.find('option').remove();
                        $.each(data, function(index, category) {
                            $reportCategories.append('<option value="' + category.id + '">' + category.title + '</option>');
                        });
                    });
                }
            },
            error: function(data){

            }
        });
    });



});

function getCases(callback){
    $.get("/api/cases", function(data){
        callback(data);
    });
}
function getUsers(callback){
    $.get("/api/users/", function(data){
        callback(data);
    });
}


function getRoles(callback){
    $.get("/api/roles/", function(data){
        callback(data);
    });
}


function getCategoriesData(callback){
    $.get("/api/categories?editable=true", function(data){
        callback(data);
    });
}
function getCategories(callback){
    $.get("/api/categories", function(data){
       callback(data);
    });
}

function dubitoConfirm(callback){
    var confirmCancel = $('.confirm-cancel');
    var confirmDelete = $('.confirm-delete');
    $('.confirm-delete-modal').modal({ show: true});

    $(confirmCancel).on('click',function(){
        //console.log('cancel');
        $('.confirm-delete-modal').modal('hide');
        callback(false);


    });
    $(confirmDelete).on('click',function(){
        //console.log('delete');
        $('.confirm-delete-modal').modal('hide');
        callback(true);

    });
}


