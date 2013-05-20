<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.1.0
 */
get_header(); ?>

	<!-- Row for main content area -->
	<div id="content" class="row">

		<div id="main" class="twelve columns" role="main">
			<div class="page-wrap">
		    <div class="page-border">
		        <div class="aside-wrapper four columns">
		            <div class="featured-image">
		                <?php 
		                if(has_post_thumbnail()) {                    
		                    $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'medium' );
		                     echo '<img src="' . $image_src[0]  . '" width="100%"  />';
		                } 
		                ?>
		            </div>

		            <aside id="side-nav" class="side-nav-wrapper" role="complementary">

		            </aside><!-- /#sidebar -->

		        </div>

		        <div class="page-content eight columns">
		            <?php if ( function_exists('yoast_breadcrumb') ) {
		            yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		            } ?>
		            
		            <div class="post-box entry-content">
		            <?php if ( have_posts() ) : ?>

		            	<?php
		            		/* Queue the first post, that way we know
		            		 * what author we're dealing with (if that is the case).
		            		 *
		            		 * We reset this later so we can run the loop
		            		 * properly with a call to rewind_posts().
		            		 */
		            		the_post();

		            		/* Get the archive title for the specific archive we are
		            		 * dealing with.
		            		 */
		            		required_archive_title();

		            		/* Since we called the_post() above, we need to
		            		 * rewind the loop back to the beginning that way
		            		 * we can run the loop properly, in full.
		            		 */
		            		rewind_posts();
		            	?>

		            	<?php /* Start the Loop */ ?>
		            	<?php while ( have_posts() ) : the_post(); ?>

		            		<?php
		            			/* Include the Post-Format-specific template for the content.
		            			 * If you want to overload this in a child theme then include a file
		            			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		            			 */
		            			get_template_part( 'content', get_post_format() );
		            		?>

		            	<?php endwhile; ?>

		            <?php else : ?>
		            	<?php get_template_part( 'content', 'none' ); ?>
		            <?php endif; ?>

		            <?php if ( function_exists( 'required_pagination' ) ) {
		            	required_pagination();
		            } ?>

		            </div>
		        </div>
		    </div><!-- end .page-border -->
		  </div><!-- end .page-wrap -->
		</div><!-- /#main -->
	</div>
<?php get_footer(); ?>
