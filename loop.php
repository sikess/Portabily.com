<?php
/**
 * @package WordPress
 * @subpackage themename
 */
?>

<?php /* Display navigation to next/previous pages when applicable */ ?>


<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>

	<div class="conte_el_post">
    <div class="cuerpo_post">
    	
    <div class="cabeza_post">   
    	
        	<div class="titulo_post"> 	
            
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
					<header class="entry-header">
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themename' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>

					</header><!-- .entry-header -->
  
  			</div><!--.titulo_post-->
        </div><!--.cabeza_post-->
        
        
<div class="imagen_post">    

	<div class="eti_cate"><?php the_category( ', ' ); ?></div>
    
        <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
	
the_post_thumbnail('para_los_post');
} else {
	
$postimage = get_post_meta($post->ID, 'post-image', true);
if ($postimage) {
	
echo '<img src="'.$postimage.'" alt="" />';
}else{
	echo '<img src="http://tupagina.com/thumbail_generica.png" alt="Thumbnail genérica" />';
	}
} 
?>
    	
</div><!--.imagen_post-->
        
        <div class="cont_foot_post">
        		<div class="post_meta">
				<?php
					printf( __( '<a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s" pubdate>%3$s</time></a> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s">%6$s</a></span>', 'themename' ),
						get_permalink(),
						get_the_date( 'c' ),
						get_the_date(),
						get_author_posts_url( get_the_author_meta( 'ID' ) ),
						sprintf( esc_attr__( 'View all posts by %s', 'themename' ), get_the_author() ),
						get_the_author()
					);
				?>
			
     			  </div><!-- .post_meta-->
       
       
        <div class="fracmento_post">

		<?php if ( is_archive() || is_search() ) : // Only display Excerpts for archives & search ?>
		<div class="entry-summary">
			<?php the_excerpt();?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content_limit('130'); /*the_excerpt_rss();*/ ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'themename' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>
        
    </div><!--.fracmento_post_meta-->
    
    
    
     <div class="foot_meta">

		<footer class="entry-meta">
			<span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php /*_e( 'Posted in ', 'themename' );*/ ?></span><?php /*the_category( ', ' );*/ ?></span>
			<span class="meta-sep"> | </span>
			<?php the_tags( '<span class="tag-links">' . __( 'Tagged ', 'themename' ) . '</span>', ', ', '<span class="meta-sep"> | </span>' ); ?>
			<span class="comments-link"><?php  comments_popup_link( __( '<span>Comentar</span>', 'themename' ), __( '<span class="imgc">01</span>', 'themename' ), __( '<span class="imgc">%</span>', 'themename' ) ); ?></span>
			<?php edit_post_link( __( 'Edit', 'themename' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?><span class="share_post">Compartir:</span>
		</footer><!-- #entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->

	<?php comments_template( '', true ); ?>
    
   
   
   </div><!--.foot_metas-->
    
     </div><!-- .cont_foot_post -->
     
    </div><!--.cuerpo_post-->
    
</div><!--.conte_el_post-->
<?php endwhile; ?>


