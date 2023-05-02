<div class="container-fluid">
   <div class="row">
     <div class="col-11 bg-brand">
       <a href="https://sigpeco.sigpeconsultores.com.co/menu.php">
        <img src="<?php
        if (isset($path)) { 
          echo $path.'assets/images/brand_icon.png';}
        else{
          echo 'assets/images/brand_icon.png';
        } ?>" 
        class="brand_sigpe" alt="sigpe consultores">
     </div></a> 
     <div class="col-1 bg-brand text-center">
     <a href="../client/logout.php"><button style="border:0"><span> <i class="fa-solid fa-arrow-right-from-bracket fa-2x"></i></span></button></a>
     </div>
   </div>
  </div>

<script>
  if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
  }
</script>