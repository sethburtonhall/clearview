<?php
/**
 * Template Name: Home Page
 * Description: A Page Template without a sidebar
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.2.0
 */

get_header(); ?>

	<div class="hero-wrapper">
		<div id="slider-home" class="row"><!-- Slider -->
	    <div class="twelve columns">
        <div id="slider">
        	<?php echo do_shortcode( "[wpv-view name='Home Slider']" ); ?>
        </div>
	    </div>
		</div><!-- / Slider -->
	</div><!-- End orbit Wrapper -->

	<!-- Row for main content area -->
	<div id="content" class="row">

		<div id="main" class="home-widget-wrapper twelve columns" role="main">
			<div class="home-widgets four columns">
				<!-- News Feed Widget -->
				<?php if ( is_active_sidebar( 'news-feed' )) { ?>
				<?php dynamic_sidebar( 'news-feed' );} ?>
			</div>
			<div class="home-widgets four columns">
				<!-- Our Story Excerpt Widget -->
				<?php

				// replace default elipsis
				function new_excerpt_more( $more ) {
					return ' ... &nbsp;<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">Read&nbsp;More</a>';
				}
				add_filter('excerpt_more', 'new_excerpt_more');

				// change excerpt length
				function custom_excerpt_length( $length ) {
					return 16;
				}
				add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

				// The Query
				$the_query = new WP_Query( 'page_id=35' );
				// The Loop
				while ( $the_query->have_posts() ) : $the_query->the_post();
				echo '<h3 class="widgettitle">Our Story</h3> <li>';
				the_excerpt();
				echo '</li>';
				endwhile;
				// Reset Post Data
				wp_reset_postdata();
				?>
			</div>
			<div class="home-widgets four columns">
				<!-- Recent Posts Widget -->
				<?php if ( is_active_sidebar( 'recent-posts' )) { ?>
				<?php dynamic_sidebar( 'recent-posts' );} ?>
			</div>
		</div><!-- /#main -->

	</div><!-- End Content row -->

<?php get_footer(); ?>
