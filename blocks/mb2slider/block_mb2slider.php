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
 * @package		Mb2 Slider
 * @author		Mariusz Boloz (http://mb2extensions.com)
 * @copyright	Copyright (C) 2017 Mariusz Boloz (http://mb2extensions.com). All rights reserved
 * @license		Commercial (http://codecanyon.net/licenses)
**/

defined('MOODLE_INTERNAL') || die;



include_once($CFG->dirroot . '/course/lib.php');

if ($CFG->version < 2018120300)
{
	include_once($CFG->libdir . '/coursecatlib.php');
}


class block_mb2slider extends block_base
{


	private $headerhidden = true;


	public function init()
	{
        $this->title = get_string('mb2slider', 'block_mb2slider');
    }



	public function instance_allow_multiple() {
        return true;
    }



	function applicable_formats() {
        return array('all' => true);
    }



	function has_config()
	{
		return false;
	}



	function specialization()
	{
        $this->title = isset($this->config->title) ? format_string($this->config->title) : format_string(get_string('mb2slider', 'block_mb2slider'));
    }


	function config_print() {

		if (!$this->has_config()) {
		return false;
	  }
	}

	public function get_content()
	{


		global $CFG, $PAGE, $USER, $DB, $OUTPUT;


		$output = '';
		$slidesCount = 12;
		$currentLang = current_language();
		$langField = $this->mb2slider_setting('langtag');
		$source = $this->mb2slider_setting('source', 'custom');
		$catid =  $this->mb2slider_setting('catid',0);
		$childrenCat = $this->mb2slider_setting('children',1);
		$langArr = explode(',', $langField);
		$showBlock = true;


		// Check language
		if ($langField !='')
		{
			if (!in_array($currentLang, $langArr))
			{
				$showBlock = false;
			}
		}

		$PAGE->requires->jquery();
	   	$PAGE->requires->js('/blocks/mb2slider/assets/lightslider/lightslider.custom.js');
		$PAGE->requires->js('/blocks/mb2slider/scripts/mb2slider.js');


		if ($this->content)
		{
		  return $this->content;
		}


		// Some params
		$slidesNum = $this->mb2slider_setting('slidesnum', 1);
		$isCarousel = ($slidesNum > 1);
		$welcomeText = get_string('welcometext', 'block_mb2slider');
		$navdir = $this->mb2slider_setting('navdir', 1);
		$x = 0;


		// Additional content
		$textTop = format_text($this->mb2slider_setting('texttop'),FORMAT_HTML);
		$textBottom = format_text($this->mb2slider_setting('texbottom'),FORMAT_HTML);
		$textLr = format_text($this->mb2slider_setting('textlr'),FORMAT_HTML);
		$textLrWidth = $this->mb2slider_setting('textlrw', 25);
		$textLrPos = $this->mb2slider_setting('textlrpos', 'left');


		// Slider clssses and styles
		$cls = $slidesNum > 1 ? ' multiple-items' : '';
		$cls .= $isCarousel ? ' carousel' : ' nocarousel';
		$cls .= $textLr !='' ? ' columns columns-' . $textLrPos : '';
		$cls .= ' navtype' . $navdir;
		$cls .= $this->mb2slider_setting('cls') !='' ? ' ' . $this->mb2slider_setting('cls') : '';
		$sliderStyle = ' style="';
		$sliderStyle .= $this->mb2slider_setting('margin') !='' ? 'margin:' . $this->mb2slider_setting('margin') . ';' : '';
		$sliderStyle .= '"';

		$listStyle = $textLr !='' ? ' style="width:' . round(100-$textLrWidth,10). '%;"' : '';


		$output .= '<div class="mb2slider mb2slider' . $this->context->id . $cls . '"' . $sliderStyle . '>';
		$output .= $textTop  !='' ? $this->mb2slider_custom_text($textTop, 'top') : '';
		$output .= $textLr  !='' ? $this->mb2slider_custom_text($textLr, 'lr', $textLrWidth ) : '';
		$output .= '<div class="mb2slider-inner"' . $listStyle . '>';
		$output .= '<ul class="mb2slider-slide-list"' . $this->mb2slider_data_attr($this->context->id) . '>';


		if ($source === 'courses')
		{
			// Get courses list
			if ($CFG->version >= 2018120300)
			{
				$coursesList = core_course_category::get($catid)->get_courses(array('recursive' => $childrenCat));
			}
			else
			{
				$coursesList = coursecat::get($catid)->get_courses(array('recursive' => $childrenCat));
			}

			$itemCount = count($coursesList);

			if ($itemCount > 0)
			{
				$welcomeText = '';

				foreach ($coursesList as $course)
				{
					$x++;
					$output .= $this->mb2slider_item(0, $isCarousel, $x, $itemCount, $course);
				}
			}

		}
		else
		{
			if ($this->mb2slider_slidesCount($slidesCount) > 0)
			{
				$welcomeText = '';
			}

			for ($i = 1; $i <= $slidesCount; $i++)
			{
				$output .= $this->mb2slider_item($i, $isCarousel, $i, $this->mb2slider_slidesCount($slidesCount));
			}

		}


		$output .= '</ul>';
		$output .= '</div>';
		$output .= $textBottom  !='' ? $this->mb2slider_custom_text($textBottom, 'bottom') : '';
		$output .= '</div>';


		$this->content =  new stdClass;
		$this->content->text = $showBlock ? $output . $welcomeText : NULL;
		$this->content->footer = '';


		return $this->content;

	}





	function mb2slider_custom_text($text, $pos, $width = 0)
	{

		$output = '';

		$isWidth = $width > 0 ? ' style="width:' . $width . '%;"' : '';
		$isClearfix = $pos !== 'lr' ? ' clearfix' : '';

		$output .= '<div class="mb2slider-add-text mb2slider-add-text-' . $pos . $isClearfix . '"' . $isWidth . '>';
		$output .= $text;
		$output .= '</div>';

		return $output;

	}




	function mb2slider_item($item, $carousel, $counter, $itemCount,  $course = NULL)
	{

		global $CFG;

		$output = '';
		$desc['text'] = '';

		$cationAnim = !$carousel ? $this->mb2slider_setting('captionanim', 1) : 'none';
      	if ($itemCount == 1 && !$course)
      	{
         	$cationAnim = 0;
      	}

		$sizeTitleArr = explode(',', $this->mb2slider_setting('titlesize', '42'));
		$sizecDescArr = explode(',', $this->mb2slider_setting('descsize', '18'));
		$sizeTitle = $sizeTitleArr[0];
		$sizecDesc = $sizecDescArr[0];
		$sizeTitleArrM = 'px';
		$sizecDescArrM = 'px';

		if (isset($sizeTitleArr[1]))
		{
			$sizeTitle = $sizeTitleArr[1];
			$sizeTitleArrM = 'em';
		}

		if (isset($sizecDescArr[1]))
		{
			$sizecDesc = $sizecDescArr[1];
			$sizecDescArrM = 'em';
		}


		$contentWidth = !$carousel ? $this->mb2slider_setting('contentw', 1140) : 1140;
		$navdir = $this->mb2slider_setting('navdir', 1);


		// Course elements
		$isContacts = $course ? ($course->has_course_contacts() > 0 && $this->mb2slider_setting('metacontacts',0)) : false;
		$isCategory = $course ? $this->mb2slider_setting('metacategory',0) : false;


		// Slide params
		$image = !$course ? $this->mb2slider_setting('imagenum' . $item) : '';
		$imageUrl = $course ?  $this->mb2slider_image_url(0, false, $course) : $this->mb2slider_image_url($image);
		$imageName = $course ? $this->mb2slider_image_url(0, true, $course) : $this->mb2slider_image_url($image, true);


		$colorObg = $course ? $this->mb2slider_setting('obgcolor') : $this->mb2slider_setting('obgcolor' . $item,'','obgcolor');


		$cHalign = !$carousel ? $course ? $this->mb2slider_setting('captionhalign', 'left') : $this->mb2slider_setting('captionhalign' . $item, 'left', 'captionhalign') : 'center';
		$cValign = !$carousel ? $course ? $this->mb2slider_setting('captionvalign', 'center') : $this->mb2slider_setting('captionvalign' . $item, 'center', 'captionvalign') : 'center';


		$title = $course ? $course->fullname : $this->mb2slider_setting('title' . $item);
		$desc = $course ? $this->mb2slider_wordlimit($course->summary, $this->mb2slider_setting('showdesc',7)) : $this->mb2slider_setting('desc' . $item);


		$link = $course ? new moodle_url('/course/view.php', array('id' => $course->id)) : $this->mb2slider_setting('link' . $item);
		$linkBtn = $course ? $this->mb2slider_setting('linkbtn', 0) : $this->mb2slider_setting('linkbtn' . $item, 0, 'linkbtn');
		if ($navdir == 2) {
			$linkBtn = 1;
		}
		$linkBtnText = $course ? $this->mb2slider_setting('linkbtntext') : $this->mb2slider_setting('linkbtntext' . $item,'','linkbtntext');
		$linkBtnCls = $course ? $this->mb2slider_setting('linkbtncls', 'btn btn-primary') : $this->mb2slider_setting('linkbtncls' . $item, 'btn btn-primary','linkbtncls');
		if ($navdir == 2) {
			$linkBtnCls = '';
		}
		$linkTarget = $course ? '' : $this->mb2slider_setting('linktarget' . $item);


		$captionWidth = !$carousel ? $course ? $this->mb2slider_setting('captionw', 550) : $this->mb2slider_setting('captionw' . $item, 550, 'captionw') : 1100;


		$captionBgColor = $course ? $this->mb2slider_setting('cbgcolor') : $this->mb2slider_setting('cbgcolor' . $item, '', 'cbgcolor');
		$captionStyleParam = $course ? $this->mb2slider_setting('captionstyle', 'custom') : $this->mb2slider_setting('captionstyle' . $item, 'custom', 'captionstyle');
		$captionPreStyle = !$carousel ? ' ' . $captionStyleParam : ' none';
		$captionShadow = $course ? $this->mb2slider_setting('cshadow', 0) : $this->mb2slider_setting('cshadow' . $item, 0, 'cshadow');
		$captionPreStyle .= (!$carousel && $captionShadow == 1) ? ' isshadow' : ' isnoshadow';
		$titleColor = !$carousel ? $course ? $this->mb2slider_setting('titlecolor') : $this->mb2slider_setting('titlecolor' . $item, '', 'titlecolor') : '';
		$descColor = !$carousel ? $course ? $this->mb2slider_setting('desccolor') : $this->mb2slider_setting('desccolor' . $item, '', 'desccolor') : '';
		$btnColor = $this->mb2slider_setting('btncolor' . $item, '', 'btncolor');

		$accentColor = $course ? $this->mb2slider_setting('accentcolor') : $this->mb2slider_setting('accentcolor' . $item);


		$buttonText = $linkBtnText !='' ? $linkBtnText : get_string('readmore', 'block_mb2slider');


		if ($imageUrl)
		{


			// Two rows
			$twoRow = ($carousel && $this->mb2slider_setting('drow') == 1);
			$startTwoRow = ($twoRow && ($counter == 1 || ($counter % 2 != 0)));
			$endTwoRow = ($twoRow && ($counter == $itemCount || ($counter % 2 == 0)));


			// List style
			$slideStyle2 = ' style="';
			$slideStyle2 .= 'background-image:url(\'' . $imageUrl . '\');';
			$slideStyle2 .= 'background-repeat:no-repeat;';
			$slideStyle2 .= 'background-position:50% 50%;';
			$slideStyle2 .= 'background-size:cover;';
			$slideStyle2 .= '"';


			// Caption style
			$captionBg = $captionBgColor !='' ? 'background-color:' . $captionBgColor . ';' : '';
			$captionStyle = ' style="';
			$captionStyle .= ($captionStyleParam === 'circle' && $navdir != 2) ? 'width:' . $captionWidth . 'px;' : 'max-width:' . $captionWidth . 'px;';
			$captionStyle .= ($captionStyleParam === 'circle' && $navdir != 2) ? 'height:' . $captionWidth . 'px;' : '';
			$captionStyle .= $captionBg;
			$captionStyle .= '"';


			// Slider inner style
			// Margin when two items are displayed in one column
			$slideInnerStyle = $twoRow ? ' style="margin-bottom:' . $this->mb2slider_setting('slidemargin', 0) . 'px;"' : '';


			// Title and description style
			$titleStyle = ' style="';
			$titleStyle .= $titleColor !='' ? 'color:' . $titleColor . ';' : '';
			$titleStyle .= 'font-size:' . $sizeTitle .  $sizeTitleArrM . ';';
			$titleStyle .= '"';

			$descStyle = ' style="';
			$descStyle .= $descColor !='' ? 'color:' . $descColor . ';' : '';
			//$descStyle .= 'font-size:' . $sizecDesc . $sizecDescArrM .  ';';
			$descStyle .= '"';


			// Button style
			$btnStyle = $btnColor !='' ? ' style="' : '';
			$btnStyle .= $btnColor !='' ? 'background-color:' . $btnColor . ';border-color:' . $btnColor . ';'  : '';
			$btnStyle .= $btnColor !='' ? '"' : '';


			// Define slide css class
			$slideCls = ($link !='' && ($linkBtn == 1 || $carousel)) ? ' slide-link-btn' : '';
			$slideCls .= ' slide_' . $this->context->id . '_' . $item;



			if ($twoRow)
			{
				if ($startTwoRow)
				{
					$output .= '<li class="mb2slider-slide-item' . $slideCls . '">';
				}
			}
			else
			{
				$output .= '<li class="mb2slider-slide-item' . $slideCls . '">';
			}



			$output .= ($link !='' && $linkBtn == 0) ? '<a href="' . $link . '" target="' . $linkTarget . '">' : '';
			$output .= '<div class="mb2slider-slide-item-inner"' . $slideInnerStyle . '>';
			$output .= $colorObg !='' ? '<div class="mb2slider-overlay-bg" style="background-color:' . $colorObg . ';"></div>' : '';
			$output .= '<div class="mb2slider-slide-media">';
			$output .= '<div class="mb2slider-bgimg"' . $slideStyle2 . '></div>';
			$output .= '<img class="mb2slider-slide-img" src="' . $imageUrl . '" alt="' . $imageName . '" style="z-index:0;max-width:100%;"/>';
			$output .= '</div>' ;


			// Slide description
			$is_link_btn = ($link && $linkBtn == 1);


			if ($course)
			{
				$showText = (format_text($desc, FORMAT_HTML) && $this->mb2slider_setting('showdesc',7) > 0);
				$isText = format_text($desc, FORMAT_HTML);
			}
			else
			{
				$isText = format_text($desc['text'], FORMAT_HTML);
				$showText = $isText;
			}

			$showDesc = ($showText || $is_link_btn);


			if ($title || $showDesc)
			{
				$output .= '<div class="mb2slider-caption hor-' . $cHalign . ' ver-' . $cValign . ' anim' . $cationAnim . '">';
				$output .= '<div class="mb2slider-caption1" style="width:' . $contentWidth . 'px;margin:0 auto;">';
				$output .= '<div class="mb2slider-caption2">';
				$output .= '<div class="mb2slider-caption3">';
				$output .= '<div class="mb2slider-caption-content' . $captionPreStyle . '"' . $captionStyle . '>';
				$output .= $title ? '<h4 class="mb2slider-title"' . $titleStyle . '>' . format_text($title, FORMAT_HTML) . '</h4>' : '';

				if ($showDesc)
				{

					$output .= '<div class="mb2slider-description"' . $descStyle . '>';

					// Course details
					if ($isContacts || $isCategory)
					{

						$output .= '<div class="mb2slider-course-details">';

						if ($isCategory)
						{

							if ($CFG->version >= 2018120300)
							{
								$cat = core_course_category::get($course->category, IGNORE_MISSING);
							}
							else
							{
								$cat = coursecat::get($course->category, IGNORE_MISSING);
							}

							if (isset($cat->visible) && $cat->visible)
							{
								$output .= '<span class="mb2slider-coursecat">';
								$output .= '<i class="fa fa-folder"></i>' . $cat->get_formatted_name();
								$output .= '</span>';
							}

						}


						if ($isContacts)
						{

							foreach ($course->get_course_contacts() as $userid => $coursecontact)
							{
								$output .= '<span class="">';
								$output .= '<i class="fa fa-user"></i>' . $coursecontact['username'];
								$output .= '</span>';
							}
						}

						$output .= '</div>';

					}

					$output .= $showText ? '<div class="mb2slider-text" style="font-size:' . $sizecDesc . $sizecDescArrM  . ';">' . $isText . '</div>' : '';

					$cnavcls = $link !='' ? ' islink' : ' nolink';

					$output .= $navdir == 2 ? '<div class="mb2slider-captionnav' . $cnavcls . '">' : '';
					$output .= $navdir == 2 ? '<span class="mb2slider-prevslide"><i class="mb2slider_icon-left-open"></i></span>' : '';
					$output .= $is_link_btn ? '<a href="' . $link . '" class="mb2slider-btn ' . $linkBtnCls . '" target="' . $linkTarget . '"' . $btnStyle . '>' . $buttonText . '</a>' : '';
					$output .= $navdir == 2 ? '<span class="mb2slider-nextslide"><i class="mb2slider_icon-right-open"></i></span>' : '';
					$output .= $navdir == 2 ? '</div>' : '';
					$output .= (!$carousel && $is_link_btn) ? '<a href="' . $link . '" class="mb2slider-btn-mobile" target="' . $linkTarget . '">&#43;</a>' : '';
					$output .= '</div>'; // end .mb2slider-description


				}


				// Caption 'border' style
				$captioBorderStyle = $accentColor != '' ? ' style="background-color:' . $accentColor . ';"' : '';
				$output .= $captionStyleParam === 'border' ? '<span class="mb2slider-border"' . $captioBorderStyle . '></span>' : '';


				$output .= '</div>'; // end .mb2slider-caption-content
				$output .= '</div>'; // end .mb2slider-caption3
				$output .= '</div>'; // end .mb2slider-caption2
				$output .= '</div>'; // end .mb2slider-caption1
				$output .= '</div>'; // end .mb2slider-caption
			}


			$output .= '</div>';
			$output .= ($link !='' && $linkBtn == 0) ? '</a>' : '';

			if ($twoRow)
			{
				if ($endTwoRow)
				{
					$output .= '</li>';
				}
			}
			else
			{
				$output .= '</li>';
			}

		}



		return $output;



	}




	function mb2slider_slidesCount ($slidesCount)
	{
		$i = '';
		$output = '';
		$x = 0;

      if ($this->mb2slider_setting('source','custom') !== 'custom')
      {
         return 0;
      }

		for ($i = 1; $i <= $slidesCount; $i++)
		{

			if ($this->mb2slider_setting('imagenum' . $i) > 0)
			{
				$x++;
				$output =+ $x;
			}

		}


		return $output;

	}



	function mb2slider_setting($name, $default = '', $global = '')
	{

		if (isset($this->config->$name))
		{
			$output = ($global !='' && $this->config->$name == '') ? $this->config->$global : $this->config->$name;
		}
		else
		{
			$output = $default;
		}


		return $output;

	}





	function mb2slider_data_attr($blobkId = 0)
	{

		$output = '';
      	$slidesCount = $this->mb2slider_setting('source', 'custom') === 'custom' ? $this->mb2slider_slidesCount(12) : 999;


		$output .= ' data-mode="' . $this->mb2slider_setting('animtype', 'slide') . '"';
		$output .= ' data-auto="' . $this->mb2slider_setting('animauto', 1) . '"';
		$output .= ' data-aspeed="' . $this->mb2slider_setting('animspeed', 800) . '"';
		$output .= ' data-apause="' . $this->mb2slider_setting('animpause', 7000) . '"';
		$output .= ' data-loop="' . $this->mb2slider_setting('animloop', 1) . '"';
		$output .= ' data-pager="' . $this->mb2slider_setting('navpager', 0) . '"';
		$output .= ' data-control="' . $this->mb2slider_setting('navdir', 1) . '"';
		$output .= ' data-items="' . $this->mb2slider_setting('slidesnum', 1) . '"';
		$output .= ' data-moveitems="' . $this->mb2slider_setting('slidesmovenum', 1) . '"';
		$output .= ' data-margin="' . $this->mb2slider_setting('slidemargin', 0) . '"';
		$output .= ' data-aheight="' . $this->mb2slider_setting('animheight', 1) . '"';
		$output .= ' data-kpress="' . $this->mb2slider_setting('navkey', 1) . '"';
		$output .= ' data-modid="' . $blobkId . '"';
      	$output .= ' data-slidescount="' . $slidesCount . '"';


		return $output;

	}







	function mb2slider_image_url($imagenum, $name = false, $course = NULL)
	{


		global $CFG;

		require_once($CFG->libdir . '/filelib.php');

		$output = '';
		$i = -1;
		$fs = get_file_storage();
		$files = $course ? $course->get_course_overviewfiles() : $fs->get_area_files($this->context->id, 'block_mb2slider', 'content');


		foreach ($files as $file)
		{

			$i++;

			$checkNum = $course ? true : ($imagenum > 0 && $imagenum == $i);

			if ($checkNum)
			{
				$output .= $name === true ? $file->get_filename() :
				moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(), null, $file->get_filepath(), $file->get_filename());
			}


		}


		return $output;


	}



	function mb2slider_wordlimit($string, $limit = 999, $end = '...')
	{

		$output = $string;

		if ($limit < 999)
		{
			$content_limit = strip_tags($string);
			$words = explode(' ', $content_limit);
			$new_string = implode(' ', array_splice($words, 0, $limit));
			$word_count = str_word_count($string);
			$end_char = ($end !='' && $word_count > $limit) ? $end : '';

			$output = $new_string . $end_char;
		}

		return $output;

	}







}
