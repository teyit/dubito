$(function(){

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




function getCases(){
    var $reportCases = $(".report-cases");
    $.get("/api/cases", function(data){
        $reportCases.find('option').remove();
        $.each(data, function(index, cases) {
            $reportCases.append('<option value="' + cases.id + '">' + cases.title + '</option>');
        });
    });
}


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