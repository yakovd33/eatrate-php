<?php
	if (isLogged()) {
		redirect($URL);
	}

	$login_error = '';

	if (isset($_POST['username'], $_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

    	if (!empty($username) && !empty($password)) {
			// Check if user exists
			$user_query = $conn->query("SELECT * FROM `users` WHERE `username` = '{$username}'");
			
			if ($user_query->rowCount()) {
				// User exists
				$user = $user_query->fetch();

				if (md5($password) == $user['password_hashed']) {
					// Passowrd is correct
					$_SESSION['user_id'] = $user['id'];
					redirect($URL);
				} else {
					$login_error = 'Password is incorrect.';
				}
			} else {
				$login_error = 'User does not exists.';
			}
    	} else {
			$login_error = 'Missing fields.';
		}
  	}
?>

<div class="login-page">
	<?php if (isset($_GET['signed'])) : ?>
		<div class="alert alert-success" role="alert">
			You were successfuly registered.
		</div>
	<?php endif; ?>

    <div class="form">
        <form class="login-form" action="<?php echo $URL; ?>?page=login" method="POST">
            <input type="text" name="username" placeholder="username" />
            <input type="password" name="password" placeholder="password" />

            <?php if ($login_error != '') : ?>
				<div id="login-error"><?php echo $login_error; ?></div>
            <?php endif; ?>

            <button>login</button>
            <p class="message">Not registered? <a href="<?php echo $URL; ?>?page=register">Create an account</a></p>
        </form>
    </div>
</div>