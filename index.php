<?php
session_start();
?>

<html>
<head><title>smalr - URL Shortener</title></head>
<body>
<center><?php
    if (isset($_SESSION['success'])) {
        echo "<p>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo "<p>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }   ?>
	<form method="POST" action="functions/shorten.php">
		<input type="url" name="url">
		<input type="text" name="custom">
		<input type="checkbox" name="customCheck">
		<input type="submit" name="submitbtn">
	</form>
	</center>
</body>
</html>