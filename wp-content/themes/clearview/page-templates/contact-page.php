<?php
/**
 * Template Name: Contact Page
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

                            <!-- map and follow us section -->
                            <?php
                                echo '<iframe class="map" width="100%" height="310" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Charlotte,+NC+28299&amp;aq=0&amp;oq=Charlotte,+NC+28299&amp;sll=35.218873,-80.810877&amp;sspn=0.012008,0.024784&amp;ie=UTF8&amp;hq=&amp;hnear=Charlotte,+North+Carolina+28299&amp;t=m&amp;z=14&amp;iwloc=A&amp;ll=35.218873,-80.810877&amp;output=embed"></iframe>';
                                echo '<div class="follow-us">
                                <h3>Follow Us</h3>
                                <a class="large button" href="blog">Read our Blog</a>
                                <a href="http://linkedin.com">
                                <img class="linkedin-logo" src="';
                                echo get_stylesheet_directory_uri();
                                echo '/images/linkedin-logo.png">
                                </a>
                                </div>';
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
            </div>
        </div><!-- /#main -->

    </div><!-- End Content row -->

<?php get_footer(); ?>
