          $(document).on('click', '#kirim_admin', function(e){                            
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                var nota_id = $('#id_nota').text();                                                 ;
                 $.ajax({
                            type : 'post',
                            url : "{{route('aktivitas-kirim_admin')}}",
                            data: {id:nota_id},
                            success : function(data){
                                // location.reload(); 
                                alert('berhasil');
                            }
                        })
      }); //tutup ready
      
      
      berhubungan dengan jquery pada post dan get ajax 
