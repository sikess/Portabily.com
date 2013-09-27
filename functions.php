<?php
/**
 * @package WordPress
 * @subpackage themename
 */

/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 */
load_theme_textdomain( 'themename', get_template_directory() . '/languages' );

$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/**
 * Add jQuery
 */
function add_jquery_script() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
    wp_enqueue_script( 'jquery' );
}    
add_action('wp_enqueue_scripts', 'add_jquery_script');


function modernizr() {
    
	wp_register_script('modernizr', get_stylesheet_directory_uri() . '/js/modernizr.js');
    wp_enqueue_script( 'modernizr' );
}    
add_action('wp_enqueue_scripts', 'modernizr');

/**
 * Remove code from the <head>
 */
//remove_action('wp_head', 'rsd_link'); // Might be necessary if you or other people on this site use remote editors.
//remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
//remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
//remove_action('wp_head', 'index_rel_link'); // Displays relations link for site index
//remove_action('wp_head', 'wlwmanifest_link'); // Might be necessary if you or other people on this site use Windows Live Writer.
//remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
//remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
//remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_filter( 'the_content', 'capital_P_dangit' ); // Get outta my Wordpress codez dangit!
remove_filter( 'the_title', 'capital_P_dangit' );
remove_filter( 'comment_text', 'capital_P_dangit' );
// Hide the version of WordPress you're running from source and RSS feed // Want to JUST remove it from the source? Try: remove_action('wp_head', 'wp_generator');
/*function hcwp_remove_version() {return '';}
add_filter('the_generator', 'hcwp_remove_version');*/
// This function removes the comment inline css
/*function twentyten_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );*/

/**
 * Remove meta boxes from Post and Page Screens
 */
function customize_meta_boxes() {
   /* These remove meta boxes from POSTS */
  //remove_post_type_support("post","excerpt"); //Remove Excerpt Support
  //remove_post_type_support("post","author"); //Remove Author Support
  //remove_post_type_support("post","revisions"); //Remove Revision Support
  //remove_post_type_support("post","comments"); //Remove Comments Support
  //remove_post_type_support("post","trackbacks"); //Remove trackbacks Support
  //remove_post_type_support("post","editor"); //Remove Editor Support
  //remove_post_type_support("post","custom-fields"); //Remove custom-fields Support
  //remove_post_type_support("post","title"); //Remove Title Support

  
  /* These remove meta boxes from PAGES */
  //remove_post_type_support("page","revisions"); //Remove Revision Support
  //remove_post_type_support("page","comments"); //Remove Comments Support
  //remove_post_type_support("page","author"); //Remove Author Support
  //remove_post_type_support("page","trackbacks"); //Remove trackbacks Support
  //remove_post_type_support("page","custom-fields"); //Remove custom-fields Support
  
}
add_action('admin_init','customize_meta_boxes');

/**
 * This theme uses wp_nav_menus() for the header menu, utility menu and footer menu.
 */
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'themename' ),
	'footer' => __( 'Footer Menu', 'themename' ),
	'utility' => __( 'Utility Menu', 'themename' )
) );

/** 
 * Add default posts and comments RSS feed links to head
 */
add_theme_support( 'automatic-feed-links' );

/**
 * This theme uses post thumbnails
 */
add_theme_support( 'post-thumbnails' );



/*if (function_exists('add_theme_support')) { add_theme_support('post-thumbnails'); }*/

/**
 *	This theme supports editor styles
 */

add_editor_style("/css/layout-style.css");

/**
 * Remove superfluous elements from the admin bar (uncomment as necessary)
 */
function remove_admin_bar_links() {
	global $wp_admin_bar;

	//$wp_admin_bar->remove_menu('wp-logo');
	//$wp_admin_bar->remove_menu('updates');	
	//$wp_admin_bar->remove_menu('my-account');
	//$wp_admin_bar->remove_menu('site-name');
	//$wp_admin_bar->remove_menu('my-sites');
	//$wp_admin_bar->remove_menu('get-shortlink');
	//$wp_admin_bar->remove_menu('edit');
	//$wp_admin_bar->remove_menu('new-content');
	//$wp_admin_bar->remove_menu('comments');
	//$wp_admin_bar->remove_menu('search');
}
//add_action('wp_before_admin_bar_render', 'remove_admin_bar_links');

/**
 *	Replace the default welcome 'Howdy' in the admin bar with something more professional.
 */
function admin_bar_replace_howdy($wp_admin_bar) {
    $account = $wp_admin_bar->get_node('my-account');
    $replace = str_replace('Howdy,', 'Welcome,', $account->title);            
    $wp_admin_bar->add_node(array('id' => 'my-account', 'title' => $replace));
}
add_filter('admin_bar_menu', 'admin_bar_replace_howdy', 25);

/**
 * This enables post formats. If you use this, make sure to delete any that you aren't going to use.
 */
//add_theme_support( 'post-formats', array( 'aside', 'audio', 'image', 'video', 'gallery', 'chat', 'link', 'quote', 'status' ) );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function handcraftedwp_widgets_init() {
	register_sidebar( array (
		'name' => __( 'Sidebar', 'themename' ),
		'id' => 'sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
}
add_action( 'init', 'handcraftedwp_widgets_init' );

/*
 * Remove senseless dashboard widgets for non-admins. (Un)Comment or delete as you wish.
 */
function remove_dashboard_widgets() {
	global $wp_meta_boxes;

	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // Plugins widget
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPress Blog widget
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // Other WordPress News widget
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); // Right Now widget
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // Quick Press widget
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // Incoming Links widget
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // Recent Drafts widget
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // Recent Comments widget
}

/**
 *	Hide Menu Items in Admin
 */
function themename_configure_dashboard_menu() {
	global $menu,$submenu;

	global $current_user;
	get_currentuserinfo();

		// $menu and $submenu will return all menu and submenu list in admin panel
		
		// $menu[2] = ""; // Dashboard
		// $menu[5] = ""; // Posts
		// $menu[15] = ""; // Links
		// $menu[25] = ""; // Comments
		// $menu[65] = ""; // Plugins

		// unset($submenu['themes.php'][5]); // Themes
		// unset($submenu['themes.php'][12]); // Editor
}


// For non-admins, add action to Hide Dashboard Widgets and Admin Menu Items you just set above
// Don't forget to comment out the admin check to see that changes :)
if (!current_user_can('manage_options')) {
	add_action('wp_dashboard_setup', 'remove_dashboard_widgets'); // Add action to hide dashboard widgets
	add_action('admin_head', 'themename_configure_dashboard_menu'); // Add action to hide admin menu items
}


?>
<?php // asynchronous google analytics: mathiasbynens.be/notes/async-analytics-snippet
//	 change the UA-XXXXX-X to be your site's ID
/*add_action('wp_footer', 'async_google_analytics');
function async_google_analytics() { ?>
	<script>
	var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']];
		(function(d, t) {
			var g = d.createElement(t),
				s = d.getElementsByTagName(t)[0];
			g.async = true;
			g.src = ('https:' == location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g, s);
		})(document, 'script');
	</script>
<?php }*/ ?>
<?php /*
 * A default custom post type. DELETE from here to the end if you don't want any custom post types
 */
/*add_action('init', 'create_boilertemplate_cpt');
function create_boilertemplate_cpt() 
{
  $labels = array(
    'name' => _x('HandcraftedWPTemplate CPT', 'post type general name'),
    'singular_name' => _x('HandcraftedWPTemplate CPT Item', 'post type singular name'),
    'add_new' => _x('Add New', 'handcraftedwptemplate_robot'),
    'add_new_item' => __('Add New Item'),
    'edit_item' => __('Edit Item'),
    'new_item' => __('New Item'),
    'view_item' => __('View Item'),
    'search_items' => __('Search Items'),
    'not_found' =>  __('No items found'),
    'not_found_in_trash' => __('No items found in Trash'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'page',
    'hierarchical' => false,
    'menu_position' => 20,
    'supports' => array('title','editor')
  ); 
  register_post_type('handcraftedwptemplate_robot',$args);
}*/
/*
 * This is for a custom icon with a colored hover state for your custom post types. You can download the custom icons here 
 http://randyjensenonline.com/thoughts/wordpress-custom-post-type-fugue-icons/
 */
/*add_action( 'admin_head', 'cpt_icons' );
function cpt_icons() {
    ?>
    <style type="text/css" media="screen">
        #menu-posts-handcraftedwptemplaterobot .wp-menu-image {
            background: url(<?php bloginfo('template_url') ?>/images/robot.png) no-repeat 6px -17px !important;
        }
		#menu-posts-handcraftedwptemplaterobot:hover .wp-menu-image, #menu-posts-handcraftedwptemplaterobot.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
    </style>
<?php }*/ 


function print_video_thumb_backward($post, &$thumb_url) {
    $video_id = get_post_meta($post->ID, 'vids', true);
    if (! empty($video_id)) {    
            $thumb_url = 'http://img.youtube.com/vi/' . $video_id . '/2.jpg';
            return 1;
    }
}



function print_video_thumb_supported_site($post,&$thumb_url) {
    $content = $post->post_content;
    if (preg_match(video_pattern(),$content, $match)) {
        // video found
        $content = $match[0];
        preg_match('/^\[(\w+)/',$content,$video_type);
        switch ($video_type[1]) {
            case 'youtube':
                preg_match('/v=(.*?)[\s&\[]/',$content,$video_id);
                $thumb_url = 'http://img.youtube.com/vi/' . $video_id[1] . '/2.jpg';
                return 1;
            case 'googlevideo':
                preg_match('/docid=(.*?)[\s&\[]/',$content,$docid);
                $url = 'http://video.google.com/videofeed?docid=' . $docid[1];
            $data = get_url($url);
                preg_match("/media:thumbnail url=\"([^\"]\S*)\"/siU",$data,$t_url); 
                $thumb_url = $t_url[1]; 
                return 1;
            case 'vimeo':
                preg_match('/\/(\d+)\[/',$content,$docid);
                $url = 'http://vimeo.com/api/clip/' . $docid[1] . '.php';
                $data = get_url($url);
                /* Bypass Vimeo Api problem: http://www.vimeo.com/forums/topic:11826 */
                preg_match('/thumbnail_large"\;s:\d+:"(.*?)"/',$data,$t_url);
                // $thumb_url = $t_url[0]['thumbnail_large'];
                $thumb_url = $t_url[1];
                return 1;
            case 'flv':
                preg_match('/\](.*?)\[/',$content,$url);
                $thumb_url = preg_replace('/\.((flv)|(swf)|(f4v))$/','.jpg',$url[1],1);
                return 1;
            case 'quicktime':
                preg_match('/\](.*?)\[/',$content,$url);
                $thumb_url = preg_replace('/\.mov$/','.jpg',$url[1],1);
                return 1;
            case 'dailymotion':
                preg_match('/\](.*?)\[/',$content,$url);
                $data = get_url($url[1]);
                preg_match('/\.addVariable\("preview",\s*"(.*?)"\)/',$data,$t_url);
                $thumb_url = urldecode($t_url[1]);
                return 1;
            case 'veoh':
                preg_match('/\/watch\/([[:alnum:]]+)[\s&\[]/',$content,$docid);
                $url = 'http://www.veoh.com/rest/video/' . $docid[1] . '/details';
                $data = get_url($url);
                preg_match('/fullHighResImagePath="(.*?)"/', $data, $t_url);
                $thumb_url = $t_url[1];
                return 1;
            case 'viddler':
                preg_match('/id=([[:alnum:]]+)/',$content,$docid);
                $thumb_url = 'http://cdn-thumbs.viddler.com/thumbnail_2_' . $docid[1] . '.jpg';
                return 1;
            case 'metacafe':
                preg_match('/\/watch\/([0-9]+)\//',$content,$docid);
                $thumb_url = 'http://s4.mcstatic.com/thumb/' . $docid[1] . '.jpg';
                return 1;
            case 'blip':
                preg_match('/posts_id=([[:alnum:]]+)/',$content,$docid);
                $url = 'http://blip.tv/rss/flash/' . $docid[1];
                $data = get_url($url);
                preg_match('/<blip:smallThumbnail>(.*?)<\/blip:smallThumbnail>/', $data, $t_url);
                $thumb_url = $t_url[1];
                return 1;
            case 'flickrvideo':
                preg_match('/\](.*?)\[/',$content,$url);
                preg_match('/\/([0-9]+)\/?\[/',$content,$docid);
                $data = get_url($url[1]);
                preg_match('/\.video_thumb_src\s*=\s*\'(\S+)\';/',$data,$t_url);
                $thumb_url = $t_url[1];
                return 1;
            case 'spike':
                preg_match('/\/([0-9]+)\/?\[/',$content,$docid);
                $thumb_url = 'http://dyn.ifilm.com/resize/image/stills/films/resize/istd/' . $docid[1] . '.jpg?width=160';
                return 1;
        }
    }
}

function print_video_thumb_custom_field($post,&$thumb_url) {
    $t = get_post_meta($post->ID, 'video_thumb', true);
    if (! empty($t)) {
        $thumb_url = $t;
        return 1;
    }
}

function print_video_thumb_first_post_image($post,&$thumb_url) {
    $content = $post->post_content;
    if (preg_match('/<img[[:alnum:]\s-_=;:"\/]+src="(.*?)"/',$content, $match)) {
        $thumb_url = $match[1];
        return 1;
    }
}

function print_video_thumb_unsupported_site($post,&$thumb_url) {
    $content = $post->post_content;
    if (preg_match(video_pattern(),$content, $match)) {
        // video found
        $content = $match[0];
        preg_match('/^\[(\w+)/',$content,$video_type);
        switch ($video_type[1]) {
            case 'myspace':
                $thumb_url = get_template_directory_uri() . '/images/thumb_noimage.png';
                return 1;
        }
    }
}

function print_video_thumb($post) {
    print_video_thumb_backward($post,$thumb_url)
     || print_video_thumb_custom_field($post,$thumb_url)
     ||    print_video_thumb_supported_site($post,$thumb_url)
     ||    print_video_thumb_first_post_image($post,$thumb_url)
     || print_video_thumb_unsupported_site($post,$thumb_url);
    echo get_video_thumb(get_permalink($post->ID), $post->post_title,
                    $thumb_url);
}

function get_video_thumb($url,$title,$img) {
    return '<a href="' . $url . '" title="' . $title . '"><img src="' .
        $img . '" alt="' . $title . '" width="90px" height="90px" /></a>';
}

function print_video($post) {
    // Backword compatibility with standard Videographer
    $video_id = get_post_meta($post->ID, 'vids', true);
    if (! empty($video_id)) {
            echo '<div class="vid">';
            wpyoutube('video', $video_id);
            echo '</div>';
            return;
    }
    $content = $post->post_content;
    if (preg_match(video_pattern(),$content, $match)) {
        // video found
        $content = $match[0];
        $content = apply_filters('the_content', $content);
        echo $content;
    }
}

function video_pattern() {
    $pattern = '/
          (\[youtube(.*?)\[\/youtube\])                     # YouTube video
        | (\[googlevideo(.*?)\[\/googlevideo\])     # Google video
        | (\[vimeo(.*?)\[\/vimeo\])                             # Vimeo video
        | (\[flv(.*?)\[\/flv\])                                         # Flash video
        | (\[quicktime (.*?)\[\/quicktime \])            # Quicktime video
        | (\[dailymotion (.*?)\[\/dailymotion \])    # Quicktime video
        | (\[veoh (.*?)\[\/veoh \])                                # Veoh video
        | (\[viddler\s+([[:alnum:]=&;]+)\])                # Viddler video
        | (\[metacafe (.*?)\[\/metacafe \])                # Veoh video
        | (\[blip\.tv\s+\?([[:alnum:]_=\-&;]+)\])    # Blip.tv video
        | (\[flickrvideo (.*?)\[\/flickrvideo \])    # Flickr Video video
        | (\[spike (.*?)\[\/spike \])                            # Spike.com video
        | (\[myspace (.*?)\[\/myspace \])                    # MySpace video
        /mx';
    return $pattern;
}

function get_the_content_video($more_link_text = null, $stripteaser = 0, $more_file = '')
{
  $content = get_the_content($more_link_text, $stripteaser, $more_file);
    // remove first video just show in print_video()
    $content = preg_replace(video_pattern(),'',$content,1);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

function the_content_video($more_link_text = null, $stripteaser = 0, $more_file = '') {
    echo get_the_content_video($more_link_text, $stripteaser, $more_file);
}

function get_url($url) {
    $fp = fopen( $url, 'r' );
     $data = "";
     while( !feof( $fp ) ) {
         $buffer = trim( fgets( $fp, 4096 ) );
         $data .= $buffer;
     }
    return $data;
}


/*MAS POPULARE*/

function popularPosts($num) {
    global $wpdb;
  
    $posts = $wpdb->get_results("SELECT comment_count, ID, post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , $num");
  
    foreach ($posts as $post) {
        setup_postdata($post);
        $id = $post->ID;
        $title = $post->post_title;
        $count = $post->comment_count;
	
  
        if ($count != 0) {
			$popular .= '<div class="post_pop">';
            $popular .= '<div class="contenido_pop_post">';
			$popular .= '<div class="img_post_pop">' . the_post_thumbnail(array() ). '</div>';
			$popular .= '<div class="foot_post_pop"><a href="' . get_permalink($id) . '" title="' . $title . '">' . $title . '</a></div>';
         	$popular .= '</div>';
			$popular .= '</div>';
			        }
    }
    return $popular;
}




////CORTADOR DE IMAGENES
if ( function_exists( 'add_image_size' ) ) {  
    add_image_size('para_los_post', 330, 164, true);  
    add_image_size('cuadrada_peque', 231, 186, true); 
    add_image_size('post_sidebar', 80, 80, true);  
}  


add_filter('image_size_names_choose', 'hmuda_image_sizes');  
function hmuda_image_sizes($sizes) {  
    $addsizes = array(  
        "para_los_post" => __("Cada post"),
        "cuadrada_peque" => __("Recientes on top"),
        "post_sidebar" => __("Post sidebad"),
    );  
    $newsizes = array_merge($sizes, $addsizes);  
    return $newsizes;  
}  
////FIN CORTADOR DE IMAGENES




// RECIENTES DEBAJO DEL MENU PRINCIPAL
function los_recientes(){
	
	$que_posts = new WP_Query('showposts=4&orderby=post_date&order=desc');
	while ($que_posts->have_posts()){  
    	echo '<div class="post_pop">';
    	echo '<div class="contenido_pop_post">';
		$que_posts->the_post();
    	echo '<div class="img_post_pop">';
    	echo'<a href="'; the_permalink(); echo'">'; the_post_thumbnail('cuadrada_peque'); echo'</a>';
    	echo '</div>';
    	echo'<div class="foot_post_pop">';
    	echo'<a href="'; the_permalink(); echo'">'; the_title(); echo'</a>';
    	/*the_excerpt();*/
    	echo'</div>';
		echo '</div></div>';
		}

}
//////////////////////FIN RECIENTES DEBAJO DEL MENU PRINCIPAL


// LIMITA EL NUMERO DE PALABRAS DEL CONTENT

function the_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
     $content = get_the_content($more_link_text, $stripteaser, $more_file);
     $content = apply_filters('the_content', $content);
     $content = str_replace(']]>', ']]&gt;', $content);
     $content = strip_tags($content);
    if (strlen($_GET['p']) > 0) {
         // echo "<p>";
         echo $content;
         echo "...";
         echo "&nbsp;<a href='";
         the_permalink();
         echo "'>".$more_link_text."</a>";
         // echo "</p>";
     }
     else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
         $content = substr($content, 0, $espacio);
         $content = $content;
         // echo "<p>";
         echo $content;
         echo "...";
         echo "&nbsp;<a href='";
         the_permalink();
         echo "'>Leer m&aacutes</a>";
         // echo "</p>";
     }
     else {
         // echo "<p>";
         echo $content;
         echo "...";
         echo "&nbsp;<a href='"; the_permalink();        echo "'>Leer m&aacutes</a>";
         // echo "</p>";
     }
 }



// PARA COLOREAR FONDO DE ITEM SELECCIONADO DEL MENU PRINCIPAL

function detecta_item(){


    if (is_home()){

        echo "<style type='text/css'>#inicio_link{background-color:#000;}</style>";

    }elseif (is_category('1')) {

        echo"<style type='text/css'>.menu-item-174{background-color:#000;}</style>";
    }

}



// Insertar Breadcrumb   Camino de pan

function the_breadcrumb() {

    if (!is_home()) {

        echo '<span class="removed_link" title="&#039;;
        echo get_option(&#039;home&#039;);
            echo &#039;">';
        bloginfo('name');
        echo "</span> » ";
        if (is_category() || is_single()) {
            the_category('title_li=');
            if (is_single()) {
                echo " » ";
                the_title();
            }
        } elseif (is_page()) {
            echo the_title();
        }

    }
}   

// fin breadcrumb

function miplugin_register_sidebars(){
    register_sidebar(array(
        "name" => "Nombre de la Sidebar",
        "id" => "id-unico-para-la-sidebar",
        "descripcion" => "Descripción de la Sidebar",
        "class" => "clase-del-elemento",
        "before_widget" => "<li id='%1$s' class='%2$s'>",
        "after_widget" => "</li>",
        "before_title" => "<h2 class='titulodelwidget'>",
        "after_title" => "</h2>"
    ));
}
add_action('widgets_init','miplugin_register_sidebars');



// BUCLE PARA LOS POST MAS COMENTADOS
function mas_comentados($titulo){


    echo'<div class="conte_sidebar">';
    echo '<div class="titulo_seccion">';echo $titulo; echo'</div>';
    $que_posts = new WP_Query('showposts=5&orderby=comment_count&order=DESC');
    while ($que_posts->have_posts()){ 

        echo '<div class="post_comentado">';
            echo '<div class="contenido_comentado">';
                 $que_posts->the_post();
                 
            echo '<div class="img_comentado">';
                echo'<a href="'; the_permalink(); echo'">'; the_post_thumbnail('post_sidebar'); echo'</a>';
            echo '</div>';

            echo'<div class="name_post">';
              echo'<a href="'; the_permalink(); echo'">'; the_title(); echo'</a>';
             /*the_excerpt();*/
            echo'</div>';

        echo'<div class="foot_comentado">';
            comments_popup_link( __( '<span class="imgc">%</span>', 'themename' ) );
        echo'</div>';//.foot_comentado
       
        echo'</div>';//.post_comentado
        echo'</div>';//.contenido_comentado

        }
    echo'</div>';

}
// .BUCLE PARA LOS POST MAS COMENTADOS





?>