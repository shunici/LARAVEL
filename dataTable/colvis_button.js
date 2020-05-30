https://datatables.net/reference/button/colvis
tombol colvis ini berfungsi untuk menyembunyikan kolom table th td jika tabel nya terlalu banyak
                              dom: '<"html5buttons">Blfrtip',                             
                             buttons: [
                                {
                                    text:      '<i class="fa fa-file"></i> Sembunyi Kolom',
                                    extend: 'colvis',
                                    postfixButtons: [ 'colvisRestore' ],
                                    columnText: function ( dt, idx, title ) {
                                            return (idx+1)+': '+title;
                                        }
                                },                                 
                                ]    
                                
    tambahkan link cssnya
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"> </script>
