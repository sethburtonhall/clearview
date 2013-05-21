<?php
/**
 * Template Name: Blog Page
 * Description: A Page Template with a subnavigation on the left side
 * @package required+ Foundation
 * @since required+ Foundation 0.5.0
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
                  <?php
                    if ( function_exists( 'required_side_nav' ) )
                        required_side_nav();
                  ?>
                </aside><!-- /#sidebar -->

            </div>

            <div class="page-content eight columns">
                <?php if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb('<p id="breadcrumbs">','</p>');
                } ?>
                
                <div class="post-box entry-content">

                  <h3>Welcome to the our Blog</h3>

                <?php if ( have_posts() ) : ?>

                  <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'content', get_post_format() ); ?>

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
