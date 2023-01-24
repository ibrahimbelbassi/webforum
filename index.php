<?php include 'inc/header.php'; ?>

<?php
$name = $email = $body = '';
$name_err = $email_err = $body_err = '';

// Form submit
if (isset($_POST['submit'])) {
    // Validate the name
    if (empty($_POST['name'])) {
        $name_err = 'Name is required';
    } else {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    // Validate the email
    if (empty($_POST['email'])) {
        $email_err = 'Email is required';
    } else {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    }

    // Validate the body
    if (empty($_POST['body'])) {
        $body_err = 'Post is required';
    } else {
        $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if (empty($name_err) && empty($email_err) && empty($body_err)) {
        // Add to database
        $insert_stmt = $conn->prepare("INSERT INTO post (name, email, body) VALUES (?, ?, ?)");
        $insert_stmt->bind_param("sss", $name, $email, $body);
        
        if($insert_stmt->execute()) {
            // Success
            header('Location: webforum.php');
            $insert_stmt->close();
            $conn->close();
        }
        else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }
}

?>

<img src="\webforum\img\logo.png" class="w-25 mb-3" alt="">
<h2>Webforum</h2>
<p class="lead text-center">Posting in Belbassi's Webforum</p>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="mt-4 w-75">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?php echo $name_err ? 'is-invalid' : null; ?>" 
        id="name" name="name" placeholder="Enter your name">
        <div class="invalid-feedback">
            <?php echo $name_err; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?php echo $email_err ? 'is-invalid' : null; ?>" 
        id="email" name="email" placeholder="Enter your email">
        <div class="invalid-feedback">
            <?php echo $email_err; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Post</label>
        <textarea class="form-control <?php echo $body_err ? 'is-invalid' : null; ?>" 
        id="body" name="body" placeholder="Enter your post"></textarea>
        <div class="invalid-feedback">
            <?php echo $body_err; ?>
        </div>
    </div>
    <div class="mb-3">
        <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
    </div>
</form>

<?php include 'inc/footer.php'; ?>