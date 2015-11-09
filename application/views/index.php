
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="/assets/styles.css">
	<meta charset="utf-8">
	<title>Employee Wishlist Portal</title>
</head>
<body>
	<div id="wrapper">
		<h1>Welcome!</h1>
		<h4>This is the Employee Wishlist Portal</h4>
		<div id="register">
			<h3>Register</h3>
			<form action="Users/register" method="post">
				<p>Name: <input type="text" name="name"></p>
				<p>Username: <input type="text" name="username"></p>
				<p>Password: <input type="password" name="password"></p>
					<h5>*Password should be at least 8 characters</h5>
				<p>Confirm Password: <input type="password" name="pw_confirm"></p>
				<p>Date Hired: <input type="date" name="doh"></p>
				<input type="submit" value="Register">
			</form>
		</div>
		<div id="login">
			<h3>Login</h3>
			<form action="Users/login" method="post">
				<p>Username: <input type="text" name="username">
				<p>Password: <input type="password" name="password"></p>
				<input type="submit" value="Login">
			</form>
		</div>
		<div>
			<?= $this->session->flashdata("success_message"); ?>
		</div>
		<div id="errors">
			<?= $this->session->flashdata("errors"); ?>
		</div>
	</div>
</body>
</html>
