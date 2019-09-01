<?php
	session_start();

	$username = "root";
	$password = "my_P4ssw0rd";

	if (isset($_POST['enter'])) {
		if (($username == $_POST['usr']) && ($password == $_POST['pas'])) {
			isset($_SESSION['admin']);
			$_SESSION['admin'] = true;
			header('location: index.php');
		}else {
			$_SESSION['error'] = true;
		}
	}

	if (isset($_GET['logout'])) {
		unset($_SESSION['error']);
		unset($_SESSION['admin']);
		header('location: index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ADMIN - Big Crone </title>
</head>
<body>

<?php if (isset($_SESSION['admin'])): ?>
	<h1>Welcome Admin...</h1><br>

	<a href="database.php">DATABASE</a><br>

	<a href="index.php?logout=1">LOGOUT</a>
<?php else: ?>
	<form method="post">
		<input type="text" name="usr" placeholder="Admin ID"><br>
		<input type="password" name="pas" placeholder="Password"><br>
		<input type="submit" name="enter" value="LOGIN"><br>

		<br>
		<?php 
			if (isset($_SESSION['error'])) {
				echo "Please Try Again...";
			}
		?>
	</form>
<?php endif ?>

</body>
</html>