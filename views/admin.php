<?php
    if (!isLogged() || !$USER['isAdmin']) {
        redirect($URL);
        die('You are not an admin');
    }

    if (isset($_GET['tab'])) {
        $tab = $_GET['tab'];
    } else {
        $tab = 'users';
    }
?>

<div class="container">
    <div id="tab-triggers">
        <a href="<?php echo $URL; ?>?page=admin&tab=users" class="tab-trigger btn btn-success">Users</a>
        <a href="<?php echo $URL; ?>?page=admin&tab=posts" class="tab-trigger btn btn-success">Posts</a>
        <a href="<?php echo $URL; ?>?page=admin&tab=contacts" class="tab-trigger btn btn-success">Contacts</a>
        <a href="<?php echo $URL; ?>?page=admin&tab=stats" class="tab-trigger btn btn-warning">Statistics</a>
    </div>

    <?php
        switch ($tab) {
            case 'users' :
                include 'admin/tab_users.php';
                break;
            case 'posts' :
                include 'admin/tab_posts.php';
                break;
            case 'contacts' :
                include 'admin/tab_contacts.php';
                break;
            case 'delete_user' :
                if (isset($_GET['user_id'])) {
                    $user_id = $_GET['user_id'];
                    $conn->query("DELETE FROM `users` WHERE `id` = {$user_id}");
                }
                
                redirect($URL . '?page=admin');
                break;
            case 'edit_user' :
                include 'admin/edit_user.php';
                break;
        }
    ?>
</div>