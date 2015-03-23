<?php
	// include core files
	require(getcwd(). '/includes/classes/core/route.php');
    require(getcwd(). '/includes/classes/core/baseController.php');
    require(getcwd(). '/includes/classes/core/template.php');
	require(getcwd(). '/includes/classes/core/database.php');
	require(getcwd(). '/includes/classes/core/router.php');
	require(getcwd(). '/includes/classes/core/form.php');

	// set base vars
	$base_dir = preg_replace('/index.php/', '', $_SERVER['SCRIPT_NAME']);
	$db = new database();
	$template = new template();
	$route = new route($template,$db);
	$router = new router($route);
	$form = new form();
	$array = array(
		'naam' => array(
			'min' => 1,
			'max' => 10,
			'required' => true,
			'unique' => 'class'
			),
		'password' => array(
			'min' => 1,
			'max' => 10,
			'required' => true,
			)				
		);
	$_POST = array('naam' => 'Raoul', 'password' => '');
	$form->check($_POST,$array);
	$template->prepare_data(array(
		'DIR' => $base_dir
		));
?>