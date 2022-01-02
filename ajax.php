<?php
    require_once('config.php');
    require_once('functions.php');

    header('Content-Type: application/json; charset=utf-8');

    if (isset($_GET['type'])) {
        $type = $_GET['type'];
    } else {
        $type = 'default';
    }
    
    if (isLogged()) {
        $USER = get_user_by_id($_SESSION['user_id']);
    }

    switch ($type) {
        case 'get_country_cities' :
            $cities = [];

            if (isset($_GET['country_id'])) {
                $country_id = $_GET['country_id'];
                $cities_stmt = $conn->query("SELECT * FROM `cities` WHERE `country_id` = {$country_id}");
                $cities = $cities_stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            echo json_encode($cities, JSON_FORCE_OBJECT);

            break;
    }
?>