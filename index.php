<?php
    require_once('config.php');
    require_once('functions.php');

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 'default';
    }
    
    if (isLogged()) {
        $USER = get_user_by_id($_SESSION['user_id']);
    }


    include 'views/header.php';
    
    switch ($page) {
        case 'default' :
            include 'views/default.php';
            break;
        case 'login' :
            include 'views/login.php';
            break;
        case 'register' :
            include 'views/register.php';
            break;
        case 'logout' :
            logout();
            redirect($URL);
            break;
        case 'contact' :
            include 'views/contact.php';
            break;
        case 'admin' :
            include 'views/admin.php';
            break;
        case 'add' :
            include 'views/new.php';
            break;
        case 'post' :
            include 'views/post.php';
            break;
            
    }

    include 'views/footer.php';
?>