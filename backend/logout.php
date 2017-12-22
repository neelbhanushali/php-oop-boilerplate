<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/inc.php';
	session_destroy();
	header('location:'.$_SERVER['HTTP_REFERER']);
?>