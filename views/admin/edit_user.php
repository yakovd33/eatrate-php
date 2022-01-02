<?php
    if (!isset($_GET['user_id'])) {
        redirect($URL . '?page=admin');
    } else {
        $user_id = $_GET['user_id'];
        $user = get_user_by_id($user_id);
    }

    $update_feedback = '';

    $countries_query = $conn->query("SELECT * FROM `countries`");

    if (isset($_POST['username'], $_POST['country'])) {
        $username = $_POST['username'];
        $country = $_POST['country'];

        if (!empty($username) && !empty($country)) {
            // Check if username exists
            $username_query = $conn->query("SELECT * FROM `users` WHERE `username` = '{$username}'");

            if ($username != $user['username'] || !$username_query->rowCount()) {
                // Update query
                $conn->query("UPDATE `users` SET `country_id` = {$country}, `username` = '{$username}' WHERE `id` = {$user_id}");
                $user = get_user_by_id($user_id);
                $update_feedback = 'User updated';
            } else {
                $update_feedback = 'Username already exists.';
            }
        }
    }
?>

<form method="POST">
    <div class="form-group">
        <label for="exampleFormControlInput1">Email address</label>
        <input type="email" class="form-control" readonly value="<?php echo $user['email']; ?>" id="exampleFormControlInput1" placeholder="name@example.com">
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $user['username']; ?>" id="exampleFormControlInput1" placeholder="name@example.com">
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Country</label>
        <select class="form-control" name="country" id="exampleFormControlSelect1">
            <option value="">Choose a country</option>
            <?php while ($country = $countries_query->fetch()) : ?>
                <option value="<?php echo $country['id']; ?>" <?php echo $country['id'] == $user['country_id'] ? 'selected' : ''; ?>><?php echo $country['name']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>

    <br>
    <div id="edit-feedback"><?php echo $update_feedback; ?></div>

    <input type="submit" value="Send" class="btn btn-success">
    <br>
</form>