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

		$node        = htmlspecialchars($this->params->get('node'));
		$input       = JFactory::getApplication()->input;
		$session     = JFactory::getSession();
		$sessionData = $session->get($node);

		if (is_null($sessionData)) {
			$sessionData = array();
			$session->set($node, $sessionData);
		}

		if ($input->get('add')) {
			$data = $input->get('add');
			if (!isset($sessionData[$data]) && $data != '') {
				$sessionData[$data] = $data;
				$session->set($node, $sessionData);
			}
		}

		if ($input->get('delete')) {
			$data = $input->get('delete');
			if (isset($sessionData[$data])) {
				unset($sessionData[$data]);
				$session->set($node, $sessionData);
			}
		}

		if ($input->get('destroy')) {
			$sessionData = NULL;
			$session->set($node, $sessionData);
		}

		if ($input->get('debug')) {
			die('<pre>' . print_r($sessionData, TRUE) . '</pre>');
		}

		if ($sessionData) {
			return $sessionData;
		}

		return FALSE;
	}
}

/*
 * References
 * - http://docs.joomla.org/Creating_a_Plugin_for_Joomla/1.5
 */
