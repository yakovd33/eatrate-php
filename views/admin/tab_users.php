<?php
    $users_query = $conn->query("SELECT * FROM `users`");
?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Country</th>
            <th scope="col">Email</th>
            <th scope="col">Registered</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($user = $users_query->fetch()) : ?>
            <?php $country = get_country_by_id($user['country_id']); ?>

            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $country['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['created']; ?></td>
                <td>
                    <a href="<?php echo $URL; ?>?page=admin&tab=delete_user&user_id=<?php echo $user['id']; ?>" class="btn btn-danger">Delete</a>
                    <a href="<?php echo $URL; ?>?page=admin&tab=edit_user&user_id=<?php echo $user['id']; ?>" class="btn btn-warning">Edit</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>