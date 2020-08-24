      {{-- modall --}}
      <div class="modal fade" id="modal-default" style="display: none;" width="10px">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            <h2><i class="fa fa-users"></i> Ubah Status User</h2>
            </div>
            {{-- error --}}
            <div class="alert alert-danger error_muncul" style="display:none">
            <ul></ul>
        </div>
    <form action="{{route('user_aktif', $row->id)}}" method="POST">
            <div class="modal-body">         
                <div class="form-group" >
                    <p><b>Status User</b></p>                          
                <label class="radio-inline">
                    <input type="radio" name="status" value="0">Tidak Aktif
                </label> 
                <label class="radio-inline">
                    <input type="radio" name="status" value="1">Aktif
                </label>                                              
                </div>              



            
            </div>
            <div class="modal-footer">
            <input name="_token" type="hidden" value="{!! csrf_token() !!}">
        
                    
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">tidak</button>
            <button  id="buat_pelanggan" type="submit" class="btn btn-primary">Ya</button>
            
            </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

    <script>

    </script>