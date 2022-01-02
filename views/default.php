<?php
    $filter = ' 1 ';

    if (isset($_GET['country']) && $_GET['country'] != '') {
        $filter .= 'AND `country_id` = ' . $_GET['country'];
    }

    if (isset($_GET['city']) && $_GET['city'] != '') {
        $filter .= 'AND `city_id` = ' . $_GET['city'];
    }

    if (isset($_GET['rate']) && $_GET['rate'] != '') {
        $filter .= 'AND `rate` = ' . $_GET['rate'];
    }

    if (isset($_GET['biz_name']) && $_GET['biz_name'] != '') {
        $filter .= 'AND `name` LIKE "%' . $_GET['biz_name'] . '%"';
    }

    if (isset($_GET['from'], $_GET['to'])) {
        $from = $_GET['from'];
        $to = $_GET['to'];

        $filter .= " AND (`price` / `persons`) >= {$from} AND (`price` / `persons`) <= {$to}";
    }


    $posts_stmt = $conn->query("SELECT * FROM `posts` WHERE `is_approved` AND " . $filter);
    $country_stmt = $conn->query("SELECT * FROM `countries`");
?>

<!-- Header-->
<header class="bg-dark py-5" id="hero">
    <div id="hero-content">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Welcome To EatRate!</h1>
                <p class="lead fw-normal text-white-50 mb-0">Where you can find the best restaurants</p>
            </div>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container px-3 px-lg-5 mt-5">
        <form action="" id="filter-form">
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
                <select name="rate" id="" class="form-control mt-2">
                    <option value="">Rate from 1-5</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <div class="form-group mt-2">
                <input type="text" name="biz_name" placeholder="Business name" class="form-control">
            </div>

            <div class="form-group mt-2">
                <div><strong>Avg price per person:</strong></div>
                <input type="number" name="from" placeholder="from" style="width: 48%; display: inline-block;" class="form-control">
                <input type="number" name="to" placeholder="to" style="width: 48%; display: inline-block;" class="form-control">
            </div>

            <div class="form-group mt-2 mb-3">
                <input type="submit" value="Filter" class="btn btn-success">
            </div>
        </form>

        <h2 class="mb-4">Top rated businesses:</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-4 row-cols-xl-3 justify-content-center">
            <?php while ($post = $posts_stmt->fetch()) : ?>
                <?php $user = get_user_by_id($post['user_id']); ?>
                <?php $country = get_country_by_id($post['country_id']); ?>
                <?php $city = get_city_by_id($post['city_id']); ?>

                <div class="col mb-5">
                    <a href="<?php echo $URL; ?>?page=post&post_id=<?php echo $post['id']; ?>" class="post-card-link">
                        <div class="card h-100 post-card">
                            <!-- Product image-->
                            <img class="card-img-top" src="<?php echo $URL . $post['file_name']; ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $post['name']; ?></h5>
                                    <!-- Product price-->
                                    <?php echo $user['username']; ?>
                                    <div>Rate: <?php echo $post['rate']; ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

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