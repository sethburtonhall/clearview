<?php
/**
 * Template Name: Left Nav Page Template
 * Description: A Page Template with a subnavigation on the left side
 * @package required+ Foundation
 * @since required+ Foundation 0.5.0
 */

get_header(); ?>

    <!-- Row for main content area -->
    <div id="content" class="row">

        <div id="main" class="page-wrap twelve columns" role="main">
            <div class="page-border">
                <div class="aside-wrapper four columns">
                    <div class="featured-image">
                        <?php echo get_the_post_thumbnail( $post_id, $attr ); ?>
                    </div>
                    <aside id="side-nav" class="side-nav-wrapper" role="complementary">
                        <?php
                            if ( function_exists( 'required_side_nav' ) )
                                required_side_nav();
                        ?>
                    </aside><!-- /#sidebar -->
                </div>

                <div class="page-content eight columns">
                    <ul class="breadcrumbs">
                        <?php breadcrumbs(); ?>
                    </ul>
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'content', 'page' ); ?>

                    <?php endwhile; // end of the loop. ?>
                </div>
            </div><!-- end .page-border -->

        </div><!-- /#main -->


    </div><!-- End Content row -->

<?php get_footer(); ?>
