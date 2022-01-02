<?php
	if (isLogged()) {
		redirect($url);
	}

	$register_error = '';

	if (isset($_POST['username'], $_POST['password'], $_POST['re-pass'], $_POST['country'], $_POST['email'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $re_pass = $_POST['re-pass'];
        $country = $_POST['country'];
        $email = $_POST['email'];
        $pass_hashed = md5($password);

    	if (!empty($username) && !empty($password) && !empty($re_pass) && !empty($country) && !empty($email)) {
            // Check if passwords match
			if ($password == $re_pass) {
                // Check if email is valid
                if (validate_email($email)) {
                    // Check if user exists
                    $user_query = $conn->query("SELECT * FROM `users` WHERE `username` = '{$username}' OR `email` = '{$email}'");
                    
                    if (!$user_query->rowCount()) {
                        $conn->query("INSERT INTO `users`(`username`, `password_hashed`, `country_id`, `email`) VALUES ('{$username}', '{$pass_hashed}', {$country}, '{$email}')");

                        // Show success msg
                        redirect($URL . '?page=login&signed');
                    } else {
                        // User exists
                        $register_error = 'Username or email already exists.';
                    }
                } else {
                    $register_error = 'Email is not valid';
                }
            } else {
                $register_error = 'Passwords do not match.';
            }
    	} else {
			$register_error = 'Missing fields.';
        }
  	}

    $countries_query = $conn->query("SELECT * FROM `countries`");
?>

<div class="login-page">
    <div class="form">
        <form class="login-form" action="<?php echo $URL; ?>?page=register" method="POST">
            <select name="country" id="">
                <option value="">Select a country</option>

                <?php while ($country = $countries_query->fetch()) : ?>
                    <option value="<?php echo $country['id']; ?>"><?php echo $country['name']; ?></option>
                <?php endwhile; ?>
            </select>

            <input type="email" name="email" placeholder="Email">

            <input type="text" name="username" placeholder="Username" />

            <input type="password" name="password" placeholder="Password" />

            <input type="password" name="re-pass" placeholder="Re-enter Password" />

            <?php if ($register_error != '') : ?>
				<div id="login-error"><?php echo $register_error; ?></div>
            <?php endif; ?>

            <button>Register</button>
            <p class="message">Already registered? <a href="<?php echo $URL; ?>?page=login">Login</a></p>
        </form>
    </div>
</div>