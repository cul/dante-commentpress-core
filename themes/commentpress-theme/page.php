<?php get_header(); ?>



<!-- page.php -->

<div id="wrapper">



<div id="main_wrapper" class="clearfix">



<div id="page_wrapper">



<div id="content">



<?php

 /*
// for use in category template, get link to previous/next (alphabetic) categories
$current_page = get_the_ID();
$previous = -1;
$next = 0;
$count = 0;
$args = array(
'sort_column' => 'ID',
'sort_order' => 'ASC',
'hierarchical' => 0,
'hide_empty' => 1
);
	
$pages = get_pages($args);

foreach ($pages as $pag) {
		
$count++;

if ($pag->ID == $current_page) {

 $previous = $count - 2;
									     
 $next = $count;
									 
}
									 
}

if($current_page == 8672){
  $previous = -1;
 }


if ($previous >= 0){

echo '<p>Previous page: <a href="' . get_page_link( $pages[$previous]->ID ) . '" title="' . sprintf( __( "View all posts in %s" ), $pages[$previous]->post_title ) . '" ' . '>' . $pages[$previous]->post_title.'</a> </p> ';
									 
}
									 
if ($next > 0 && $next < count($pages)) {
									   
echo '<p>Next page: <a href="' . get_page_link( $pages[$next]->ID ) . '" title="' . sprintf( __( "View all posts in %s" ), $pages[$next]->post_title ) . '" ' . '>' . $pages[$next]->post_title.'</a> </p> ';
								
}
								       
 */




?>



<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


<div class="post<?php echo commentpress_get_post_css_override( get_the_ID() ); ?>" id="post-<?php the_ID(); ?>">


	<?php
	
	// if we've elected to show the title...
	if ( commentpress_get_post_title_visibility( get_the_ID() ) ) {

	?>
	<h2 class="post_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
	<?php
	
	}


	?>
	



	<?php
	
	// if we've elected to show the meta...
	if ( commentpress_get_post_meta_visibility( get_the_ID() ) ) {

	?>
	<div class="search_meta">
		
		<?php commentpress_echo_post_meta(); ?>
		
	</div>
	<?php
	
	}

	?>
	
	
	
	<?php global $more; $more = true; the_content(''); ?>



	<?php
	
	// test for "Post Tags and Categories for Pages" plugin
	if ( class_exists( 'PTCFP' ) ) {
	
	?>
	<p class="search_meta"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?></p>
	<?php
	
	}
	
	?>
	
	
	
	<?php
	
	// NOTE: Comment permalinks are filtered if the comment is not on the first page 
	// in a multipage post... see: commentpress_multipage_comment_link in functions.php
	echo commentpress_multipager();

	?>



	<?php 

	// if we have the plugin enabled...
	if ( is_object( $commentpress_core ) ) {
	
		// get page num
		$num = $commentpress_core->nav->get_page_number( get_the_ID() );
		
		//print_r( $num ); die();
	
		// if we get one
		if ( $num ) {
			
			// is it arabic?
			if ( is_numeric( $num ) ) {
			
				// add page number
				?><div class="running_header_bottom">page <?php echo $num; ?></div><?php 
		
			} else {
			
				// add page number
				?><div class="running_header_bottom">page <?php echo strtolower( $num ); ?></div><?php 
		
			}
			
		}
		
	} 
	
	?>


</div><!-- /post -->



<?php endwhile; else: ?>



<div class="post">

	<h2 class="post_title">Page Not Found</h2>
	
	<p>Sorry, but you are looking for something that isn't here.</p>
	
	<?php get_search_form(); ?>

</div><!-- /post -->



<?php endif; ?>



</div><!-- /content -->



</div><!-- /page_wrapper -->



</div><!-- /main_wrapper -->



</div><!-- /wrapper -->



<?php get_sidebar(); ?>



<?php get_footer(); ?>