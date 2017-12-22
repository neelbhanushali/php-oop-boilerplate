<?php
	/**
	 * Settings for PHPSESSID
	 * lifetime:0 meaning remove PHPSESSID after browser is closed
	 * path:/ meaning available on the whole website
	 * domain:null meaning available to all domain and subdomain
	 * secure:false meaning send PHPSESSID cookie for non-ssl connection
	 * httponly:true meaning cookie can't be accessed through javascript's document.cookie
	 */
	
	session_set_cookie_params(0, '/', null, false, true);
	session_start();

	/**
	 * setting include path to document root
	 */
	set_include_path($_SERVER['DOCUMENT_ROOT']);

	/**
	 * If file named down exists in root, show maintenance page
	 */
	if(file_exists('down')) {
		require_once 'backend/pages/maintenance.php';
		die();
	}

	/**
	 * CSRF token generation
	 * If it is not generated
	 */
	if(!isset($_SESSION['_token']))	$_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(16));

	/**
	 * Not letting the page continue processing
	 * without the token or an invalid token on a post request
	 *
	 * If the token is presend and valid, then update the token in the session
	 */
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(!isset($_POST['_token']) || $_POST['_token'] !== $_SESSION['_token']) {
			die(json_encode(['message' => 'invalid csrf token']));
		}
		else {
			$_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(16));
		}
	}
	

	

	/**
	 * Converting global variables to objects for easy use
	 * GET
	 * POST
	 * SESSION
	 * COOKIE
	 */
	$p = json_decode(json_encode($_POST));
	$g = json_decode(json_encode($_GET));
	$s = json_decode(json_encode($_SESSION));
	$c = json_decode(json_encode($_COOKIE));
	
	require_once 'backend/classes/db.php';
	require_once 'backend/classes/user.php';
?>