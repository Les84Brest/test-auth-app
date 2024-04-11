<?php

function debug($text)
{
	echo '<pre>';
	var_dump($text);
	echo '</pre>';
}

function reset_cookie()
{
	if (isset($_COOKIE)) {

		foreach ($_COOKIE as $key => $val) {
			if (!($key == 'PHPSESSID')) {
				setcookie($key, '', -3600, '/');
			}
		}
	}
}
