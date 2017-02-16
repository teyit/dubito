$(function(){
    getCases();
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