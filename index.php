<html>
<head><title>smalr - URL Shortener</title></head>
<body>
	<form method="POST" action="functions/shorten.php">
		<input type="text" name="link">
		<input type="text" name="custom">
		<input type="checkbox" name="customCheck">
		<input type="submit" name="submitbtn">
	</form>
	<?php
    if (isset($_SESSION['success'])) {
        echo "<p class='success'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo "<p class='alert'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }   ?>
</body>
</html>