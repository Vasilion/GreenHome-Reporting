<?php

/* woocommerce skip cart and redirect to checkout. */
function woocommerce_skip_cart() {
	$checkout_url = WC()->cart->get_checkout_url();
	return $checkout_url;
}
add_filter ('woocommerce_add_to_cart_redirect', 'woocommerce_skip_cart');

function modify_jquery() {
if (!is_admin()) {
	wp_deregister_script('jquery');
	wp_register_script('jquery', 'https://code.jquery.com/jquery-1.11.3.min.js');
	wp_enqueue_script('jquery');
}
}
add_action('init', 'modify_jquery');

add_filter ('add_to_cart_redirect', 'woo_redirect_to_checkout');

function woo_redirect_to_checkout() {
  global $woocommerce;
	$checkout_url = $woocommerce->cart->get_checkout_url();
	return $checkout_url;
}

add_theme_support('avia_template_builder_custom_css');


/* Add support for the EventBrite API */

add_theme_support( 'eventbrite' );



add_filter('avf_default_icons','avia_replace_standard_icon', 10, 1);

function avia_replace_standard_icon($icons)
{
$icons['mobile_menu']	 = array( 'font' =>'entypo-fontello', 'icon' => 'ue811');
return $icons;
}


function avia_post_nav($same_category = false, $taxonomy = 'category')
	{
		global $wp_version;
	        $settings = array();
	        $settings['same_category'] = $same_category;
	        $settings['excluded_terms'] = '';
			$settings['wpversion'] = $wp_version;
        
		//dont display if a fullscreen slider is available since they overlap 
		if((class_exists('avia_sc_layerslider') && !empty(avia_sc_layerslider::$slide_count)) || 
			class_exists('avia_sc_slider_full') && !empty(avia_sc_slider_full::$slide_count) ) $settings['is_fullwidth'] = true;

		$settings['type'] = get_post_type();
		$settings['taxonomy'] = ($settings['type'] == 'portfolio') ? 'portfolio_entries' : $taxonomy;

		if(!is_singular() || is_post_type_hierarchical($settings['type'])) $settings['is_hierarchical'] = true;
		if($settings['type'] === 'topic' || $settings['type'] === 'reply') $settings['is_bbpress'] = true;

	        $settings = apply_filters('avia_post_nav_settings', $settings);
	        if(!empty($settings['is_bbpress']) || !empty($settings['is_hierarchical']) || !empty($settings['is_fullwidth'])) return;
	
	        if(version_compare($settings['wpversion'], '3.8', '>=' ))
	        {
			$entries['next'] = get_previous_post($settings['same_category'], $settings['excluded_terms'], $settings['taxonomy']);
			$entries['prev'] = get_next_post($settings['same_category'], $settings['excluded_terms'], $settings['taxonomy']);
		}
		else
		{
			$entries['next'] = get_previous_post($settings['same_category']);
			$entries['prev'] = get_next_post($settings['same_category']);
	        }
	        
		$entries = apply_filters('avia_post_nav_entries', $entries, $settings);
        $output = "";


		foreach ($entries as $key => $entry)
		{
            if(empty($entry)) continue;
			$the_title 	= isset($entry->av_custom_title) ? $entry->av_custom_title : avia_backend_truncate(get_the_title($entry->ID),75," ");
			$link 		= isset($entry->av_custom_link)  ? $entry->av_custom_link  : get_permalink($entry->ID);
			$image 		= isset($entry->av_custom_image) ? $entry->av_custom_image : get_the_post_thumbnail($entry->ID, 'thumbnail');
			
            $tc1   = $tc2 = "";
            $class = $image ? "with-image" : "without-image";

            $output .= "<a class='avia-post-nav avia-post-{$key} {$class}' href='{$link}' >";
		    $output .= "    <span class='label iconfont' ".av_icon_string($key)."></span>";
		    $output .= "    <span class='entry-info-wrap'>";
		    $output .= "        <span class='entry-info'>";
		    $tc1     = "            <span class='entry-title'>{$the_title}</span>";
if($image)  $tc2     = "            <span class='entry-image'>{$image}</span>";
            $output .= $key == 'prev' ?  $tc1.$tc2 : $tc2.$tc1;
            $output .= "        </span>";
            $output .= "    </span>";
		    $output .= "</a>";
		}
		return $output;
	}


$avia_config['imgSize']['widget'] 			= array('width'=>36,  'height'=>36);						// small preview pics eg sidebar news
$avia_config['imgSize']['square'] 		 	= array('width'=>180, 'height'=>180);		                 	// small image for blogs
$avia_config['imgSize']['featured'] 		 	= array('width'=>1500, 'height'=>430 );						// images for fullsize pages and fullsize slider
$avia_config['imgSize']['featured_large'] 		= array('width'=>1500, 'height'=>630 );						// images for fullsize pages and fullsize slider
$avia_config['imgSize']['extra_large'] 		 	= array('width'=>1500, 'height'=>1500, 'crop' => false);		// images for fullscrren slider
$avia_config['imgSize']['portfolio'] 		 	= array('width'=>495, 'height'=>400);						// images for portfolio entries (2,3 column)
$avia_config['imgSize']['portfolio_small'] 		= array('width'=>260, 'height'=>185);						// images for portfolio 4 columns
$avia_config['imgSize']['gallery'] 		 	= array('width'=>845, 'height'=>684);						// images for portfolio entries (2,3 column)
$avia_config['imgSize']['magazine'] 		 	= array('width'=>710, 'height'=>375);						// images for magazines
$avia_config['imgSize']['masonry'] 		 	= array('width'=>705, 'height'=>705, 'crop' => false);			// images for fullscreen masonry
$avia_config['imgSize']['entry_with_sidebar'] 		= array('width'=>845, 'height'=>321, 'crop' => false);		            		// big images for blog and page entries
$avia_config['imgSize']['entry_without_sidebar']	= array('width'=>1210, 'height'=>423);						// images for fullsize pages and fullsize slider
$avia_config['imgSize'] 				= apply_filters('avf_modify_thumb_size', $avia_config['imgSize']);

//gravity forms insert placeholders in fields
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

//Custom QA Number Field
//Vortech Consultants function to register a plugin we use
add_action( 'register_form', 'myplugin_register_form' );
function myplugin_register_form() {

    $QANumber = ( ! empty( $_POST['QANumber'] ) ) ? trim( $_POST['QANumber'] ) : '';

    ?>
    <p>
        <label for="QANumber"><?php _e( 'QA Number', 'mydomain' ) ?><br />
            <input type="text" name="QANumber" id="QANumberID" class="input" value="<?php echo esc_attr( wp_unslash( $QANumber ) ); ?>" size="25" /></label>
    </p>
    <?php
}

//3. Finally, save our extra registration user meta.
add_action( 'user_register', 'myplugin_user_register' );
function myplugin_user_register( $user_id ) {
    if ( ! empty( $_POST['QANumber'] ) ) {
        update_user_meta( $user_id, 'QANumber', trim( $_POST['QANumber'] ) );
    }
}
