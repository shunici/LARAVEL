https://datatables.net/reference/option/columns.width
kita bisa merubah th dan td pada tabel datatable 
letakkan koding ini di jquery javascript nya
$('#example').dataTable( {
    "columnDefs": [
      { "width": "20%", "targets": 0 }
    ]
  } );

