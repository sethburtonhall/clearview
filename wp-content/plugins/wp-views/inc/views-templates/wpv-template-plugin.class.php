<?php

require WPV_PATH_EMBEDDED . '/inc/views-templates/wpv-template.class.php';

class WPV_template_plugin extends WPV_template {

	function add_view_template_settings() {
          wp_enqueue_script( 'views-codemirror-script',
                WPV_URL . '/res/js/views_codemirror_conf.js', array('jquery'),
                WPV_VERSION );

        ?>
        <script type="text/javascript">                        
            
            function CodeMirror_fix_toolbar(){

                // Init CodeMirror
                icl_editor.codemirror('content', true);

                // Append button
                jQuery('#ed_toolbar').append('<input type="button" value="<?php echo esc_js(__( "Syntax Highlight On", 'wpv-views' )); ?>" title="<?php echo esc_js(__(  "Syntax Highlight On", 'wpv-views' )); ?>" class="ed_button cred_qt_codemirror_on" id="qt_content_cred_syntax_highlight">');

                // Show/hide elements
                jQuery('.ed_button').hide();
                jQuery('.insert-media.add_media').hide();
                jQuery('#qt_content_cred_syntax_highlight').show();

                // Bind toggle click
                jQuery('#qt_content_cred_syntax_highlight').click(function() {
                    // Toggle CodeMirror OFF
                    if (jQuery(this).hasClass('cred_qt_codemirror_on')){
                        jQuery('.ed_button').show(); 
                        jQuery('.insert-media.add_media').show();
                        jQuery(this).removeClass('cred_qt_codemirror_on').addClass('cred_qt_codemirror_off').attr('title','<?php echo esc_js(__(  "Syntax Highlight Off", 'wpv-views' )); ?>').val('<?php echo esc_js(__(  "Syntax Highlight Off", 'wpv-views' )); ?>');
                        icl_editor.toggleCodeMirror('content', false);
                    }else{
                        // Toggle CodeMirror ON
                        jQuery('.ed_button').hide();
                        jQuery('.insert-media.add_media').hide();
                        jQuery('#qt_content_cred_syntax_highlight').show();
                        jQuery(this).addClass('cred_qt_codemirror_on').removeClass('cred_qt_codemirror_off').attr('title','<?php echo esc_js(__(  "Syntax Highlight On", 'wpv-views' )); ?>').val('<?php echo esc_js(__(  "Syntax Highlight On", 'wpv-views' )); ?>');
                        icl_editor.toggleCodeMirror('content', true);
                    }
                });
            }
            
			jQuery(document).ready(function($){
				
				// remove the "Save Draft" and "Preview" buttons.
				jQuery('#minor-publishing-actions').hide();
				jQuery('#misc-publishing-actions').hide();
				jQuery('#publishing-action input[name=publish]').val('<?php echo esc_js(__( "Save", 'wpv-views')); ?>');
				if (jQuery('#views_template_html_extra').hasClass("closed")) {
				    jQuery('#views_template_html_extra').removeClass("closed");
				}
				// add the CodeMirror textareas and metabox behaviour
                                
				var CSSEditor = CodeMirror.fromTextArea(document.getElementById("_wpv_view_template_extra_css"), {mode: "css", tabMode: "indent", lineWrapping: true, lineNumbers: true});
				var JSEditor = CodeMirror.fromTextArea(document.getElementById("_wpv_view_template_extra_js"), {mode: "javascript", tabMode: "indent", lineWrapping: true, lineNumbers: true});
				jQuery('.CodeMirror').css({'background-color': '#fff', 'border': '1px solid #999999'});
				
				jQuery('.wpv_template_meta_html_extra_css_edit').css({'height': '0', 'padding': '0'});
				jQuery('.wpv_template_meta_html_extra_js_edit').css({'height': '0', 'padding': '0'});
				if ('' != jQuery('#_wpv_view_template_extra_css').val()) {
					if ('on' == jQuery('#wpv_template_meta_html_extra_css_state').val()) {
						jQuery('.wpv_template_meta_html_extra_css_edit').css({'height': 'auto', 'padding': '0 10px'});
						jQuery('#wpv_template_meta_html_extra_css').css('display', 'none');
					}
				} else {
					jQuery('#wpv_template_meta_html_extra_css_state').val('off');
				}
				if ('' != jQuery('#_wpv_view_template_extra_js').val()) {
					if ('on' == jQuery('#wpv_template_meta_html_extra_js_state').val()) {
						jQuery('.wpv_template_meta_html_extra_js_edit').css({'height': 'auto', 'padding': '0 10px'});
						jQuery('#wpv_template_meta_html_extra_js').css('display', 'none');
					}
				} else {
					jQuery('#wpv_template_meta_html_extra_js_state').val('off');
				}
				
				jQuery('.template_meta_html_extra_edit > input').click( function() {
					var id = this.id;
					jQuery(this).css('display', 'none');
					jQuery('#'+ id + '_state').val('on');
					jQuery('.'+ id + '_edit').css({'height': 'auto', 'padding': '0 10px'});
				});
				jQuery('.template_meta_html_extra_edit p a').click(function() {
					var where = this.className;
					jQuery('#' + where).css('display', 'inline');
					jQuery('.' + where + '_edit').css({'height': '0', 'padding': '0'});
					jQuery('#' + where + '_state').val('off');
				});
                                
                                setTimeout(CodeMirror_fix_toolbar, 500);
                                
               
               
               
			});
        </script>

        <?php
        
        global $post;
        
        add_meta_box('views_template_help', __('View Template Help', 'wpv-views'), array($this,'view_settings_help'), $post->post_type, 'side', 'high');
        add_meta_box('views_template', __('View Template Settings', 'wpv-views'), array($this,'view_settings_meta_box'), $post->post_type, 'side', 'high');
                add_meta_box('views_template_html_extra', __('View Template CSS and JS', 'wpv-views'), array($this,'view_settings_meta_html_extra'), $post->post_type, 'normal', 'high');

    }
    
    function view_settings_meta_html_extra(){
	/**
	 * Add admin metabox for custom CSS and javascript
	 */
	global $post;
        $template_extra_css = '';
        $template_extra_css = get_post_meta($post->ID, '_wpv_view_template_extra_css', true);
        $template_extra_js = '';
        $template_extra_js = get_post_meta($post->ID, '_wpv_view_template_extra_js', true);
        $template_extra_state = array();
        $template_extra_state = get_post_meta($post->ID, '_wpv_view_template_extra_state', true);
	?>
	<p><?php _e('Here you can modify specific CSS and javascript to be used with this View Template.', 'wpv-views'); ?>
	</p>
	<div class="template_meta_html_extra_edit">
		<input type="button" class="button-secondary" id="wpv_template_meta_html_extra_css" value="<?php _e('Edit CSS', 'wpv-views'); ?>" />
		<input type="hidden" name="_wpv_view_template_extra_state[css]" id="wpv_template_meta_html_extra_css_state" value="<?php echo isset($template_extra_state['css']) ? $template_extra_state['css'] : 'off'; ?>" />
		<div class="wpv_template_meta_html_extra_css_edit" style="margin-bottom:15px;overflow:hidden;background:<?php echo WPV_EDIT_BACKGROUND;?>;">
			<p><strong>CSS</strong> - This is used to add custom CSS to a View Template.</p>
			<textarea name="_wpv_view_template_extra_css" id="_wpv_view_template_extra_css" cols="97" rows="10"><?php echo $template_extra_css; ?></textarea>
			<p class="template_meta_html_extra_close"><a style="cursor:pointer;" class="wpv_template_meta_html_extra_css"><strong><?php _e('Close CSS editor', 'wpv-views'); ?></strong></a></p>
		</div>
		<input type="button" class="button-secondary" id="wpv_template_meta_html_extra_js" value="<?php _e('Edit JS', 'wpv-views'); ?>" />
		<input type="hidden" name="_wpv_view_template_extra_state[js]" id="wpv_template_meta_html_extra_js_state" value="<?php echo isset($template_extra_state['js']) ? $template_extra_state['js'] : 'off'; ?>" />
		<div class="wpv_template_meta_html_extra_js_edit" style="overflow:hidden;background:<?php echo WPV_EDIT_BACKGROUND;?>;">
			<p><strong>JS</strong> - This is used to add custom javascript to a View Template.</p>
			<textarea name="_wpv_view_template_extra_js" id="_wpv_view_template_extra_js" cols="97" rows="10"><?php echo $template_extra_js; ?></textarea>
			<p class="template_meta_html_extra_close"><a style="cursor:pointer;" class="wpv_template_meta_html_extra_js"><strong><?php _e('Close JS editor', 'wpv-views'); ?></strong></a></p>
		</div>
	</div>
    <?php }
    
    function view_settings_meta_box() {

        global $post;
        
        $output_mode = get_post_meta($post->ID, '_wpv_view_template_mode', true);
        if (!$output_mode) {
            $output_mode = 'WP_mode';
        }

        ?>
        
        <ul>
            
            <?php $checked = $output_mode == 'WP_mode' ? ' checked="checked"' : ''; ?>
            <li><label><input type="radio" name="_wpv_view_template_mode[]" value="WP_mode" <?php echo $checked; ?> />&nbsp;<?php _e('Normal WordPress output - add paragraphs an breaks and resolve shortcodes', 'wpv-views'); ?></label></li>
            <?php $checked = $output_mode == 'raw_mode' ? ' checked="checked"' : ''; ?>
            <li><label><input type="radio" name="_wpv_view_template_mode[]" value="raw_mode" <?php echo $checked; ?> />&nbsp;<?php _e('Raw output - only resolve shortcodes without adding line breaks or paragraphs'); ?></label></li>
        </ul>
        
        <?php
        
    }

    function view_settings_help() {
		?>
		<p><a class="wpv-help-link" target=_"blank" href="http://wp-types.com/documentation/user-guides/view-templates/"><?php _e('What is a View Template', 'wpv-views')?> &raquo;</a></p>
		<p><a class="wpv-help-link" target=_"blank" href="http://wp-types.com/documentation/user-guides/editing-view-templates/"><?php _e('Editing instructions', 'wpv-views')?>  &raquo;</a></p>
		<p><a class="wpv-help-link" target=_"blank" href="http://wp-types.com/documentation/user-guides/setting-view-templates-for-single-pages/"><?php _e('How to apply View Templates to content', 'wpv-views')?>  &raquo;</a></p>
		
		<?php
		printf(__('Go to the %sSettings page%s to apply this template to content types.'), '<a href="' . admin_url('edit.php?post_type=view&page=views-settings') . '">', '</a>');
	}
    
	/**
	 * Add admin css to the view template edit page
	 *
	 */
	
    function include_admin_css() {
		global $pagenow;
		
		$found = false;
		
        if (($pagenow == 'edit.php' || $pagenow == 'post-new.php') && isset($_GET['post_type']) && $_GET['post_type'] == 'view-template') {
			$found = true;
		}
		if ($pagenow == 'post.php') {
			global $post;
            if ($post->post_type == 'view-template') {
				$found = true;
			}
			
		}
		
        if ($found) {
			$link_tag = '<link rel="stylesheet" href="'. WPV_URL . '/res/css/wpv-views.css?v='.WPV_VERSION.'" type="text/css" media="all" />';
            echo $link_tag;
        }
    }

    function save_post_actions($pidd, $post) {

        if ($post->post_type == 'view-template') {
            if (isset($_POST['_wpv_view_template_mode'][0])) {
                update_post_meta($pidd, '_wpv_view_template_mode', $_POST['_wpv_view_template_mode'][0]);

	            wpv_view_template_update_field_values($pidd);
            }
            if (isset($_POST['_wpv_view_template_extra_css'])) {
		update_post_meta($pidd, '_wpv_view_template_extra_css', $_POST['_wpv_view_template_extra_css']);
            }
            if (isset($_POST['_wpv_view_template_extra_js'])) {
		update_post_meta($pidd, '_wpv_view_template_extra_js', $_POST['_wpv_view_template_extra_js']);
            }
            $template_meta_html_state = array();
            if (isset($_POST['_wpv_view_template_extra_state']['css'])) {
                $template_meta_html_state['css'] = $_POST['_wpv_view_template_extra_state']['css'];
            }
            if (isset($_POST['_wpv_view_template_extra_state']['js'])) {
                $template_meta_html_state['js'] = $_POST['_wpv_view_template_extra_state']['js'];
            }
            if ( !empty( $template_meta_html_state ) ) {
		update_post_meta($pidd, '_wpv_view_template_extra_state', $template_meta_html_state);
            }
            
        }
        
        // pass to the base class.
        parent::save_post_actions($pidd, $post);
    }
    
	/**
	 * If the post has a view template
	 * add an view template edit link to post.
	 */
	
	function edit_post_link($link, $post_id) {
		
		$template_selected = get_post_meta($post_id, '_views_template', true);
	
		if ( !current_user_can( 'manage_options' ) )
			return $link;
        
        if ($template_selected) {
			remove_filter('edit_post_link', array($this, 'edit_post_link'), 10, 2);
			
			ob_start();
			
			edit_post_link(__('Edit view template', 'wpv-views').' "'.get_the_title($template_selected).'" ', '', '', $template_selected);
			
			$link = $link . ' ' . ob_get_clean();
			
			add_filter('edit_post_link', array($this, 'edit_post_link'), 10, 2);
		}
		
		return $link;
	}

	/**
	 * Ajax function to set the current view template to posts of a type
	 * set in $_POST['type']
	 *
	 */
	
    function ajax_action_callback() {
        global $wpdb;
    
        if ( empty($_POST) || !wp_verify_nonce('set_view_template', $_POST['wpnonce']) ) {

            $view_template_id = $_POST['view_template_id'];
            $type = $_POST['type'];
 
			list($join, $cond) = $this->_get_wpml_sql($type, $_POST['lang']);

            $posts = $wpdb->get_col("SELECT {$wpdb->posts}.ID FROM {$wpdb->posts} {$join} WHERE post_type='{$type}' {$cond}");
                    
            $count = sizeof($posts);
            $updated_count = 0;
            if ($count > 0) {
                foreach($posts as $post) {
                    $template_selected = get_post_meta($post, '_views_template', true);
                    if ($template_selected != $view_template_id) {
                        update_post_meta($post, '_views_template', $view_template_id);
                        $updated_count += 1;
                    }
                }
            }
            
            echo $updated_count;
        }        
        die(); // this is required to return a proper result
    }

    function clear_legacy_view_settings() {
        global $wpdb;

        $wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE meta_key='_views_template_new_type'");
    }
    
    function legacy_view_settings($options) {
        global $wpdb;
        
        $view_tempates_new = $wpdb->get_results("SELECT post_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key='_views_template_new_type'");
        
        foreach($view_tempates_new as $template_for_new) {
            $value = unserialize($template_for_new->meta_value);
            if ($value) {
                foreach($value as $type => $status) {
                    if ($status) {
                        $options['views_template_for_' . $type] = $template_for_new->post_id;
                    }
                }
            }
        }
        
                
        return $options;    
    }
    
    function admin_settings($options) {
        global $wpdb, $WP_Views;
        
        $items_found = array();
        
        $options = $this->legacy_view_settings($options);
		
		if (!isset($options['wpv-theme-function'])) {
			$options['wpv-theme-function'] = '';
		}
		if (!isset($options['wpv-theme-function-debug'])) {
			$options['wpv-theme-function-debug'] = false;
		}

		$WP_Views->admin_section_start(__('View Template for Post Types', 'wpv-views'),
										'http://wp-types.com/documentation/user-guides/using-view-templates-for-archive-and-taxonomy-pages',
										__('Using View Templates for Archive and Taxonomy Pages', 'wpv-views'));

        $this->_display_post_type_loop_summary($options);
        $this->_display_post_type_loop_admin($options);

		$WP_Views->admin_section_end();
		
		$WP_Views->admin_section_start(__('View Template settings for Taxonomy archive loops', 'wpv-views'));
        
        $this->_display_taxonomy_loop_summary($options);
        $this->_display_taxonomy_loop_admin($options);

		$WP_Views->admin_section_end();

		$WP_Views->admin_section_start(__('Theme support for View Templates', 'wpv-views'))
		
		?>
									   
        <div id="wpv_theme_debug" style="margin-left:20px;">
			<p>
				<?php _e("View Templates modify the content when called from 'the_content' function. Some themes don't use 'the_content' function but define their own function.", 'wpv-views');?>
			</p>
			<p>
				<?php _e("If View Templates don't work with your theme then you can enter the name of the function your theme uses here:", 'wpv-views');?>
				<input type="text" name="wpv-theme-function" value="<?php echo $options['wpv-theme-function'];?>" />
			</p>
			<p>
				<?php _e("Don't know the name of your theme function?", 'wpv-views');?>
				<br />
				<?php $checked = $options['wpv-theme-function-debug'] ? ' checked="checked"' : '';?>

				<label><input type="checkbox" name="wpv-theme-function-debug" value="1" <?php echo $checked;?> /> <?php _e("Enable debugging and go to a page that should display a View Template and Views will display the call function name.", 'wpv-views');?></label>
			</p>
			
			<?php wp_nonce_field('wpv_view_templates', 'wpv_view_templates'); ?>
			<input id="submit" type="button" class="button-primary" value="<?php _e('Save', 'wpv-views'); ?>" onclick="wpv_save_theme_debug_settings();" />
			<img id="wpv_theme_debug_spinner" src="<?php echo WPV_URL; ?>/res/img/ajax-loader.gif" width="16" height="16" style="display:none" alt="saving" />
			<span id="wpv_theme_debug_message" style="display:none;"><?php _e('Settings saved', 'wpv-views'); ?></span>
			

		</div>
			
		<?php
		$WP_Views->admin_section_end();
	}

    function _ajax_get_post_type_loop_summary() {
        global $WP_Views;
        
		if (wp_verify_nonce($_POST['wpv_post_type_view_template_loop_nonce'], 'wpv_post_type_view_template_loop_nonce')) {
			$options = $WP_Views->get_options();
			$options = $this->submit($options);
			
			$WP_Views->save_options($options);
			
			$this->_display_post_type_loop_summary($options);
		}
        die();
        
    }
    
    function _ajax_get_post_type_loop_edit() {
        global $WP_Views;
        
		if (wp_verify_nonce($_POST['wpv_post_type_view_template_loop_nonce'], 'wpv_post_type_view_template_loop_nonce')) {
			$options = $WP_Views->get_options();
			
			$new_options = $this->submit($options);
			
			$WP_Views->save_options($new_options);

			// determined what has changed so we can highlight anything that
			// might need updating.
	        $post_types = get_post_types(array('public'=>true), 'objects');
			$changed_types = array();
			foreach($post_types as $post_type) {
				$type = $post_type->name;
				if (!isset($options['views_template_for_' . $type ])) {
					$options['views_template_for_' . $type ] = 0;
				}
				if (!isset($new_options['views_template_for_' . $type ])) {
					$new_options['views_template_for_' . $type ] = 0;
				}
				
				if ($options['views_template_for_' . $type ] != $new_options['views_template_for_' . $type ]) {
					$changed_types[] = $type;
				}
			}
			
			$this->_display_post_type_loop_admin($new_options, $changed_types);
		}
        die();
        
    }
    
	function _display_post_type_loop_summary($options) {

        $post_types = get_post_types(array('public'=>true), 'objects');
		$view_templates = $this->get_view_template_titles();

		?>
        <div id="wpv-view-template-post-type-summary" style="margin-left:20px">
			
			<strong><?php _e('For single:', 'wpv-views'); ?></strong>
			<br />
			<?php
				$selected = '';
				foreach($post_types as $post_type) {
					$type = $post_type->name;
					if (!isset($options['views_template_for_' . $type ])) {
						$options['views_template_for_' . $type ] = 0;
					}
					if ($options['views_template_for_' . $type ] > 0) {
						$selected .= '<li type=square style="margin:0;">' . sprintf(__('%s using "%s"', 'wpv-views'), $post_type->labels->name, $view_templates[$options['views_template_for_' . $type ]]) . '</li>';

					}
					
				}
				if ($selected == '') {
					$selected = __('There are no View Templates being used for single post types.', 'wpv-views');
				} else {
					$selected = '<ul style="margin-left:20px">' . $selected . '</ul>';
				}
				
				echo '<div style="margin-left:20px;">' . $selected . '</div>';
				
			?>
			
			<strong><?php _e('For archive loop:', 'wpv-views'); ?></strong>
			<br />
			<?php
				$selected = '';
				foreach($post_types as $post_type) {
					$type = $post_type->name;
					if (!isset($options['views_template_archive_for_' . $type ])) {
						$options['views_template_archive_for_' . $type ] = 0;
					}
					if ($options['views_template_archive_for_' . $type ] > 0) {
						$selected .= '<li type=square style="margin:0;">' . sprintf(__('%s using "%s"', 'wpv-views'), $post_type->labels->name, $view_templates[$options['views_template_archive_for_' . $type ]]) . '</li>';

					}
					
				}
				if ($selected == '') {
					$selected = __('There are no View Templates being used for post types in taxonomy archive loops.', 'wpv-views');
				} else {
					$selected = '<ul style="margin-left:20px">' . $selected . '</ul>';
				}
				
				echo '<div style="margin-left:20px;">' . $selected . '</div>';
				
			?>
			
        <input class="button-secondary" type="button" value="<?php echo __('Edit', 'wpv-views'); ?>" name="view_template_post_type_loop_edit" onclick="wpv_view_template_post_type_loop_edit();"/>
		</div>
		
		<?php
	}
	
	function _display_post_type_loop_admin($options, $changed_types = array()) {
		global $wpdb;
        
		$items_found = array();
		
        $post_types = get_post_types(array('public'=>true), 'objects');
		
		?>
		
        <div id="wpv-view-template-post-type-edit" style="margin-left:20px;display:none;">
			
			<?php wp_nonce_field('wpv_post_type_view_template_loop_nonce', 'wpv_post_type_view_template_loop_nonce'); ?>
			
            <table class="widefat" style="width:auto;">
                <thead>
                    <tr>
                        <th><?php _e('Post Types'); ?></th>
                        <th><?php _e('Use this View Template (Single)', 'wpv-views'); ?></th>
                        <th><?php _e('Usage', 'wpv-views'); ?></th>
                        <th><?php _e('Use this View Template (Archive loop)', 'wpv-views'); ?></th>
                    </tr>
                </thead>
                        
                <tbody>
                    <?php
                        foreach($post_types as $post_type) {
                            $type = $post_type->name;
                            ?>
                            <tr>
                                <td><?php echo $type; ?></td>
                                <td>
                                    <?php
                                        if (!isset($options['views_template_for_' . $type ])) {
                                            $options['views_template_for_' . $type ] = 0;
                                        }
                                        $template = $this->get_view_template_select_box('', $options['views_template_for_' . $type ]);
                                        $template = str_replace('name="views_template" id="views_template"', 'name="views_template_for_' . $type . '" id="views_template_for_' . $type . '"', $template);
                                        echo $template;
                                        // add a preview button
                                        // preview the latest post of this type.
                            			list($join, $cond) = $this->_get_wpml_sql($type);
                                        $post_id = $wpdb->get_var("SELECT MAX({$wpdb->posts}.ID) FROM {$wpdb->posts} {$join} WHERE post_type='{$type}' AND post_status in ('publish') {$cond}");
                                        if ($post_id) {
                                            $link = get_permalink($post_id);
                                            ?>
                                            <a id="views_template_for_preview_<?php echo $type?>" class="button" target="_blank" href="<?php echo $link; ?>" ><?php _e('Preview', 'wpv-views'); ?></a>
                                            <?php
                                        }
                                        ?>
                                    
                                </td>
                                <td>
                                    <?php
								
									list($join, $cond) = $this->_get_wpml_sql($type);
									$posts = $wpdb->get_col("SELECT {$wpdb->posts}.ID FROM {$wpdb->posts} {$join} WHERE post_type='{$type}' {$cond}");
									
									$count = sizeof($posts);
									if ($count > 0) {
										$posts = "'" . implode("','", $posts) . "'";
										
				
										$set_count = $wpdb->get_var("SELECT COUNT(post_id) FROM {$wpdb->postmeta} WHERE meta_key='_views_template' AND meta_value='{$options['views_template_for_' . $type ]}' AND post_id IN ({$posts})");
										if ($set_count != $count && ($set_count == 0 || $options['views_template_for_' . $type ] == 0)) {
											echo '<div id="wpv_diff_template_' . $type . '">';
											echo '<p id="wpv_diff_' . $type . '">';
											echo sprintf(__('%d %ss use a different template:', 'wpv-views'), abs($count - $set_count), $type);
											if (in_array($type, $changed_types)) {
												echo ' <input type="button" id="wpv_update_now_' . $type . '" class="button-primary wpv-update-now" value="' . esc_html(sprintf(__('Update all %ss now', 'wpv-views'), $type)) . '" />';
											} else {
												echo ' <input type="button" id="wpv_update_now_' . $type . '" class="button-secondary wpv-update-now" value="' . esc_html(sprintf(__('Update all %ss now', 'wpv-views'), $type)) . '" />';
											}
											echo '<img id="wpv_update_loading_' . $type . '" src="' . WPV_URL . '/res/img/ajax-loader.gif" width="16" height="16" style="display:none" alt="loading" />';
											echo '</p>';
											echo '<p id="wpv_updated_' . $type . '" style="display:none">';
											echo sprintf(__('<span id="%s">%d</span> %ss have updated to use this template.', 'wpv-views'), 'wpv_updated_count_' . $type, $count - $set_count, $type);
											echo '</p>';
											echo '</div>';
											$items_found[] = $type;
										} else {
											echo '<p>' . sprintf(__('All %s are using this template', 'wpv-views'), $post_type->labels->name) . '</p>';
										}
									} else {
										echo '<p>' . sprintf(__('There are no %s', 'wpv-views'), $post_type->labels->name) . '</p>';
									}
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if (!isset($options['views_template_archive_for_' . $type ])) {
                                            $options['views_template_archive_for_' . $type ] = 0;
                                        }
                                        $template = $this->get_view_template_select_box('', $options['views_template_archive_for_' . $type ]);
                                        $template = str_replace('name="views_template" id="views_template"', 'name="views_template_archive_for_' . $type . '" id="views_template_archive_for_' . $type . '"', $template);
                                        echo $template;
                                        ?>
                                    
                                </td>
                            </tr>
                            <?php

                        }
                    ?>
                </tbody>
            </table>
                       
        <input class="button-primary" type="button" value="<?php echo __('Save', 'wpv-views'); ?>" name="view_template_post_type_loop_save" onclick="wpv_view_template_post_type_loop_save();"/>
        <img id="wpv_save_view_template_post_type_loop_spinner" src="<?php echo WPV_URL; ?>/res/img/ajax-loader.gif" width="16" height="16" style="display:none" alt="loading" />

        <input class="button-secondary" type="button" value="<?php echo __('Cancel', 'wpv-views'); ?>" name="view_template_post_types_loop_cancel" onclick="wpv_view_template_post_type_loop_cancel();"/>

        </div>

        <?php
        
            if (sizeof($items_found) > 0) {
                
                wp_nonce_field( 'set_view_template', 'set_view_template');
                
                // we need to add some javascript
                
                ?>
                <script type="text/javascript" >
                <?php
				
				$lang = '';
				global $sitepress;
				if (isset($sitepress)) {
					$lang = $sitepress->get_current_language();
				}
				
                foreach($items_found as $type) {
                    ?>
                    
                        jQuery('#wpv_update_now_<?php echo $type; ?>').click(function() {
                            jQuery('#wpv_update_loading_<?php echo $type; ?>').show();
                            var data = {
                                action : 'set_view_template',
                                view_template_id : '<?php echo $options['views_template_for_' . $type ]; ?>',
                                wpnonce : jQuery('#set_view_template').attr('value'),
                                type : '<?php echo $type; ?>',
								lang : '<?php echo $lang; ?>'
                            };
                            
                            jQuery.post(ajaxurl, data, function(response) {
                                jQuery('#wpv_updated_count_<?php echo $type; ?>').html(response);
                                jQuery('#wpv_updated_<?php echo $type; ?>').fadeIn();
                                jQuery('#wpv_diff_<?php echo $type; ?>').hide();
                            });
                        })
                        
                    <?php
                }
                
                ?>
                </script>
                <?php
            }
        
    }

    function _ajax_get_taxonomy_loop_summary() {
        global $WP_Views;
        
		if (wp_verify_nonce($_POST['wpv_taxonomy_view_template_loop_nonce'], 'wpv_taxonomy_view_template_loop_nonce')) {
			$options = $WP_Views->get_options();
			$options = $this->submit($options);
			
			$WP_Views->save_options($options);
			
			$this->_display_taxonomy_loop_summary($options);
		}
        die();
    }
    
	function _display_taxonomy_loop_summary($options) {
		$view_templates = $this->get_view_template_titles();
		
		$selected = '';
        $taxonomies = get_taxonomies('', 'objects');
        foreach ($taxonomies as $category_slug => $category) {
            if ($category_slug == 'nav_menu' || $category_slug == 'link_category'
                    || $category_slug == 'post_format') {
                continue;
            }
            $name = $category->name;
            if (isset ($options['views_template_loop_' . $name ]) && $options['views_template_loop_' . $name ] > 0) {
                $selected .= '<li type=square style="margin:0;">' . sprintf(__('%s using "%s"', 'wpv-views'), $category->labels->name, $view_templates[$options['views_template_loop_' . $name ]]) . '</li>';
            }
        }

        if ($selected == '') {
            $selected = __('There are no View Templates being used for Taxonomy archive loops.', 'wpv-views') . '<br />';
        } else {
            $selected = '<ul style="margin-left:20px">' . $selected . '</ul>';
        }
        
		?>
		
        <div id="wpv-view-template-taxonomy-summary" style="margin-left:20px;">

		<?php echo $selected; ?>
		
        <input class="button-secondary" type="button" value="<?php echo __('Edit', 'wpv-views'); ?>" name="view_template_taxonomy_loop_edit" onclick="wpv_view_template_taxonomy_loop_edit();"/>
		</div>
		<?php
	}
	
	function _display_taxonomy_loop_admin($options) {
		global $wpdb;
		
		?>
		
        <div id="wpv-view-template-taxonomy-edit" style="margin-left:20px;display:none;">
			
			<?php wp_nonce_field('wpv_taxonomy_view_template_loop_nonce', 'wpv_taxonomy_view_template_loop_nonce'); ?>
			
            <table class="widefat" style="width:auto;">
                <thead>
                    <tr>
                        <th><?php _e('Loop'); ?></th>
                        <th><?php _e('Use this View Template', 'wpv-views'); ?></th>
                    </tr>
                </thead>
                        
                <tbody>
                    
                    <?php
                    
                        $taxonomies = get_taxonomies('', 'objects');
                        foreach ($taxonomies as $category_slug => $category) {
                            if ($category_slug == 'nav_menu' || $category_slug == 'link_category'
                                    || $category_slug == 'post_format') {
                                continue;
                            }
                            $name = $category->name;
                            ?>
                            <tr>
                                <td><?php echo $name; ?></td>
                                <td>
                                    <?php
                                        if (!isset($options['views_template_loop_' . $name ])) {
                                            $options['views_template_loop_' . $name ] = '0';
                                        }
                                        $template = $this->get_view_template_select_box('', $options['views_template_loop_' . $name ]);
                                        $template = str_replace('name="views_template" id="views_template"', 'name="views_template_loop_' . $name . '" id="views_template_loop_' . $name . '"', $template);
                                        echo $template;

                                        $most_popular_term = $wpdb->get_var("SELECT term_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = '{$name}' AND count = (SELECT MAX(count) FROM {$wpdb->term_taxonomy} WHERE taxonomy = '{$name}')");
                                        if ($most_popular_term) {
                                            $link = get_term_link(intval($most_popular_term), $name);
                                            ?>
                                            <a id="views_template_loop_preview_<?php echo $name?>" class="button" target="_blank" href="<?php echo $link; ?>" ><?php _e('Preview', 'wpv-views'); ?></a>
                                            <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                            
                    
                    ?>
                </tbody>
            </table>
        
        <input class="button-primary" type="button" value="<?php echo __('Save', 'wpv-views'); ?>" name="view_template_taxonomy_loop_save" onclick="wpv_view_template_taxonomy_loop_save();"/>
        <img id="wpv_save_view_template_taxonomy_loop_spinner" src="<?php echo WPV_URL; ?>/res/img/ajax-loader.gif" width="16" height="16" style="display:none" alt="loading" />

        <input class="button-secondary" type="button" value="<?php echo __('Cancel', 'wpv-views'); ?>" name="view_template_taxonomy_loop_cancel" onclick="wpv_view_template_taxonomy_loop_cancel();"/>

		</div>

		<?php		
	}
    function submit($options) {
        $this->clear_legacy_view_settings();
        
        foreach($_POST as $index => $value) {
            if (strpos($index, 'views_template_loop_') === 0) {
                $options[$index] = $value;
            }
            if (strpos($index, 'views_template_for_') === 0) {
                $options[$index] = $value;
            }
            if (strpos($index, 'views_template_archive_for_') === 0) {
                $options[$index] = $value;
            }
        }
        
		if (isset($_POST['wpv-theme-function'])) {
			$options['wpv-theme-function'] = $_POST['wpv-theme-function'];
			$options['wpv-theme-function-debug'] = isset($_POST['wpv-theme-function-debug']) && $_POST['wpv-theme-function-debug'];
		}
		
        return $options;
    }

    function hide_view_template_author() {
        global $pagenow, $post;
        if (($pagenow == 'post-new.php' && isset($_GET['post_type']) && $_GET['post_type'] == 'view-template') ||
                ($pagenow == 'post.php' && isset($_GET['action']) && $_GET['action'] == 'edit')) {

            $post_type = $post->post_type;

            if($pagenow == 'post.php' && $post_type != 'view-template') {
                return;
            }
            ?>            
                <script type="text/javascript">
                    jQuery('#authordiv').hide();
                </script>
            <?php
            
            
        }
        
    }
	
	function show_admin_messages() {
		global $pagenow, $post;
		
        if ($pagenow == 'post.php' && isset($_GET['action']) && $_GET['action'] == 'edit') {
			
            $post_type = $post->post_type;

            if($pagenow == 'post.php' && $post_type != 'view-template') {
                return;
            }
			
			$open_tags = substr_count($post->post_content, '[types');
			$close_tags = substr_count($post->post_content, '[/types');
			if ($close_tags < $open_tags) {
				echo '<div id="message" class="error">';
				echo sprintf(__('<strong>This template includes single-ended shortcodes</strong>. Please close all shortcodes to avoid processing errors. %sRead more%s', 'wpv-views'),
							 '<a href="http://wp-types.com/faq/why-do-types-shortcodes-have-to-be-closed/" target="_blank">',
							 ' &raquo;</a>');
				echo '</div>';
			}					
			
		}
	}
	
	function disable_rich_edit_for_views($state) {
		global $pagenow, $post;
		if ($state) {
			if ($pagenow == 'post.php' && isset($_GET['action']) && $_GET['action'] == 'edit') {
				
				$post_type = $post->post_type;
				if($post_type != 'view-template' && $post_type != 'view') {
					return $state;
				}
				$state = 0;
			}
			
			if ($pagenow == 'post-new.php' && isset($_GET['post_type']) && ($_GET['post_type'] == 'view-template' || $_GET['post_type'] == 'view')) {
				$state = 0;
			}
			
		}
		return $state;
	}
	
}

/**
 * Update custom fields array for view template on save
 * @param unknown_type $pidd post ID
 * @param unknown_type $post post reference
 */
function wpv_view_template_update_field_values($pidd, $post = null) {
	if($post == null) {
		$post = get_post($pidd);
	}
	$content = $post->post_content;
	$shortcode_expression = "/\\[(wpv-|types).*?\\]/i";

	// search for shortcodes
	$counts = preg_match_all($shortcode_expression, $content, $matches);
	
	// iterate 0-level shortcode elements
	if($counts > 0) {
		$_wpv_view_template_fields = serialize($matches[0]);
		update_post_meta($pidd, '_wpv_view_template_fields', $_wpv_view_template_fields);
	}
}


