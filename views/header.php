<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EatRate</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>style/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="<?php echo $URL; ?>">EatRate</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page"
                            href="<?php echo $URL; ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $URL; ?>?page=contact">Contact</a></li>

                    <?php if (isLogged()) : ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $URL; ?>?page=add">Add Post</a></li>
                    <?php endif; ?>
                    
                    <?php if (isLogged() && $USER['isAdmin']) : ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $URL; ?>?page=admin">Admin</a></li>
                    <?php endif; ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <?php if (!isLogged()) : ?>
                        <a href="<?php echo $URL; ?>?page=login" class="btn btn-success">
                            Login/Register
                        </a>
                    <?php else : ?>
                        <a href="<?php echo $URL; ?>?page=logout" class="btn btn-danger">
                            Logout
                        </a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </nav>