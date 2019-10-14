<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *
 * @package   theme_mb2nl
 * @copyright 2017 - 2019 Mariusz Boloz (www.mb2themes.com)
 * @license   Commercial https://themeforest.net/licenses
 *
 */

defined('MOODLE_INTERNAL') || die();


/*
 *
 * Method to get course banner
 *
 *
 */
function theme_mb2nl_course_banner ($page)
{

	global $CFG;

	$output = '';
	$cid = $page->course->id;
	$bannerStyle = theme_mb2nl_theme_setting($page, 'cbannerstyle');
	$bannerTitle = theme_mb2nl_theme_setting($page, 'cbannertitle');

	//<a href="' . $CFG->wwwroot . '/course/view.php?id=' . $cid . '" style="display:block;">

	if ($cid > 1 && $bannerStyle !='')
	{

		$course = theme_mb2nl_course();
		$bannerUrl = theme_mb2nl_course_banner_url();
		$bannerSelector = '<div class="cbanner-bg" style="background-image:url(\'' . $bannerUrl  . '\');"><a href="' . $CFG->wwwroot . '/course/view.php?id=' . $cid
		. '" style="display:block;"><div class="banner-bg-innder">';

		if (!$bannerUrl)
		{
			return;
		}


		$output .= '<div class="theme-cbanner cbanner-' . $bannerStyle . '">';
		$output .= $bannerStyle === 'fw' ? $bannerSelector : '';
		$output .= '<div class="container-fluid">';
		$output .= '<div class="row">';
		$output .= '<div class="col-sm-12">';
		$output .= $bannerStyle === 'fx' ? $bannerSelector : '';
		$output .= $bannerTitle ? '<h1>' . $course->fullname . '</h1>' : '';
		$output .= '</div>';
		$output .= $bannerStyle === 'fx' ? '</a>' : '';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= $bannerStyle === 'fw' ? '</a>' : '';
		$output .= '</div>';
		$output .= '</div>';


	}

	return $output;

}







/*
 *
 * Method to get course banner url
 *
 *
 */
function theme_mb2nl_course_banner_url ()
{

	global $CFG,$PAGE,$OUTPUT;

	$output = '';
	$moodle33 = 2017051500;
	$course = theme_mb2nl_course();
	$plcImg = theme_mb2nl_theme_setting($PAGE,'courseplimg');


	if ($CFG->version >= $moodle33)
	{
		$isPlcImg = file_exists($OUTPUT->image_url('course-custom','theme')) ? $OUTPUT->image_url('course-custom','theme') : $OUTPUT->image_url('course-default','theme');
	}
	else
	{
		$isPlcImg = file_exists($OUTPUT->pix_url('course-custom','theme')) ? $OUTPUT->pix_url('course-custom','theme') : $OUTPUT->pix_url('course-default','theme');
	}


	if ($plcImg)
	{
		$output = 0;
	}


	foreach ($course->get_course_overviewfiles() as $file)
	{

		if ($file->is_valid_image())
		{
			$output = file_encode_url($CFG->wwwroot .
			'/pluginfile.php','/' . $file->get_contextid() . '/' . $file->get_component() . '/' .	$file->get_filearea() . $file->get_filepath() . $file->get_filename());
		}

	}

	return $output;

}
