<?php

defined('MOODLE_INTERNAL') || die();


mb2_add_shortcode('row', 'mb2_shortcode_row');


function mb2_shortcode_row ($atts, $content= null)
{
	extract(mb2_shortcode_atts( array(
		'rowheader' => 0,
		'rowheader_content' => '',
		'rowheader_textcolor' => '',
		'rowheader_bgcolor' => '#e5e5e5',
		'bgcolor' => '',
		'prbg' => 0,
		'scheme' => 'light',
		'bgimage' => '',
		'rowhidden' => 0,
		'rowlang' => '',
		'pt' =>0,
		'pb' => 0,
		'custom_class' => ''
	), $atts));

	$output = '';
	$headercls = '';
	$bg_image_style = $bgimage ? ' style="background-image:url(\'' . $bgimage . '\');"' : '';
	$cls = $custom_class ? ' ' . $custom_class : '';
	$cls .= ' pre-bg' . $prbg;
	$cls .= ' ' . $scheme;

	$lang_arr = explode(',', $rowlang);
	$trimmed_lang_arr = array_map('trim', $lang_arr);

	if ($rowlang && !in_array(current_language(), $trimmed_lang_arr))
	{
		return ;
	}

	if ($rowhidden && !is_siteadmin())
	{
		return ;
	}

	if ($rowhidden && is_siteadmin())
	{
		$cls .= ' hiddenel';
		$headercls .= ' hiddenel';
	}

	if ($rowheader)
	{
		$output .= '<div class="mb2-pb-fprow-header' . $headercls . '" style="background-color:' . $rowheader_bgcolor . ';">';
		$output .= '<div class="container-fluid">';
		$output .= '<div class="row">';
		$output .= '<div class="col-sm-12">';
		$output .= '<h3 style="color:' . $rowheader_textcolor . ';">' . mb2_do_shortcode(html_entity_decode($rowheader_content)) . '</h3>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '<span class="mb2-pb-row-header-arrow" style="border-color:' . $rowheader_bgcolor . ';"></span>';
		$output .= '</div>';
	}

	$row_style = ' style="';
	$row_style .= 'padding-top:' . $pt . 'px;';
	$row_style .= 'padding-bottom:' . $pb . 'px;';
	$row_style .= $bgcolor ? 'background-color:' . $bgcolor . ';' : '';
	$row_style .= '"';

	$output .= '<div class="mb2-pb-fprow' . $cls . '"' . $bg_image_style . '>';
	$output .= '<div class="section-inner mb2-pb-row-inner "' . $row_style . '>';
	$output .= '<div class="container-fluid">';
	$output .= '<div class="row">';
	$output .= mb2_do_shortcode($content);
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;

}
