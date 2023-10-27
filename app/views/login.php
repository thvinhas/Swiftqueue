<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"> -->
	</head>
	<body>
		<div class="login">
			<h1>Login</h1>
			<form action="../controller/UserController.php" method="post">
				<label for="username">
					<!-- <i class="fas fa-user"></i> -->
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<!-- <i class="fas fa-lock"></i> -->
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<button class="btn btn-primary" type="submit" name="Login">Cadastrar</button>
			</form>
		</div>
	</body>
</html>