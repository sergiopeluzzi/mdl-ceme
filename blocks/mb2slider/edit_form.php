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



class block_mb2slider_edit_form extends block_edit_form
{




	protected function specific_definition($mform)
	{


	   	global $CFG, $PAGE;


		$slidesCount = 12;


		// Required files for 'Spectrum' color picker plugin
		$PAGE->requires->jquery();
		$PAGE->requires->css('/blocks/mb2slider/assets/spectrum/spectrum.css');
	   	$PAGE->requires->js('/blocks/mb2slider/assets/spectrum/spectrum.js');
	   	$PAGE->requires->js('/blocks/mb2slider/scripts/admin.js');


		$yesNoArr = array('0'=>get_string('no', 'block_mb2slider'), '1'=>get_string('yes', 'block_mb2slider'));
		$yesNoGlobalArr = array(''=>get_string('global', 'block_mb2slider'), '0'=>get_string('no', 'block_mb2slider'), '1'=>get_string('yes', 'block_mb2slider'));
		$slideAnimArr = array('fade'=>get_string('fade', 'block_mb2slider'), 'slide'=>get_string('slide', 'block_mb2slider'));
		$captionAnimArr = array('0'=>get_string('none', 'block_mb2slider'), '1'=>get_string('fsttop', 'block_mb2slider'));


		$navDirArr = array(
			'1'=>get_string('yes', 'block_mb2slider'),
			'0'=>get_string('no', 'block_mb2slider'),
			'2'=>get_string('captionnav', 'block_mb2slider')
		);

		$captionStyleArr = array(
			'circle'=>get_string('circle', 'block_mb2slider'),
			'strip-light'=>get_string('striplight', 'block_mb2slider'),
			'strip-dark'=>get_string('stripdark', 'block_mb2slider'),
			'border'=>get_string('border', 'block_mb2slider'),
			'fromtheme'=>get_string('fromtheme', 'block_mb2slider'),
			'custom'=>get_string('custom', 'block_mb2slider')
		);


		$captionStyleGlobalArr = array(
			'' => get_string('global','block_mb2slider'),
			'circle'=>get_string('circle', 'block_mb2slider'),
			'strip-light'=>get_string('striplight', 'block_mb2slider'),
			'strip-dark'=>get_string('stripdark', 'block_mb2slider'),
			'border'=>get_string('border', 'block_mb2slider'),
			'fromtheme'=>get_string('fromtheme', 'block_mb2slider'),
			'custom'=>get_string('custom', 'block_mb2slider')
		);


		$linkTargetOpt = array(
			'' => get_string('targetselft','block_mb2slider'),
			'_blank' => get_string('targetblank','block_mb2slider')
		);


		$captionHorAlignOpt = array(
			'left' => get_string('left','block_mb2slider'),
			'right' => get_string('right','block_mb2slider'),
			'center' => get_string('center','block_mb2slider')
		);


		$captionHorAlignGlobalOpt = array(
			'' => get_string('global','block_mb2slider'),
			'left' => get_string('left','block_mb2slider'),
			'right' => get_string('right','block_mb2slider'),
			'center' => get_string('center','block_mb2slider')
		);


		$addTextPos = array(
			'left' => get_string('left','block_mb2slider'),
			'right' => get_string('right','block_mb2slider')
		);


		$captionVerAlignOpt = array(
			'top' => get_string('top','block_mb2slider'),
			'bottom' => get_string('bottom','block_mb2slider'),
			'center' => get_string('center','block_mb2slider')
		);


		$captionVerAlignGlobalOpt = array(
			'' => get_string('global','block_mb2slider'),
			'top' => get_string('top','block_mb2slider'),
			'bottom' => get_string('bottom','block_mb2slider'),
			'center' => get_string('center','block_mb2slider')
		);


		$slideSourceArr = array(
			'custom' => get_string('custom','block_mb2slider'),
			'courses' => get_string('courses','block_mb2slider')
		);


		$imagesArr = array(
			'0'=>get_string('none', 'block_mb2slider'),
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
			'10' => '10',
			'11' => '11',
			'12' => '12',
		);


		$numberArr = array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7'
		);





		$sepAttr = ' class="mb2form-separator" style="height:1px;border-top:solid 1px #e5e5e5;margin:30px 0;"';


		$mform->addElement('header', 'config_imagesheader', get_string('slideroptions', 'block_mb2slider'));


		$mform->addElement('text', 'config_title', get_string('configtitle', 'block_mb2slider'));
        $mform->setType('config_title', PARAM_TEXT);


		$mform->addElement('text', 'config_cls', get_string('customcls','block_mb2slider'));
        $mform->setType('config_cls', PARAM_TEXT);


		$mform->addElement('text', 'config_margin', get_string('margin','block_mb2slider'));
		$mform->addHelpButton('config_margin', 'margin', 'block_mb2slider');
        $mform->setType('config_margin', PARAM_TEXT);


		$mform->addElement('text', 'config_langtag', get_string('langtag','block_mb2slider'));
		$mform->addHelpButton('config_langtag', 'langtag', 'block_mb2slider');
        $mform->setType('config_langtag', PARAM_TEXT);


		$mform->addElement('select', 'config_source', get_string('source', 'block_mb2slider'), $slideSourceArr);
		$mform->setDefault('config_animtype', 'custom');


		$ifCourses = array('data-showon'=>'config_source', 'data-showonval'=>'courses');
		$mform->addElement('text', 'config_catid', get_string('catid','block_mb2slider'), $ifCourses);
		$mform->setDefault('config_catid', 0);
        $mform->setType('config_catid', PARAM_INT);


		$mform->addElement('select', 'config_children', get_string('children', 'block_mb2slider'), $yesNoArr, $ifCourses);
		$mform->setDefault('config_children', 1);


		$mform->addElement('html', '<div' . $sepAttr . '></div>');


		$mform->addElement('filemanager', 'config_images', get_string('images','block_mb2slider'), null, array('subdirs'=>false,'maxfiles'=>$slidesCount));


		$mform->addElement('html', '<div' . $sepAttr . '></div>');


		$mform->addElement('text', 'config_contentw', get_string('contentw','block_mb2slider'));
		$mform->setDefault('config_contentw', 1140);
        $mform->setType('config_contentw', PARAM_INT);


		$mform->addElement('html', '<div' . $sepAttr . '></div>');



		$mform->addElement('select', 'config_slidesnum', get_string('slidesnum','block_mb2slider'), $numberArr);
		$mform->setDefault('config_slidesnum', 1);
        $mform->setType('config_slidesnum', PARAM_INT);


		$ifCarousel = array('data-showon2'=>'config_slidesnum', 'data-showonval'=>1);


		$mform->addElement('select', 'config_drow', get_string('drow', 'block_mb2slider'), $yesNoArr, $ifCarousel);
		$mform->setDefault('config_drow', 0);


		$ifSlider = array('data-showon'=>'config_slidesnum', 'data-showonval'=>1);
		$ifSlider2 = ' data-showon="config_slidesnum" data-showonval="1"'; // For 'html' elements


		$mform->addElement('select', 'config_slidesmovenum', get_string('slidesmovenum','block_mb2slider'), $numberArr);
		$mform->setDefault('config_slidesmovenum', 1);
        $mform->setType('config_slidesmovenum', PARAM_INT);


		$mform->addElement('text', 'config_slidemargin', get_string('slidemargin','block_mb2slider'));
		$mform->setDefault('config_slidemargin', 0);
        $mform->setType('config_slidemargin', PARAM_INT);


		$mform->addElement('html', '<div' . $sepAttr . '></div>');


		$mform->addElement('select', 'config_animtype', get_string('animtype', 'block_mb2slider'), $slideAnimArr);
		$mform->setDefault('config_animtype', 'slide');


		$mform->addElement('text', 'config_animspeed', get_string('animspeed','block_mb2slider'));
		$mform->setDefault('config_animspeed', 800);
        $mform->setType('config_animspeed', PARAM_INT);


		$mform->addElement('text', 'config_animpause', get_string('animpause','block_mb2slider'));
		$mform->setDefault('config_animpause', 7000);
        $mform->setType('config_animpause', PARAM_INT);


		$mform->addElement('select', 'config_animauto', get_string('animauto', 'block_mb2slider'), $yesNoArr);
		$mform->setDefault('config_animauto', '1');


		$mform->addElement('select', 'config_animloop', get_string('animloop', 'block_mb2slider'), $yesNoArr);
		$mform->setDefault('config_animloop', '1');


		$mform->addElement('select', 'config_animheight', get_string('animheight', 'block_mb2slider'), $yesNoArr);
		$mform->setDefault('config_animheight', 0);


		$mform->addElement('html', '<div' . $sepAttr . '></div>');


		$mform->addElement('select', 'config_navdir', get_string('navdir', 'block_mb2slider'), $navDirArr);
		$mform->setDefault('config_navdir', '1');


		$mform->addElement('select', 'config_navpager', get_string('navpager', 'block_mb2slider'), $yesNoArr);
		$mform->setDefault('config_navpager', '0');


		$mform->addElement('select', 'config_navkey', get_string('navkey', 'block_mb2slider'), $yesNoArr);
		$mform->setDefault('config_navkey', '1');


		$mform->addElement('html', '<div' . $sepAttr .  '></div>');


		$mform->addElement('select', 'config_captionanim', get_string('captionanim', 'block_mb2slider'), $captionAnimArr, $ifSlider);
		$mform->setDefault('config_captionanim', '1');


		$mform->addElement('text', 'config_titlesize', get_string('titlesize','block_mb2slider'));
		$mform->setDefault('config_titlesize', '42,2.1');
        $mform->setType('config_titlesize', PARAM_TEXT);


		$mform->addElement('text', 'config_descsize', get_string('descsize','block_mb2slider'));
		$mform->setDefault('config_descsize', '18,1');
        $mform->setType('config_descsize', PARAM_TEXT);



		// ----------------------------------------------- Global slide options

		$mform->addElement('header', 'config_global', get_string('slideglobal', 'block_mb2slider'));


		$mform->addElement('select', 'config_linkbtn', get_string('linkbtn', 'block_mb2slider'), $yesNoArr);
		$mform->setDefault('config_linkbtn', 0);


		$ifGbuttonLink = array('data-showon'=>'config_linkbtn', 'data-showonval'=>1);


		$mform->addElement('text', 'config_linkbtntext', get_string('linkbtntext','block_mb2slider'), $ifGbuttonLink);
        $mform->setType('config_linkbtntext', PARAM_TEXT);


		$mform->addElement('text', 'config_linkbtncls', get_string('linkbtncls','block_mb2slider'), $ifGbuttonLink);
		$mform->setDefault('config_linkbtncls', 'btn btn-primary');
        $mform->setType('config_linkbtncls', PARAM_TEXT);


		$mform->addElement('text', 'config_showdesc', get_string('showdesc', 'block_mb2slider'),$ifCourses);
        $mform->setDefault('config_showdesc', 7);
        $mform->setType('config_showdesc', PARAM_INT);


        $mform->addElement('select', 'config_metacontacts', get_string('metacontacts', 'block_mb2slider'), $yesNoArr, $ifCourses);
        $mform->setDefault('config_metacontacts', 0);


        $mform->addElement('select', 'config_metacategory', get_string('metacategory', 'block_mb2slider'), $yesNoArr, $ifCourses);
        $mform->setDefault('config_metacategory', 0);


		$mform->addElement('html', '<div' . $sepAttr . '><span><span' . $ifSlider2 . '></span></span></div>');


		$mform->addElement('text', 'config_captionw', get_string('captionw','block_mb2slider'), $ifSlider);
		$mform->setDefault('config_captionw', 550);
        $mform->setType('config_captionw', PARAM_INT);


		$select = $mform->addElement('select', 'config_captionhalign', get_string('captionhalign','block_mb2slider'), $captionHorAlignOpt, $ifSlider);


		$select = $mform->addElement('select', 'config_captionvalign', get_string('captionvalign','block_mb2slider'), $captionVerAlignOpt, $ifSlider);
		$mform->setDefault('config_captionvalign', 'center');


		$mform->addElement('select', 'config_captionstyle', get_string('captionstyle', 'block_mb2slider'), $captionStyleArr, $ifSlider);
		$mform->setDefault('config_captionstyle', 'fromtheme');


		$mform->addElement('text', 'config_accentcolor', get_string('accentcolor','block_mb2slider'), array('class'=>'mb2slider_color', 'data-showon'=>'config_captionstyle', 'data-showonval'=>'border'));
		$mform->setType('config_accentcolor', PARAM_TEXT);


		$mform->addElement('html', '<div' . $sepAttr . '><span><span' . $ifSlider2 . '></span></span></div>');


		$mform->addElement('text', 'config_obgcolor', get_string('obgcolor','block_mb2slider'), array('class'=>'mb2slider_color'));
		$mform->setType('config_obgcolor', PARAM_TEXT);


		$mform->addElement('text', 'config_cbgcolor', get_string('cbgcolor','block_mb2slider'), array('class'=>'mb2slider_color'));
		$mform->setType('config_cbgcolor', PARAM_TEXT);


		$mform->addElement('advcheckbox', 'config_cshadow', get_string('cshadow','block_mb2slider'), '', array('data-showon'=>'config_slidesnum', 'data-showonval'=>1), array(0,1));
		$mform->setDefault('config_cshadow', 0);
		$mform->setType('config_cshadow', PARAM_INT);


		$mform->addElement('text', 'config_titlecolor', get_string('titlecolor','block_mb2slider'), array('class'=>'mb2slider_color', 'data-showon'=>'config_slidesnum', 'data-showonval'=>1));
		$mform->setType('config_titlecolor', PARAM_TEXT);


		$mform->addElement('text', 'config_desccolor', get_string('desccolor','block_mb2slider'), array('class'=>'mb2slider_color', 'data-showon'=>'config_slidesnum', 'data-showonval'=>1));
		$mform->setType('config_desccolor', PARAM_TEXT);


		$mform->addElement('text', 'config_btncolor', get_string('btncolor','block_mb2slider'), array('class'=>'mb2slider_color', 'data-showon'=>'config_slidesnum', 'data-showonval'=>1));
		$mform->setType('config_btncolor', PARAM_TEXT);




		// ----------------------------------------------- Custom text options

		$mform->addElement('header', 'config_addtext', get_string('addtext', 'block_mb2slider'));


		$mform->addElement('textarea', 'config_texttop', get_string('texttop','block_mb2slider'));
		$mform->setType('config_texttop', PARAM_RAW);


		$mform->addElement('html', '<div' . $sepAttr . '><span><span></span></span></div>');


		$mform->addElement('textarea', 'config_textlr', get_string('textlr','block_mb2slider'));
		$mform->setType('config_textlr', PARAM_RAW);


		$mform->addElement('text', 'config_textlrw', get_string('textlrw','block_mb2slider'));
		$mform->setDefault('config_textlrw', 25);
		$mform->setType('config_textlrw', PARAM_INT);


		$mform->addElement('select', 'config_textlrpos', get_string('textlrpos', 'block_mb2slider'), $addTextPos);


		$mform->addElement('html', '<div' . $sepAttr . '><span><span></span></span></div>');


		$mform->addElement('textarea', 'config_texbottom', get_string('textbottom','block_mb2slider'));
		$mform->setType('config_texbottom', PARAM_RAW);



	   	for($x=1; $x<=$slidesCount; $x++)
	   	{

			$mform->addElement('header', 'config_slide' . $x, get_string('slide', 'block_mb2slider') . ' #' . $x);


			$mform->addElement('select', 'config_imagenum' . $x, get_string('imagenum', 'block_mb2slider'), $imagesArr);
			$mform->setDefault('config_imagenum' . $x, 0);
        	$mform->setType('config_imagenum' . $x, PARAM_INT);


			$mform->addElement('text', 'config_link' . $x, get_string('link','block_mb2slider'));
        	$mform->setType('config_link' . $x, PARAM_TEXT);


			$mform->addElement('select', 'config_linkbtn' . $x, get_string('linkbtn', 'block_mb2slider'), $yesNoGlobalArr, $ifSlider);


			$ifButtonLink = array('data-showon'=>'config_linkbtn' . $x, 'data-showonval'=>1);


			$mform->addElement('text', 'config_linkbtntext' . $x, get_string('linkbtntext','block_mb2slider'), $ifButtonLink);
        	$mform->setType('config_linkbtntext' . $x, PARAM_TEXT);


			$mform->addElement('text', 'config_linkbtncls' . $x, get_string('linkbtncls','block_mb2slider'), $ifButtonLink);
        	$mform->setType('config_linkbtncls' . $x, PARAM_TEXT);


			$select = $mform->addElement('select', 'config_linktarget' . $x, get_string('linktarget','block_mb2slider'), $linkTargetOpt);


			$mform->addElement('html', '<div' . $sepAttr . '></div>');


			$mform->addElement('text', 'config_title' . $x, get_string('title','block_mb2slider'));
        	$mform->setType('config_title' . $x, PARAM_TEXT);


			$mform->addElement('editor', 'config_desc' . $x, get_string('desc','block_mb2slider'));
        	$mform->setType('config_desc' . $x, PARAM_RAW);


			$mform->addElement('html', '<div' . $sepAttr . '></div>');


			$mform->addElement('text', 'config_captionw' . $x, get_string('captionw','block_mb2slider'), $ifSlider);
        	$mform->setType('config_captionw' . $x, PARAM_INT);


			$select = $mform->addElement('select', 'config_captionhalign' . $x, get_string('captionhalign','block_mb2slider'), $captionHorAlignGlobalOpt, $ifSlider);


			$select = $mform->addElement('select', 'config_captionvalign' . $x, get_string('captionvalign','block_mb2slider'), $captionVerAlignGlobalOpt, $ifSlider);



			$mform->addElement('select', 'config_captionstyle' . $x, get_string('captionstyle', 'block_mb2slider'), $captionStyleGlobalArr, $ifSlider);


			$mform->addElement('text', 'config_accentcolor' . $x, get_string('accentcolor','block_mb2slider'), array('class'=>'mb2slider_color', 'data-showon'=>'config_captionstyle' . $x,
			'data-showonval'=>'border'));
			$mform->setType('config_accentcolor' . $x, PARAM_TEXT);


			$mform->addElement('html', '<div' . $sepAttr . '><span><span' . $ifSlider2 . '></span></span></div>');


			$mform->addElement('text', 'config_obgcolor' . $x, get_string('obgcolor','block_mb2slider'), array('class'=>'mb2slider_color'));
			$mform->setType('config_obgcolor' . $x, PARAM_TEXT);


			$mform->addElement('text', 'config_cbgcolor' . $x, get_string('cbgcolor','block_mb2slider'), array('class'=>'mb2slider_color'));
			$mform->setType('config_cbgcolor' . $x, PARAM_TEXT);


			$mform->addElement('advcheckbox', 'config_cshadow' . $x, get_string('cshadow','block_mb2slider'), '', array('data-showon'=>'config_slidesnum', 'data-showonval'=>1), array(0,1));
			$mform->setType('config_cshadow' . $x, PARAM_INT);


			$mform->addElement('text', 'config_titlecolor' . $x, get_string('titlecolor','block_mb2slider'), array('class'=>'mb2slider_color', 'data-showon'=>'config_slidesnum', 'data-showonval'=>1));
			$mform->setType('config_titlecolor' . $x, PARAM_TEXT);


			$mform->addElement('text', 'config_desccolor' . $x, get_string('desccolor','block_mb2slider'), array('class'=>'mb2slider_color', 'data-showon'=>'config_slidesnum', 'data-showonval'=>1));
			$mform->setType('config_desccolor' . $x, PARAM_TEXT);


			$mform->addElement('text', 'config_btncolor' . $x, get_string('btncolor','block_mb2slider'), array('class'=>'mb2slider_color', 'data-showon'=>'config_slidesnum', 'data-showonval'=>1));
			$mform->setType('config_btncolor' . $x, PARAM_TEXT);



		}


    }



	function set_data($defaults) {


		$slidesCount = 7;

		if (empty($entry->id))
		{

		    $entry = new stdClass;
            $entry->id = null;

        }

        $draftitemid = file_get_submitted_draft_itemid('config_images');

       	file_prepare_draft_area($draftitemid, $this->block->context->id, 'block_mb2slider', 'content', 0, array('subdirs'=>true));

      	$entry->attachments = $draftitemid;





        parent::set_data($defaults);


        if ($data = parent::get_data())
		{


			file_save_draft_area_files($data->config_images, $this->block->context->id, 'block_mb2slider', 'content', 0, array('subdirs' => true));


        }


    }


}
