<?php
    function isLogged() {
        return (isset($_SESSION['user_id']) && $_SESSION['user_id']);
    }

    function logout () {
        unset($_SESSION['user_id']);
    }

    function redirect ($url) {
        header("Location: " . $url);
    }

    function validate_email($e){
        return (bool)preg_match("`^[a-z0-9!#$%&'*+\/=?^_\`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_\`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$`i", trim($e));
    }

    function get_user_by_id ($id) {
        global $conn;
        return ($conn->query("SELECT * FROM `users` WHERE `id` = {$id}")->fetch());
    }

    function get_country_by_id ($id) {
        global $conn;
        return ($conn->query("SELECT * FROM `countries` WHERE `id` = {$id}")->fetch());
    }

    function get_city_by_id ($id) {
        global $conn;
        return ($conn->query("SELECT * FROM `cities` WHERE `id` = {$id}")->fetch());
    }

    function get_post_by_id ($id) {
        global $conn;
        return ($conn->query("SELECT * FROM `posts` WHERE `id` = {$id}")->fetch());
    }

    function insert_photo ($file, $uploads_dir, $type = false) {
        // Move to folder
        $tmp_name = $file["tmp_name"];
        $name = md5(time() . rand(0, 10000)) . md5(time() . rand(0, 10000));
        $file_name = $file['name'];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

        if ($file['size'] != 0 && $file['error'] == 0) {
            $allowed_extensions = array('image/png', 'image/jpg', 'image/jpeg');
            if (in_array($file['type'], $allowed_extensions)) {
                $final_path = "/" . $name . "." . $ext;
                $destination = __DIR__ . '/uploads/' . $name . '.' . $ext;
                move_uploaded_file($tmp_name, $destination);

                return $path =  $uploads_dir . '/' . $name . '.' . $ext;
            }
        }
    }
?>