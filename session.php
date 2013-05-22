<?php defined('_JEXEC') or die;

/**
 * File       session.php
 * Created    5/20/13 5:28 PM
 * Author     Matt Thomas | matt@betweenbrain.com | http://betweenbrain.com
 * Support    https://github.com/betweenbrain/
 * Copyright  Copyright (C) 2013 betweenbrain llc. All Rights Reserved.
 * License    GNU GPL v3 or later
 */

// Import library dependencies
jimport('joomla.plugin.plugin');

class plgAjaxSession extends JPlugin {

	/**
	 * Plugin method with the same name as the event will be called automatically.
	 */
	function onAjaxSession() {

		$array    = $this->params->get('arrayName');
		$variable = $this->params->get('dataVariable');
		$value    = JRequest::getVar($variable);

		/*
		 * Initialize session
		 */
		session_start();

		/*
		 * Create $_SESSION[$array] as array
		 * Using isset to not throw an error
		 */
		if (!isset($_SESSION[$array])) {
			$_SESSION[$array] = array();
		}

		/*
		 * Populate $_SESSION[$array] only with new $value
		 * Using isset to not throw an error if the array exists, but is empty
		 */
		if (isset($_GET[$variable]) && !in_array($_GET[$variable], $_SESSION[$array])) {
			$_SESSION[$array][] = $value;
		} elseif (isset($_POST[$variable]) && !in_array($_POST[$variable], $_SESSION[$array])) {
			$_SESSION[$array][] = $value;
		}

		/*
		 * Check for session array and return contents
		 */
		if ($_SESSION[$array]) {
			return $_SESSION[$array];
		}

		return FALSE;
	}
}

/*
 * References
 * - http://docs.joomla.org/Creating_a_Plugin_for_Joomla/1.5
 */
