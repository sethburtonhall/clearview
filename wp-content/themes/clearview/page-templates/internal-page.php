<?php
/**
 * Template Name: Internal Page
 * Description: A Page Template with a subnavigation on the left side
 * @package required+ Foundation
 * @since required+ Foundation 0.5.0
 */

get_header(); ?>

    <div class="hero-wrapper"></div><!-- End Hero Wrapper -->

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

                            <!-- conditional loading for all team member pages -->
                            <?php
                            if( $post->post_parent == '41') {
                                echo '<div class=team-side-nav-wrapper>';
                                if ( function_exists( 'required_side_nav' ) )
                                    required_side_nav();
                                echo '</div>';
                            } else {
                                if ( function_exists( 'required_side_nav' ) )
                                    required_side_nav();
                            }
                            ?>

                        </aside><!-- /#sidebar -->
                    </div>

                    <div class="page-content eight columns">
                        <?php if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb('<p id="breadcrumbs">','</p>');
                        } ?>
                        
                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php get_template_part( 'content', 'page' ); ?>

                        <?php endwhile; // end of the loop. ?>
                    </div>
                </div><!-- end .page-border -->
            </div><!-- end .page-wrap -->
        </div><!-- /#main -->


    </div><!-- End Content row -->

<?php get_footer(); ?>
