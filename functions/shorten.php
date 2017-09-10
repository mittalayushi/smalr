<?php
session_start();
require_once 'function.php';
$insertCustom = false;
$errors = false;

$shortener= new URLShortener();

if (($_POST['customcheck']=='on')&&(isset($_POST['custom'])))
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
		$customCode = $_POST['custom'];
		if($shortener->returnShortCodeCustom($url,$customCode))
		{
			$_SESSION['success']=generateURL($customCode);
		}
		else
		{
			header("Location: ../index.php?error=inurl");
			die();
		}
	}
}

function generateURL($urlSuffix='')
{
	return "<a href='http://localhost/smalr/{$urlSuffix}'>http://localhost/smalr/{$urlSuffix}</a>";
}
header("Location: ../index.php");

