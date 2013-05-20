<?php
/**
 * The default template for displaying content search/archive
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.3.0
 */
?>

	<!-- START: content.php -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="row">
			<div class="four columns">
				<header class="entry-header">
					<?php the_post_thumbnail('thumbnail'); ?>
				</header><!-- .entry-header -->
			</div><!-- .five .columns -->

			<div class="eight columns">
				<h3 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'requiredfoundation' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h3>
				<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php required_posted_on(); ?>
					<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
					<span class="label radius secondary"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'requiredfoundation' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _ex( 'Featured', 'Post format title', 'requiredfoundation' ); ?></a></span>
					<?php endif; ?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
				<?php if ( is_search() ) : // Only display Excerpts for Search ?>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
				<?php else : ?>
				<div>
					<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'requiredfoundation' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'requiredfoundation' ) . '</span>', 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
				<?php endif; ?>

				<footer class="entry-meta">
					<?php if ( 'post' == get_post_type() ) : ?>
					<?php get_template_part('entry-meta', get_post_format() ); ?>
					<?php endif; ?>
				</footer><!-- #entry-meta -->
			</div><!-- .seven .columns -->
		</div>

	</article><!-- #post-<?php the_ID(); ?> -->
	<!-- END: content.php -->
