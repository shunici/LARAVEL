koding ini berfungsi untuk melihat data table yang terlalu banyak 

dom: 'Bfrtip',
                             buttons: [
                                {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
                                    {
                                        extend:    'copyHtml5',
                                        text:      '<i class="fa fa-files-o"></i> Copy',
                                        titleAttr: 'Copy'
                                    },
                                    {
                                        extend:    'excelHtml5',
                                        text:      '<i class="fa fa-file-excel-o"></i> Excel',
                                        titleAttr: 'Excel'
                                    },
                                    {
                                        extend:    'csvHtml5',
                                        text:      '<i class="fa fa-file-text-o"> </i> CSV',
                                        titleAttr: 'CSV'
                                    },
                                    {
                                        extend:    'pdfHtml5',
                                        text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                                        titleAttr: 'PDF'
                                    },
                                    {
                                        extend:    'print',
                                        text:      '<i class="fa fa-file-print-o"> </i> Print',
                                        title : '',
                                        titleAttr: 'Print',
                                        orientation: 'landscape',
                                        messageTop: '<style media="print">@page {size: auto;margin: 0;}body{margin: 0mm 10mm 10mm 10mm;}</style><div class="kop" style="text-align: center; width: 100%"><div class="logo" style="width: 20%; float: left;"><img src="/uploads/benawa.png" style="width: 150px"></div><div class="text" style="width: 80%; font-family: arial;"><p><font size="5"><b>BENAWA DIGITAL PRINTING</b></font><br>Indoor and Outdoor Promotion <br>Jalan Delima No. 07 Guntung Paikat Banjarbaru</p><font size="3"><b style="text-align: center">Laporan Data Bahan</b></font></div></div> <br>',
                                        messageBottom: '<div class="text-footer" style=" width: 100%; "><div class="satu" style="width: 20%; float: left; background-color: yellow"></div><div class="dua" style="width: 50%; float: left; background-color: red"></div><div class="tiga" style="width: 30%; float: right; font-size: 12pt"><p style="text-align: left"> <font size="2">Banjarbaru, Senin 2020 <br>Administrator Dinas Kebudayaan <br><br><br> Muhammad Noviyanur <br>NIP : 1663.1098</font></p></div></div>',
                                        //untuk menyimpan kolom
                                        exportOptions: {
                                            columns: [ 0, 1, 2, 3, 4, 5,6 ,7,8,9,10 ]
                                        }
                                    }
                                ]      
                                
                                
                                link
                                   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"> </script>
