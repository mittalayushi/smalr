<?php
session_start();
require_once 'functions.php';
$insertCustom = false;
$errors = false;

$shortener= new URLShortener();

if (($_POST['customCheck']=='on')&&(isset($_POST['custom'])))
{
	$custom=$_POST['custom'];

	if(!$shortener->existsURL($custom))
	{
		$insertCustom=true;
	}
	else
	{
		$errors=true;
		$_SESSION['error']="The custom URL is not available.";
	}
}

if(isset($_POST['url'])&&!$errors)
{
	$url=$_POST['url'];
	if(!$insertCustom)
	{
		if($code=$shortener->returnShortCode($url))
		{
			$_SESSION['success']=generateURL($code);
		}
		else
		{
			$_SESSION['error']="There was a problem.";
		}
	}
	else
	{
		if($shortener->returnShortCodeCustom($url,$custom))
		{
			$_SESSION['success']=generateURL($custom);
		}
		else
		{
			header("Error 404");
			die();
		}
	}
}

function generateURL($urlSuffix='')
{
	return "<a href='http://localhost/{$urlSuffix}'>http://localhost/{$urlSuffix}</a>";
}


