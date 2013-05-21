<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.1.0
 */
?>
    <!-- START: content-page.php -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-content">
            <?php the_content(); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'requiredfoundation' ) . '</span>', 'after' => '</div>' ) ); ?>
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

        </div><!-- .entry-content -->
    </article><!-- #post-<?php the_ID(); ?> -->
    <!-- END: content-page.php -->
