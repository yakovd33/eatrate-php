<?php
    if (!isLogged()) {
        header("Location: " . $URL);
    }

    $country_stmt = $conn->query("SELECT * FROM `countries`");

    $feedback = '';
    $success_feedback = '';

    if (isset($_POST['country'], $_POST['city'], $_POST['location'], $_POST['name'], $_POST['rate'], $_POST['comment'], $_POST['price'], $_POST['persons'])) {
        $country = $_POST['country'];
        $city = $_POST['city'];
        $location = $_POST['location'];
        $name = $_POST['name'];
        $rate = $_POST['rate'];
        $comment = $_POST['comment'];
        $price = $_POST['price'];
        $persons = $_POST['persons'];

        if (!empty($country) && !empty($city) && !empty($location) && !empty($name) && !empty($rate) && !empty($comment) && !empty($price) && !emprt($persons)) {
            if (isset($_FILES['file'])) {
                $file = $_FILES['file'];

                // Upload image
                $image = insert_photo($_FILES['file'], 'uploads');

                $insert_prep_stmt = $conn->prepare("INSERT INTO `posts`(`user_id`, `country_id`, `city_id`, `location`, `name`, `rate`, `comment`, `file_name`, `price`, `persons`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $insert_prep_stmt->execute([$_SESSION['user_id'], $country, $city, $location, $name, $rate, $comment, $image, $price, $persons]);
                $success_feedback = 'Post added successfuly.';
            } else {
                $feedback = 'Missing picture';
            }
        } else {
            $feedback = 'Missing fields';
        }
    }
?>

<form action="" method="POST" id="new-post-form" enctype="multipart/form-data">
    <h2>Add a new post:</h2>
    <div class="form-group">
        <select name="country" class="form-control" id="country-select">
            <option value="">Choose a country</option>

            <?php while ($country = $country_stmt->fetch()) : ?>
                <option value="<?php echo $country['id']; ?>"><?php echo $country['name']; ?></option>
            <?php endwhile; ?>
        </select>

        <select name="city" id="city-select" class="form-control mt-2">
            <option value="">Choose a city</option>
        </select>
    </div>

    <div class="form-group">
        <input type="text" name="location" placeholder="What is the bussiness location?" class="form-control mt-2">
    </div>

    <div class="form-group">
        <input type="text" name="name" placeholder="What is the bussiness name?" class="form-control mt-2">
    </div>

    <div class="form-group">
        <select name="rate" id="" class="form-control mt-2">
            <option value="">Rate from 1-5</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>

    <div class="form-group">
        <textarea name="comment" id="" placeholder="Comment" class="form-control mt-2"></textarea>
    </div>

    <div class="form-group">
        <input type="number" placeholder="Price" name="price" class="form-control mt-2">
        <input type="number" placeholder="Persons" name="persons" class="form-control mt-2">
    </div>

    <label for="" class="mt-2">Picture:</label>
    <div class="custom-file mt-2">
        <input type="file" name="file" class="custom-file-input" id="customFile">
        <label class="custom-file-label" for="customFile">Choose file</label>
    </div>

    <?php if ($feedback != '') : ?>
        <div class="alert alert-danger mt-2" role="alert">
            <?php echo $feedback; ?>
        </div>
    <?php endif; ?>

    <?php if ($success_feedback != '') : ?>
        <div class="alert alert-success mt-2" role="alert">
            <?php echo $success_feedback; ?>
        </div>
    <?php endif; ?>

    <div class="form-group mt-2">
        <input type="submit" value="SEND" class="form-control btn btn-success">
    </div>
</form>

<script>
    $('#country-select').change(function () {
        $.ajax({
            url: '<?php echo $URL; ?>ajax.php?type=get_country_cities&country_id=' + $(this).val(),
            processData: false,
            contentType: false,
            method : 'GET',
            success: function (response) {
                $("#city-select").html('');

                for (let key of Object.keys(response)) {
                    let city = response[key];
                    $("#city-select").append(`<option value="${ city.id }">${ city.name }</option>`)
                }
            }
        });
    })
</script>