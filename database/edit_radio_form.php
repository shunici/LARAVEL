https://stackoverflow.com/questions/43346458/laravel-set-radio-button-is-checked-based-on-database-value
<?php

   <div class="form-group " >
      <p><b>Status</b></p>
     <label class="radio-inline">
       <input type="radio" value="Swasta"  {{ ($data->status=="Swasta")? "checked" : "" }}  name="status">Swasta
     </label>
     <label class="radio-inline">
       <input type="radio" value="Negeri"  {{ ($data->status=="Negeri")? "checked" : "" }}  name="status">Negeri
     </label>                                                        
  </div> 
  
  data pada edit dengan menggunakan radio
