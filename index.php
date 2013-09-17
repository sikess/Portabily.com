<?php
/**
 * @package WordPress
 * @subpackage themename
 */

get_header(); ?>

<div id="cont-recent">
	
    <div class="entre_seccion"></div><!--F entre_seccion-->
		<div id="conter-pop">
          <?php los_recientes(); /*echo popularPosts(4);*/ ?>
        </div>
   </div><!--F conter-pop-->
</div><!--FIn recent-->


<div class="contenedor"><!--CONTENEDOR DE CUERPO Y LISTA DE POST-->

<div class="entre_seccion"></div><!--F entre_seccion-->

<div id="conte_cuerpo">

<div class="conte_todos_post">

<div class="cabeza_secciones">
	<div class="contenido_cabeza_secciones">
		Recientes
	</div>
</div>

<!--<div id="primary" class="container">
	<div id="content">-->
		<?php get_template_part( 'loop', 'index' ); ?>
<!--	</div><!-- #content -->
<!--</div>--><!-- #primary -->



</div><!--Fin conte_todos_post-->
        
   <div class="contiene_wigged">
		Sidebar
	</div>  
    
</div><!--FIN CONTENEDOR DE CUERPO Y LISTA DE POST-->
    
  	
<?php /*get_sidebar(); */?>
<?php /*get_footer();*/ ?>