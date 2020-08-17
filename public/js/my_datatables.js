"use strict";

$("[data-checkboxes]").each(function() {
  var me = $(this),
    group = me.data('checkboxes'),
    role = me.data('checkbox-role');

  me.change(function() {
    var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
      checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
      dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
      total = all.length,
      checked_length = checked.length;

    if(role == 'dad') {
      if(me.is(':checked')) {
        all.prop('checked', true);
      }else{
        all.prop('checked', false);
      }
    }else{
      if(checked_length >= total) {
        dad.prop('checked', true);
      }else{
        dad.prop('checked', false);
      }
    }
  });
});

$("#myTable").dataTable({
  "columnDefs": [
    { "sortable": true, "targets": 1 }
  ]
});

$("#table-2").dataTable({
  "columnDefs": [
    { "sortable": false, "targets": [0,2,3] }
  ]
});

$("#transactionReport").dataTable({
  dom: 'Bfrtip',
  buttons: [
    {
      extend: 'csv',
      className: 'btn btn-info'
    },
    {
      extend: 'excel',
      className: 'btn btn-success'
    },
    {
      extend: 'print',
      className: 'btn btn-primary',
      customize: function ( win ) {
          $(win.document.body)
              .css( 'font-size', '10pt' )
              .prepend(
                  "<img src='" + document.location.origin + "/storage/assets/company/company.jpg' style='margin: auto; position:absolute; top: 0; left: 0; bottom: 0; right: 0; opacity: 30%' />"
              );

          $(win.document.body).find( 'table' )
              .addClass( 'compact' )
              .css( 'font-size', 'inherit' );
      }
    },
  ]
});
