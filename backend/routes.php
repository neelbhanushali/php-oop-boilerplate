<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/backend/inc.php';

$route['/'] = function() {
	get('website/home');
};

$route['/about'] = function() {
	get('website.about');
};

$route['/user/([A-Za-z0-9]\w+)'] = function($username) {
	$GLOBALS['username'] = $username;
	get('website.user');
};

$route['/date/([0-9]\w+)/([0-9]\w+)/([0-9]\w+)'] = function($year, $month, $day) {
	$GLOBALS['day'] = $day;
	$GLOBALS['month'] = $month;
	$GLOBALS['year'] = $year;
	get('website.date');
};

$route['/asdf'] = function() {
	$abcd = new abcd();
	$abcd->all();
	$GLOBALS['asdf'] = $abcd->results;
	get('website.asdf');
};

function get($page) {
	$page = preg_replace('/\./', '/', $page);
	require_once 'backend/pages/'.$page.'.php';
}

function mr($route) {
	$matched = false;
	foreach($route as $key => $value) {
		if(preg_match('#^'.$key.'$#', $_SERVER['REQUEST_URI'], $match)) {
			$function = new ReflectionFunction($value);
			$num = $function->getNumberOfParameters();
			if($num) {
				array_shift($match);
				call_user_func_array($value, $match);
			}
			else {
				$value();
			}
			$matched = true;
		}
	}

	if(!$matched) {
		get('404');
	}
}

mr($route);
?>