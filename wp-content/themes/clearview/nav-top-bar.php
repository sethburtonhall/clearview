<?php
/**
 * Template part for a top bar navigation
 *
 * Used to display the main navigation with
 * our custom Walker Class to make sure the
 * navigation is rendered the way Foundation
 * does.
 *
 * @since  required+ Foundation 0.5.0
 */
?>
            <!-- START: nav-top-bar.php -->
            <!-- <div class="contain-to-grid"> // enable to contain to grid -->
                <nav class="top-bar">
                    <p class="nav-callout">Menu</p>
                    <ul>
                        <li class="toggle-topbar"><a href="#"></a></li>
                    </ul>
                    <section>
                    <?php
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'depth' => 0,
                            'items_wrap' => '<ul class="left">%3$s</ul>',
                            'fallback_cb' => 'required_menu_fallback', // workaround to show a message to set up a menu
                            'walker' => new REQ_Foundation_Walker( array(
                                'in_top_bar' => true,
                                'item_type' => 'li'
                            ) ),
                        ) );
                    ?>
                    </section>
                </nav>
            <!-- </div> -->
            <!-- END: nav-top-bar.php -->
