<?php
/**
 * Template Name: Meet the Team Page
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
                    </div> <!-- end .aside-wrapper -->

                    <div class="page-content eight columns">
                        <?php if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb('<p id="breadcrumbs">','</p>');
                        } ?>

                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php get_template_part( 'content', 'page' ); ?>

                        <?php endwhile; // end of the loop. ?>

                        <!-- call child page content -->
                    <div class="entry-content">

                        <!-- custom excerpt text and length -->
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
                        ?> <!-- end custom excerpt text and length -->

                        <!-- child page loop -->
                        <?php
                            $mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'assc' ) );

                            foreach( $mypages as $page ) {
                                $thumbnail = get_the_post_thumbnail($page->ID, 'medium');
                                $content = substr( $page->post_content,0, 200) . '<a class="read-more" href="' . get_page_link( $page->ID ) . '">... Read more</a>';
                                $excerpt = $page->post_excerpt;
                                if ( ! $content ) // Check for empty page
                                    continue;

                                $content = apply_filters( 'the_content', $content );
                            ?>
                                    <div class="team-members">
                                        <a class="darkGray-text" href="<?php echo get_page_link( $page->ID ); ?>">
                                            <div class="row">
                                                <div class="child-thumb five columns">
                                                    <?= $thumbnail ?>
                                                </div>
                                                <div class="entry seven columns">
                                                    <?php echo $content; ?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            <?php
                            }
                        ?>  <!-- end child page loop --> 
                        <hr>
                        <div class="row">
                            <div class="twelve columns">
                                <div class="cfp-logo">
                                    <div class="cfp-img three columns ">
                                        <a href="http://www.cfp.net/" title="FPA" target="_blank" ><img class="cfp" src="<?php echo get_stylesheet_directory_uri(); ?>/images/cfp-logo.png" alt=""></a>
                                    </div>
                                    <div class="cfp-disclosure nine columns">
                                        <p>Certified Financial Planner Board of Standards Inc. owns the certification marks CFP®, CERTIFIED FINANCIAL PLANNER™, CFP® (with plaque design) and CFP® (with flame design) in the U.S., which it awards to individuals who successfully complete CFP Board's initial and ongoing certification requirements.</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div> <!-- end .entry-content -->
                    </div> <!-- end .page-content -->
                </div><!-- end .page-border -->
            </div><!-- end .page-wrap -->
        </div><!-- /#main -->


    </div><!-- End Content row -->

<?php get_footer(); ?>
