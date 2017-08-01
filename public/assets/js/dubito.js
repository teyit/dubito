$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // getCases();
    // getCategories();

    $("#case-form-ajax").on('submit',function(e){
        var message_list = $('.email-list-item .be-checkbox input[type=checkbox]:checked').map(function(_, el) {
            return $(el).val();
        }).get();

       $.ajaxSetup({
           header:$('meta[name="_token"]').attr('content')
       })
       e.preventDefault();
       $.ajax({
           type:"POST",
           url:'/api/cases',
           data:$(this).serialize()+'&'+$.param({ 'selected_messages': message_list }),
               dataType: 'json',
           success: function(data){

              if(data){
                 getCases();
                  $.gritter.add({
                      title: 'Success',
                      text: 'Case was added successfuly',
                      class_name: 'color success'
                  });

                  $('#add-new-case').modal('hide');


                  if(message_list){

                      $.each(message_list,function(index,message_id){
                          $('#checkbox-label-'+message_id).addClass('hidden');
                      });

                      $.gritter.add({
                          title: 'Success',
                          text: 'This message was assigned as report successfuly',
                          class_name: 'color success'
                      });
                  }
              }
           },
           error: function(data){

           }
       });
   });


    function getCases(){
        var $reportCases = $(".report-cases");
        $.get("/api/cases", function(data){
            $reportCases.find('option').remove();
            $.each(data, function(index, cases) {
                $reportCases.append('<option value="' + cases.id + '">' + cases.title + '</option>');
            });
        });
    }

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


    //
    // $("#case-form-ajax-edit").on('submit',function(e){
    //
    //     $.ajaxSetup({
    //         header:$('meta[name="_token"]').attr('content')
    //     })
    //     e.preventDefault();
    //     $.ajax({
    //         type:"POST",
    //         url:'/api/cases',
    //         data:$(this).serialize(),
    //         dataType: 'json',
    //         success: function(data){
    //             if(data == true){
    //                 getCasesEdit();
    //             }
    //         },
    //         error: function(data){
    //
    //         }
    //     });
    // });




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
                    getCategories();
                }
            },
            error: function(data){

            }
        });
    });



});



// function getUsers(callback) {
//     var url = "/api/users/";
//      $.ajax({
//         type:  'GET',
//         async: true,
//         url:   url,
//         dataType: "json",
//         success:function(response){
//             callback(response);
//         }
//     });
// }


function getUsers(callback){
    $.get("/api/users/", function(data){
        callback(data);
    });
}


function getCategoriesData(callback){
    $.get("/api/categories?editable=true", function(data){
        callback(data);
    });
}










// function getUsers(){
//     var $users = $(".user-cases");
//     $.get("/api/users", function(data){
//         $users.find('option').remove();
//         $.each(data, function(index, cases) {
//             $users.append('<option value="' + cases.id + '">' + cases.title + '</option>');
//         });
//     });
// }



// function getCasesEdit(){
//     var $reportCases = $(".report-cases-edit");
//     $.get("/api/cases", function(data){
//         $reportCases.find('option').remove();
//         $.each(data, function(index, cases) {
//             $reportCases.append('<option value="' + cases.id + '">' + cases.title + '</option>');
//         });
//     });
// }

function getCategories(){
    var $reportCategories = $(".report-categories");
    $.get("/api/categories", function(data){
        $reportCategories.find('option').remove();
        $.each(data, function(index, category) {
            $reportCategories.append('<option value="' + category.id + '">' + category.title + '</option>');
        });
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


