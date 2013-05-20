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

class plgAjaxSession extends JPlugin
{

/**
 * Plugin method with the same name as the event will be called automatically.
 */
 function onAjaxSession()
 {
    $app = &JFactory::getApplication();

        // Plugin code goes here.
        // You can access parameters via $this->params.
    die ('It worked!');
 }
}

/*
 * References
 * - http://docs.joomla.org/Creating_a_Plugin_for_Joomla/1.5
 */