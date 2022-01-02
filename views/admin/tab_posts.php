<?php

    if (isset($_GET['approve']) || isset($_GET['reject'])) {
        $post_id = isset($_GET['approve']) ? $_GET['approve'] : $_GET['reject'];
        
        if (isset($_GET['approve'])) {
            // Approve post
            $conn->query("UPDATE `posts` SET `is_approved` = 1 WHERE `id` = {$post_id}");
        }
        
        $conn->query("UPDATE `posts` SET `was_reviewed` = 1 WHERE `id` = {$post_id}");
    }

    $posts_stmt = $conn->query("SELECT * FROM `posts` WHERE NOT `was_reviewed`");
?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">User</th>
            <th scope="col">Country</th>
            <th scope="col">City</th>
            <th scope="col">Location</th>
            <th scope="col">Bussiness Name</th>
            <th scope="col">Rate</th>
            <th scope="col">Comment</th>
            <th scope="col">Date</th>
            <th scope="col">Image</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($post = $posts_stmt->fetch()) : ?>
            <?php $user = get_user_by_id($post['user_id']); ?>
            <?php $country = get_country_by_id($post['country_id']); ?>
            <?php $city = get_city_by_id($post['city_id']); ?>

            <tr>
                <td><?php echo $post['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $country['name']; ?></td>
                <td><?php echo $city['name']; ?></td>
                <td><?php echo $post['location']; ?></td>
                <td><?php echo $post['name']; ?></td>
                <td><?php echo $post['rate']; ?></td>
                <td><?php echo $post['comment']; ?></td>
                <td><?php echo $post['date']; ?></td>
                <td>
                    <a href="<?php echo $URL . $post['file_name']; ?>"><button class="btn btn-primary">Link</button></a>
                </td>
                <td>
                    <a href="<?php echo $URL; ?>?page=admin&tab=posts&approve=<?php echo $post['id']; ?>" class="btn btn-success">Approve</a>
                    <a href="<?php echo $URL; ?>?page=admin&tab=posts&reject=<?php echo $post['id']; ?>" class="btn btn-danger">Reject</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>