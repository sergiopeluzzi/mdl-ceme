<?php
/**
 * @package		Mb2 Shortcodes
 * @author		Mariusz Boloz (http://mb2extensions.com)
 * @copyright	Copyright (C) 2017 Mariusz Boloz (http://mb2extensions.com). All rights reserved
 * @license		Commercial (http://codecanyon.net/licenses)
**/


defined('MOODLE_INTERNAL') || die();


global $CFG;
require_once (dirname(__FILE__) . '/lib/shortcodes.php');
$themeconfig = theme_config::load($CFG->theme);


$shortcodesDir = '';
$currsent_theme =  $CFG->dirroot . '/theme/' . $CFG->theme . '/shortcodes/';


if (is_dir($currsent_theme))
{
	$shortcodesDir = $currsent_theme;
}
elseif (!empty($themeconfig->parents))
{
	foreach ($themeconfig->parents as $parent)
	{		
		$dir_url = $CFG->dirroot . '/theme/' . $parent . '/shortcodes/';
		
		if (is_dir($dir_url))
		{
			$shortcodesDir = $dir_url;	
		}	
	}
}


$filter = 'php';	
		
		
if (is_dir($shortcodesDir))
{
		
	$dirContents = scandir($shortcodesDir);
			
	foreach ($dirContents as $file) 
	{
				
		$fileType = pathinfo($file, PATHINFO_EXTENSION);
				
		if ($fileType === $filter) 
		{
			require_once ($shortcodesDir . basename($file));
		}
				
	}
		
}					
			
		


class filter_mb2shortcodes extends moodle_text_filter 
{
    
	
	public function filter($text, array $options = array())
	{        
		
		$output = '';
		$array = array (
		
			
			// Before and after shortcode tag shortcode
            '<p>[' 			=> '[',
			'<p> [' 		=> '[',   
		 	']</p>' 		=> ']',
		 	'] </p>' 		=> ']',
			']<br></p>' 	=> ']',
			']</p><br>' 	=> ']',
			'] </p><br>' 	=> ']',
			']</p> <br>' 	=> ']',
			'] </p> <br>' 	=> ']',
			'] <br></p>' 	=> ']',
			']<br> </p>' 	=> ']',
			'] <br> </p>' 	=> ']',		
            ']<br>' 		=> ']',
			'] <br>' 		=> ']',
			'"&nbsp;'		=> '" ',		
			
			
			// Additional filter
			'<p></p>' 		=> '',
			'<p> </p>' 		=> '',
			'<p><br>' 		=> '<p>',
			'<p> <br>' 		=> '<p>',
			'<br></p>'		=> '</p>',
			'<br> </p>' 	=> '</p>'
			
        );		
						
		
		$textFixed = strtr( $text, $array );
		
		
		$output .= mb2_do_shortcode($textFixed);
		
		
		return $output;	
		
    }	
	
}