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

$settings = null;


defined('MOODLE_INTERNAL') || die();


if (is_siteadmin()) 
{
	   
    // Reguire heleper class
	require (dirname(__FILE__) . '/classess/fields.php');
	
	
	$ADMIN->add('themes', new admin_category('theme_mb2nl', get_string('pluginname', 'theme_mb2nl')));
	
	
	require (dirname(__FILE__) . '/settings/general.php');
	require (dirname(__FILE__) . '/settings/features.php');
	require (dirname(__FILE__) . '/settings/fonts.php');
	require (dirname(__FILE__) . '/settings/navigation.php');	
	require (dirname(__FILE__) . '/settings/social.php');
	require (dirname(__FILE__) . '/settings/style.php');
	require (dirname(__FILE__) . '/settings/typography.php');
		

}