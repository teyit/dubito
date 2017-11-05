var App = (function () {
  'use strict';

  App.dataTables = function( ){



    //We use this to apply style to certain elements
    $.extend( true, $.fn.dataTable.defaults, {
      dom:
        "<'row be-datatable-header'<'col-sm-6'l><'col-sm-6'f>>" +
        "<'row be-datatable-body'<'col-sm-12'tr>>" +
        "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
    } );


      $('#case-datatable').on( 'draw.dt', function () {
          $(".case-status-editable").editable({
              showbuttons:!1,
              url: '/caseStatus',
              source:caseStatusLabels,
          }).on('save',function (e,params) {

              for(var i in caseStatusLabels){
                  console.log(caseStatusLabels[i].value);
                  $(this).removeClass('status_' + caseStatusLabels[i].value);
              }
              $(this).addClass('status_' + params.newValue);

          });
          //url: '/setPublished/{{$case->id}}',
          $(".case-published-editable").editable({
              showbuttons:!1,
              url: '/setPublished',
              source: [
                  {value: "1", text: 'Yes'},
                  {value: "0", text: 'No'}
              ]
          }).on('save',function (e,params) {
              /*
              for(var i in caseStatusLabels){
                  console.log(caseStatusLabels[i].value);
                  $(this).removeClass('status_' + caseStatusLabels[i].value);
              }
              $(this).addClass('status_' + params.newValue);
                */
          });
          $(".case-user-editable").editable({
              showbuttons:!1,
              url: "/assignUserToCase/",
              source:users,
              success: function (response, value) {
                  if (response) {
                      for(var i in users){
                          console.log(users[i].name);
                          $(this).removeClass('status_' + users[i].name);
                      }

                      //$(this).parent().siblings('td').children('a.area').data('zona', newValue);
                      $.gritter.add({
                          title: 'Success',
                          text: 'User was assigned to case successfuly',
                          class_name: 'color success'
                      });
                  }

              }
          });

      } );
      $('#case-datatable').DataTable({
          "columns": [
              null,
              { "orderable": false },
              { "orderable": false },
              { "orderable": false },
              { "orderable": false },
              null,
              null,
              { "orderable": false },
              { "orderable": false }
          ],
          initComplete: function () {

              this.api().columns('.filterable').every(function (col) {

                  var except = [1, 4, 8];
                  if (except.indexOf(col) === -1) {
                      var column = this;
                      var select = $('<select><option value=""></option></select>')
                          .appendTo($(column.header()).empty())
                          .on('change', function () {
                              var val = $.fn.dataTable.util.escapeRegex(
                                  $(this).val()
                              );

                              column
                                  .search(val ? '^' + val + '$' : '', true, false)
                                  .draw();
                          });

                      var textList = [];
                      column.data().unique().sort().each(function (d, j) {
                          var html = $.parseHTML(d);
                          var text = $(html).text();
                          if(textList.indexOf(text) < 0){
                              textList.push(text);
                          }
                      });
                      for(var i in textList){
                          select.append('<option value="' + textList[i] + '">' + textList[i] + '</option>')
                      }

                  }

              });
          },
          "bStateSave" : true,
          "order": [[ 0, "desc" ]]

          });




      $('#report-datatable').DataTable({

          initComplete: function () {
              this.api().columns().every( function (col) {
                  var column = this;

                  if(col !== 4){
                      var select = $('<select><option value=""></option></select>')
                          .appendTo( $(column.header()).empty() )
                          .on( 'change', function () {
                              var val = $.fn.dataTable.util.escapeRegex(
                                  $(this).val()
                              );

                              column
                                  .search( val ? '^'+val+'$' : '', true, false )
                                  .draw();
                          } );

                      column.data().unique().sort().each( function ( d, j ) {
                          select.append( '<option value="'+d+'">'+d+'</option>' )
                      } );
                  }
              } );
          },
          "bStateSave" : true,
          "order": [[ 0, "desc" ]]
      });





    // $("#report-datatable").dataTable();

    $("#activity-datatable").dataTable();

    $("#review-datatable").dataTable();


  };

  return App;
})(App || {});
