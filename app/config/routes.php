<?php
/* SVN FILE: $Id: routes.php 4409 2007-02-02 13:20:59Z phpnut $ */
/**
 * Short description for file.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2007, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2007, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.app.config
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 4409 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2007-02-02 07:20:59 -0600 (Fri, 02 Feb 2007) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.thtml)...
 */
	$Route->connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	$Route->connect('/poetry/*', array('controller' => 'texts', 'action' => 'listAll', '1'));
	$Route->connect('/prose/*', array('controller' => 'texts', 'action' => 'listAll', '2'));
	$Route->connect('/drama/*', array('controller' => 'texts', 'action' => 'listAll', '3'));

	$Route->connect('/view/*', array('controller' => 'texts', 'action' => 'viewText', ''));
	$Route->connect('/subscribe/*', array('controller' => 'texts', 'action' => 'subscribe', ''));

	$Route->connect('/admin/login/*', array('controller' => 'users', 'action' => 'login'));
	$Route->connect('/admin/logout/*', array('controller' => 'users', 'action' => 'logout'));
	$Route->connect('/admin/edit/*', array('controller' => 'texts', 'action' => 'editText'));
	$Route->connect('/admin/delete/*', array('controller' => 'texts', 'action' => 'deleteText'));
	$Route->connect('/admin/republish/*', array('controller' => 'texts', 'action' => 'republishText'));

	$Route->connect('/admin/*', array('controller' => 'texts', 'action' => 'displayEditList', ''));

	//$Route->connect('/admin/*', array('controller' => 'texts', 'action' => 'displayEditList', ''));
	//$Route->connect('/admin/*', array('controller' => 'texts', 'action' => 'displayEditList', ''));

/**
 * Then we connect url '/test' to our test controller. This is helpfull in
 * developement.
 */
	//$Route->connect('/tests', array('controller' => 'tests', 'action' => 'index'));

	//$Route->connect('/videos', array('controller' => 'videos', 'action' => 'view'));

	//$Route->connect ('/videos/:action/*', array('controller'=>'Videos', 'action'=>'view'));
?>