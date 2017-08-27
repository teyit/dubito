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


      $('#case-datatable').DataTable({
          "columns": [
              null,
              { "orderable": false },
              { "orderable": false },
              { "orderable": false },
              { "orderable": false },
              null,
              null,
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

                      column.data().unique().sort().each(function (d, j) {
                          var html = $.parseHTML(d);
                          select.append('<option value="' + $(html).text() + '">' + $(html).text() + '</option>')
                      });
                  }

              });
          },

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
          "order": [[ 0, "desc" ]]
      });





    // $("#report-datatable").dataTable();

    $("#activity-datatable").dataTable();

    $("#review-datatable").dataTable();


  };

  return App;
})(App || {});
