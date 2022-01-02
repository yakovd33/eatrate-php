<?php
    if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
        $post = get_post_by_id($post_id);

        $user = get_user_by_id($post['user_id']);
        $country = get_country_by_id($post['country_id']);
        $city = get_city_by_id($post['city_id']);
    } else {
        redirect($URL);
    }
?>

<img src="<?php echo $URL . $post['file_name']; ?>" height="300px" width="100%" alt="" style="object-fit: cover">

<div class="container mt-5 mb-5">
    <h2><?php echo $post['name']; ?></h2>
    <h6><?php echo $user['username']; ?></h6>

    <div class="mb-2">
        <?php for ($i = 0; $i < $post['rate']; $i++) : ?>
            <img src="<?php echo $URL; ?>images/star.png" height="30px" alt="">
        <?php endfor; ?>
    </div>

    <div>Country: <?php echo $country['name']; ?></div>
    <div>City: <?php echo $city['name']; ?></div>
    <div>Location: <?php echo $post['location']; ?></div>
    <div>Comment: <?php echo $post['comment']; ?></div>
    <div>Price: <?php echo $post['price']; ?></div>
    <div>Persons: <?php echo $post['persons']; ?></div>
</div>