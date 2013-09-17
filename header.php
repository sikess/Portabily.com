<!doctype html>
<html class="no-js">
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory');?>/css/los_post.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory');?>/css/submenus.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory');?>/css/tooltip.css" type="text/css" />

<link rel="shortcut icon" href="<?php bloginfo('template_directory');?>/img/favicon.ico" />
<title><?php bloginfo('name'); ?></title>


<script language="javascript" type="application/javascript">

if (Modernizr.boxshadow){
   alert("SI sombra caja");
}
else{
   alert("NO sombra caja");
}

</script>


<?php wp_head(); ?>
</head>
	<body>
	
    
<section class="container">
	<div id="main">
		<div class="contenedor">
			<div id="con_menu_top"><!--EL MENU DEL TOP-->

			  
                
                
 				   <?php wp_nav_menu( array('menu_id'=>'','menu_class'=>'list_men_top','menu'=>'top')); ?>
 		
			</div><!--EL MENU DEL TOP-->      

<div id="cont_head"><!--Head con logo-->

	<div id="cont_logo_form">
    
    <div id="logo_y_form">
       <!-- Header -->
	<header >
	    <div class="container">
	        <span ><a href="<?php bloginfo('url');?>" id="logoon"></a></span>
	    </div>
	</header>
	<!-- End Header  -->
      
      </div><!--FINLOGO-->
    
    <div id="logo_y_form">
    	Publicidad
	</div>
    
     <div id="cont_menu_prin">
     
     		<div id="inicio_link">
            	<ul id="" class="">
 					<li><a href="http://localhost/portabily.com"> </a></li>
                </ul>   
            </div>
 				<div id="access" role="navigation">
        	  <?php wp_nav_menu( array( 'container_class' => 'menu-header','theme_location' => 'primary' ) );?>
    		</div>
           
        
	</div><!--cont_menu_prin-->
 
</div>

</div><!--FIN Head con logo--><!--FIN MAIN-->





</div>
    
    
 
	 
	<!-- Navigation Bar Starts-->
	<!--<nav>
	    <div class="navbar">
	        <ul class="grid nav_bar">-->
	            <?php /* wp_list_categories('title_li=');*/ ?>
	    <!--     </ul>
	    </div>
	</nav>-->
<!-- Navigation Bar Ends -->
