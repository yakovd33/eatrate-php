<?php
    $contact_error = '';

    if (isset($_POST['fullname'], $_POST['email'], $_POST['message'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        
        if (!empty($fullname) && !empty($email) && !empty($message)) {
            // Insert message
            $conn->query("INSERT INTO `contacts`(`fullname`, `email`, `message`) VALUES ('{$fullname}', '{$email}', '{$message}')");
            $contact_error = 'Message sent successfuly.';
        } else {
            $contact_error = 'Missing/empty fields.';
        }
    }
?>

<div class="container contact-page">
    <h2 class="text-center">Contact us</h2>
	<div class="row justify-content-center">
		<div class="col-12 col-md-8 col-lg-6 pb-5">

                    <!--Form with header-->

                    <form method="POST">
                        <div class="card border-primary rounded-0">
                            <div class="card-header p-0">
                                <div class="bg-info text-white text-center py-2">
                                    <h3><i class="fa fa-envelope"></i> Leave a message</h3>
                                    <p class="m-0">We will get back to you</p>
                                </div>
                            </div>
                            <div class="card-body p-3">

                                <!--Body-->
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="nombre" name="fullname" placeholder="Your full name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                        </div>
                                        <input type="email" class="form-control" id="nombre" name="email" placeholder="Your email" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                                        </div>
                                        <textarea class="form-control" name="message" placeholder="Your message" required></textarea>
                                    </div>
                                </div>

                                <?php if ($contact_error != '') : ?>
                                    <div id="contact-feedback"><?php echo $contact_error; ?></div>
                                <?php endif; ?>

                                <div class="text-center">
                                    <input type="submit" value="Send" class="btn btn-info btn-block rounded-0 py-2">
                                </div>
                            </div>

                        </div>
                    </form>
                    <!--Form with header-->


                </div>
	</div>
</div>