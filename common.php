<?php
	// include core files
    require(getcwd(). '/includes/classes/core/Default.functions.php');
    require(getcwd(). '/includes/classes/core/template.php');
	require(getcwd(). '/includes/classes/core/database.php');
	require(getcwd(). '/includes/classes/core/router.php');
	require(getcwd(). '/includes/classes/core/form.php');

	// set base vars
	$base_dir = preg_replace('/index.php/', '', $_SERVER['SCRIPT_NAME']);
	$class = (empty($_GET['class'])) ? 'default' : $_GET['class'];
	$method = (empty($_GET['method'])) ? 'view' : $_GET['method'];
	$template = new template();
	//$router = new Router($class, $method);
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
		$_POST = array('doei');
	$form->check($_POST,$array);
	$template->prepare_data(array(
		'DIR' => $base_dir
		));
?>