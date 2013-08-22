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

	function onAjaxSession() {

		$array = $this->params->get('arrayName');
		$input = JFactory::getApplication()->input;

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
		 */
		if ($input->get('add')) {
			$request = isset($_GET['add']) ? $input->get('add') : (isset($_POST['add']) ? $input->get('add') : NULL);

			if ($request && !in_array($request, $_SESSION[$array])) {
				$_SESSION[$array][] = $request;
			}
		}

		/*
		 * Unset array node and re-index the array
		 */
		if ($input->get('delete')) {
			$request = isset($_GET['delete']) ? $input->get('delete') : (isset($_POST['delete']) ? $input->get('delete') : NULL);

			if ($request && in_array($request, $_SESSION[$array])) {
				foreach ($_SESSION[$array] as $key => $value) {
					if ($request == $value) {
						unset($_SESSION[$array][$key]);
					}
				}
				$_SESSION[$array] = array_values($_SESSION[$array]);
			}
		}

		/*
		 * Destroy the session
		 */
		if ($input->get('destroy')) {
			session_destroy();
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
