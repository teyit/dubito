$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // getCases();
    // getCategories();

    $("#case-form-ajax").on('submit',function(e){

       $.ajaxSetup({
           header:$('meta[name="_token"]').attr('content')
       })
       e.preventDefault();
       $.ajax({
           type:"POST",
           url:'/api/cases',
           data:$(this).serialize(),
           dataType: 'json',
           success: function(data){
              if(data == true){
                 getCases();
                  $.gritter.add({
                      title: 'Success',
                      text: 'Case was added successfuly',
                      class_name: 'color success'
                  });
              }
           },
           error: function(data){

           }
       });
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


