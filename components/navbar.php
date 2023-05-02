<?php 
function path($path,$link) {
    if (isset($path)) { 
        echo $path.$link;}
      else{
        echo $link;
      } 
  }
?>


<nav class="main-menu" id="navbarFloat">

<div class="scrollbar" id="style-1">
      
<ul>
<li class="my-5px">                                   
<a href="<?php path($path_menu,"menu.php"); ?>">
<i class="fa fa-solid fa-home fa-lg pt-5"></i>
<span class="nav-text">Inicio</span>
</a>
</li>   
   
<li >         

<a href="<?php path($path_menu,"ListaInspecciones.php"); ?>">
<i class="fa fa-solid fa-list fa-lg pt-5"></i>
<span class="nav-text">Listado de inspecciones</span>
</a>
</li>   

    
<li >                                 
<a href="<?php path($path_menu,"inspeccion.php"); ?>">
<i class="fa fa-solid fa-circle-plus fa-lg pt-5"></i>
<span class="nav-text">Nueva inspección</span>
</a>
</li>   

<li class="my-5px">                                 
<a href="<?php path($path_menu,"client/logout.php"); ?>">
<i class="fa fa-solid fa-right-from-bracket fa-lg pt-5"></i>
<span class="nav-text">Salir</span>
</a>
</li>  
  


 

                        
<span class="share"> 


<div class="addthis_default_style addthis_32x32_style">
  
<div style="position:absolute;
margin-left: 56px;top:3px;"> 
   
  

  
 
  
  
</div>


                            
                              
                            
                          
                        </span>
               
                        
                    </a>

</li>
                            

  
  
</li>



 
  
</ul>

  
  
    
  

</nav>
        
  

			
  
  





