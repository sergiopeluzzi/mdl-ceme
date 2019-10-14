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
 * Method to get search form
 *
 */
function theme_mb2nl_search_form ()
{


	global $CFG;


	$output = '';


	$output .= '<div class="theme-searchform">';
	$output .= '<form id="theme-search" action="' . $CFG->wwwroot . '/course/search.php" method="GET">';
	$output .= '<input id="theme-coursesearchbox" type="text" value="" placeholder="' . get_string('searchcourses') . '" name="search">';
	$output .= '<button type="submit"><i class="fa fa-search"></i></button>';
	$output .= '</form>';
	$output .= theme_mb2nl_search_links();
	$output .= '</div>';

	return $output;

}




/*
 *
 * Method to get search links
 *
 */
function theme_mb2nl_search_links ()
{

	global $PAGE;
	$output = '';

	$search_menu_items = theme_mb2nl_theme_setting($PAGE,'searchlinks');

	if ($search_menu_items)
	{

		$search_links = new custom_menu($search_menu_items, current_language());


		$output .= '<ul class="theme-searchform-links">';
		$output .= '<li><span class="strong">' .  get_string('popularlinks','theme_mb2nl') . '</span></li>';

		foreach ($search_links->get_children() as $link)
		{

			$url = $link->get_url();

			$output .= '<li>';
			$output .= $url ? '<a href="' . $url . '" title="' . $link->get_text() . '">' : '';
			$output .= $link->get_text();
			$output .= $url ? '</a>' : '';
			$output .= '</li>';

		}

		$output .= '</ul>';

	}

	return $output;

}






/*
 *
 * Method to get login form
 *
 *
 */
function theme_mb2nl_login_form ()
{

	global $PAGE, $OUTPUT, $USER, $CFG;

	$output = '';
	$iswww = '';
    $logintoken = '';

	$iswww = empty($CFG->loginhttps) ?  $CFG->wwwroot : str_replace('http://', 'https://', $CFG->wwwroot);
    $login_url = $iswww . '/login/index.php?authldap_skipntlmsso=1';

    if (method_exists('\core\session\manager','get_login_token'))
    {
        $login_url = get_login_url();
        $logintoken = '<input type="hidden" name="logintoken" value="' . s(\core\session\manager::get_login_token()) .'" />';
    }

	$link_to_login = theme_mb2nl_theme_setting($PAGE,'loginlinktopage',0);

	$output .= '<div class="theme-loginform" style="display:none;">';

	if ((!isloggedin() || isguestuser()) && !$link_to_login)
	{

		$output .= '<form id="header-form-login" method="post" action="' . $login_url . '">';
		$output .= '<div class="form-field">';
		$output .= '<label id="user"><i class="fa fa-user"></i></label>';
		$output .= '<input id="login-username" type="text" name="username" placeholder="' . get_string('username') . '" />';
		$output .= '</div>';
		$output .= '<div class="form-field">';
		$output .= '<label id="pass"><i class="fa fa-lock"></i></label>';
		$output .= '<input id="login-password" type="password" name="password" placeholder="' . get_string('password') . '" />';
		$output .= '</div>';
		//$output .= '<input type="submit" id="submit" name="submit" value="' . get_string('login') . '" />';
		$output .= '<button type="submit"><i class="fa fa-angle-right"></i></button>';
		$output .= $logintoken;
		$output .= '</form>';


		$m33 = 2017051500; // Firs Moodle 3.3 release
		if ($CFG->version >= $m33)
		{
			$authsequence = get_enabled_auth_plugins(true); // Get all auths, in sequence.
            $potentialidps = array();
            foreach ($authsequence as $authname)
			{
                $authplugin = get_auth_plugin($authname);
                $potentialidps = array_merge($potentialidps, $authplugin->loginpage_idp_list($PAGE->url->out(false)));
            }

            if (!empty($potentialidps))
			{
     			$output .= '<div class="potentialidps">';
               	$output .= '<h6>' . get_string('potentialidps', 'auth') . '</h6>';
                $output .= '<div class="potentialidplist">';
                foreach ($potentialidps as $idp)
				{
              		$output .= '<div class="potentialidp">';
                   	$output .= '<a class="btn btn-default" ';
                   	$output.= 'href="' . $idp['url']->out() . '" title="' . s($idp['name']) . '">';
                    if (!empty($idp['iconurl']))
					{
                        $output .= '<img src="' . s($idp['iconurl']) . '" width="24" height="24" class="m-r-1"/>';
                    }
                    $output .= s($idp['name']) . '</a></div>';
                }
                $output .= '</div>';
                $output .= '</div>';
            }
		}

		$loginLink = theme_mb2nl_theme_setting($PAGE,'loginlink',1) == 2 ? $CFG->wwwroot . '/login/forgot_password.php' : $CFG->wwwroot . '/login/index.php';
		$loginText = theme_mb2nl_theme_setting($PAGE,'logintext')  !='' ? theme_mb2nl_theme_setting($PAGE,'logintext') : get_string('logininfo','theme_mb2nl');
		$output .= '<p class="login-info"><a href="' . $loginLink . '">' . $loginText . '</a></p>';

	}
	elseif(isloggedin() && !isguestuser())
	{

		$m27 = 2014051220; // Last formal release of Moodle 2.7
		$output .= ($CFG->version > $m27) ? $OUTPUT->user_menu() : $OUTPUT->login_info();
		$output .= $OUTPUT->user_picture($USER, array('size' => 80, 'class' => 'welcome_userpicture'));

	}


	$output .= '</div>';


	return $output;


}




/*
 *
 * Method to get login form
 *
 *
 */
function theme_mb2nl_header_tools ()
{

	global $OUTPUT, $PAGE, $USER, $CFG;
	$output = '';
	$type = theme_mb2nl_theme_setting($PAGE,'headertoolstype','text');
	$isLoginPage = theme_mb2nl_is_login($PAGE);
	$loginicon = (!isloggedin() or isguestuser()) ? 'lock' : 'user';
	$logintitle = (!isloggedin() or isguestuser()) ? get_string('login','core') : $USER->firstname;
	$search_text = '';
	$login_text = '';
	$settings_text = '';
	$text_close = ' <span class="text2">' . get_string('closebuttontitle','core') . '</span>';
	$jslink_cls = ' header-tools-jslink';


	if ($type === 'text')
	{
		$search_text = ' <span class="text1">' . get_string('searchcourses','core') . '</span>' . $text_close;
		$login_text = ' <span class="text1">' . $logintitle . '</span>' . $text_close;
		$settings_text = ' <span class="text1">' . get_string('themesettings','admin') . '</span>' . $text_close;
	}


	$output .= '<div class="header-tools type-' . $type . '">';


	if (theme_mb2nl_theme_setting($PAGE,'navbarplugin') && theme_mb2nl_moodle_from(2016120500)) // Feature since Moodle 3.2
	{
		$output .= '<div class="theme-plugins">';
		$output .= $OUTPUT->navbar_plugin_output();
		$output .= '</div>';
	}

	$output .= '<a href="#" class="header-tools-link' . $jslink_cls . ' tool-search" title="' . get_string('searchcourses','core') . '">';
	$output .= '<i class="icon1 fa fa-search"></i>';
	$output .= $search_text;
	$output .= '</a>';

	if (!$isLoginPage)
	{

		$link_to_login = theme_mb2nl_theme_setting($PAGE,'loginlinktopage');
		$login_link = '#';

		if ((!isloggedin() || isguestuser()) && $link_to_login)
        {
			$jslink_cls = '';

           if ($CFG->alternateloginurl)
           {
              $login_link = $CFG->alternateloginurl;
           }
           else
           {
  			$login_link = new moodle_url($CFG->wwwroot . '/login/index.php',array());
           }
        }

		$output .= '<a href="' . $login_link . '" class="header-tools-link' . $jslink_cls . ' tool-login" title="' . $logintitle . '">';
		$output .= '<i class="icon1 fa fa-' . $loginicon . '"></i>';
		$output .= $login_text;
		$output .= '</a>';
	}

	if (is_siteadmin())
	{
		$output .= '<a href="#" class="header-tools-link' . $jslink_cls . ' tool-links" title="' . get_string('themesettings','admin') . '">';
		$output .= '<i class="icon1 fa fa-cog fa-spin"></i>';
		$output .= $settings_text;
		$output .= '</a>';
	}


	$output .= '</div>';


	return $output;

}
