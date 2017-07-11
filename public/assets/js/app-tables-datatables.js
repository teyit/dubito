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


      $('#case-datatable').DataTable( {
          initComplete: function () {
              this.api().columns('.filterable').every( function (col) {


                      var column = this;
                      var select = $('<select><option value=""></option></select>')
                          .appendTo( $(column.footer()).empty() )
                          .on( 'change', function () {
                              var val = $.fn.dataTable.util.escapeRegex(
                                  $(this).val()
                              );

                              column
                                  .search( val ? '^'+val+'$' : '', true, false )
                                  .draw();
                          } );

                      column.data().unique().sort().each( function ( d, j ) {
                          select.append( '<option value="'+d+'">'+ d.substring(0,20)+'</option>' )
                      } );


              } );
          }
      } );



      $('#report-datatable').DataTable( {
          initComplete: function () {
              this.api().columns().every( function (col) {
                  var column = this;


                  if(col !== 4){
                      var select = $('<select><option value=""></option></select>')
                          .appendTo( $(column.footer()).empty() )
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
          }
      } );



    // $("#report-datatable").dataTable();

    $("#activity-datatable").dataTable();

    $("#review-datatable").dataTable();


  };

  return App;
})(App || {});
