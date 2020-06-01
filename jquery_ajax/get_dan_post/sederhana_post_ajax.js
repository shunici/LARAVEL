$(document).ready(function(){
    $('#buat_pelanggan').click(function(e){
      e.preventDefault();
     
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      var CSRF_TOKEN = $('input[name="_token"]').attr('value');
             $.ajax({
               type: "POST",      
               dataType: "json",
               url: "{{route('create_pelanggan-store')}}",
               data: {
                   '_token' : CSRF_TOKEN,
                   nama : $("input[name='nama']").val(),
                   keterampilan: $("input[name='no_hp']").val(),
                   status_pelanggan_radio : $("input[name='status_pelanggan_radio']:checked").val(),
                   },
                   success: function (data) {                                     
                    if($.isEmptyObject(data.error)){                                                                     
                     console.log(data.sukses);
                    //  window.location.reload();
                    }else{
                     console.log(data.error);
                    }                   
                  }
              });   
              //tutup  $.ajax
   //tutup dokumen dan $form  

    })
})
</script>
