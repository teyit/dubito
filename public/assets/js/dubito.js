$(function(){


   $("#case-form-ajax").on('submit',function(e){
       getCases();

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

    $("#category-form-ajax").on('submit',function(e){
        getCategories();

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
    var $reportCases = $(".report-cases-create");
    $.get("/api/cases", function(data){
        $reportCases.find('option').remove();
        $.each(data, function(index, cases) {
            $reportCases.append('<option value="' + cases.id + '">' + cases.title + '</option>');
        });
    });
}

function getCategories(){
    var $reportCategories = $(".report-categories-create");
    $.get("/api/categories", function(data){
        $reportCategories.find('option').remove();
        $.each(data, function(index, category) {
            $reportCategories.append('<option value="' + category.id + '">' + category.title + '</option>');
        });
    });
}