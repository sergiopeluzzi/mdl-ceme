<?php

defined('MOODLE_INTERNAL') || die();


mb2_add_shortcode('accordion', 'mb2_shortcode_accordion');
mb2_add_shortcode('accordion_item', 'mb2_shortcode_accordion_item');


function mb2_shortcode_accordion($atts, $content= null){

	extract(mb2_shortcode_atts( array(
		'show_all' => 0,
		'custom_class' => '',
		'accordion_active' => 1,
		'margin' => '',
		'parent' => 1
		), $atts)
	);

	$output = '';


	if(isset($GLOBALS['accordion_count']))
	{
	  $GLOBALS['accordion_count']++;
	}
	else
	{
	  $GLOBALS['accordion_count'] = 0;
	}


	$GLOBALS['accordion_active'] = $accordion_active;
	$GLOBALS['parent'] = $parent;



	$cls = $custom_class ? ' ' . $custom_class : '';


	$style = $margin !='' ? ' style="margin:' . $margin . ';"' : '';


	$output .= '<div class="mb2-accordion accordion panel-group' . $cls . '"' . $style;

	if($parent){
		$output .= ' id="theme-accordion-' . $GLOBALS['accordion_count'] . '"';
	}

	$output .= '>' . mb2_do_shortcode($content) . '</div>';


	unset($GLOBALS['accordion_item_count']);

	return $output;

}





function mb2_shortcode_accordion_item($atts, $content= null){
	extract(mb2_shortcode_atts( array(
		'title' => '',
		'active' => 0,
		'icon' => ''
		), $atts)
	);


	// Get globals
	$accordion_count = isset($GLOBALS['accordion_count']) ? $GLOBALS['accordion_count'] : 0;


	// Get collapse id
	if (isset($GLOBALS['accordion_item_count']))
	{
		$GLOBALS['accordion_item_count']++;
	}
	else
	{
		$GLOBALS['accordion_item_count'] = 1;
	}

	$col_id = theme_mb2nl_string_url_safe($title) . '_' . $accordion_count . '_' . $GLOBALS['accordion_item_count'] . '_';


	$output = '';
	$show = '';
	$cls = 'collapsed';
	$is_icon = ' no-icon';


	// Check if is active
	if($GLOBALS['accordion_active'] == $GLOBALS['accordion_item_count'])
	{

		$show = ' in';
		$cls = '';

	}


	// Check if in title is an icon
	if($icon !=''){

		$is_icon = ' is-icon';
		$title = '<i class="' . $icon . '"></i> ' . $title;

	}


	$parent = isset($GLOBALS['parent']) ? $GLOBALS['parent'] : 1;


	$isparent = $parent ? ' data-parent="#theme-accordion-' . $accordion_count . '"' : '';


	$output .= '<div class="accorion-item panel panel-default">';


	$output .= '<div class="panel-heading' . $is_icon . '">';
	$output .= '<p class="panel-title">';
	$output .= '<a data-toggle="collapse" ' . $isparent . ' href="#' . $col_id . '2" class="' . $cls . '">';
	$output .= $title;
	$output .= '</a>';
	$output .= '</p>';
	$output .= '</div>';


	$output .= '<div id="' . $col_id . '2" class="panel-collapse collapse' . $show . '">';
	$output .= '<div class="panel-body">';
	$output .= mb2_do_shortcode($content);
	$output .= '</div>';
	$output .= '</div>';


	$output .= '</div>';


	return $output;
}
