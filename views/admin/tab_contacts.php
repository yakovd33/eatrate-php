<?php
    $contacts_query = $conn->query("SELECT * FROM `contacts`");
?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Fullname</th>
            <th scope="col">Email</th>
            <th scope="col">Message</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($contact = $contacts_query->fetch()) : ?>
            <tr>
                <td><?php echo $contact['id']; ?></td>
                <td><?php echo $contact['fullname']; ?></td>
                <td><?php echo $contact['email']; ?></td>
                <td><?php echo $contact['message']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>