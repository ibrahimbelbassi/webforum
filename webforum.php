<?php include 'inc/header.php'; ?>

<?php
$sql = 'SELECT * FROM post';
$result = mysqli_query($conn, $sql);
$post = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<h2>Posts</h2>

<?php if(empty($post)): ?>
<p class="lead mt3">There are no Posts</p>
<?php endif; ?>

<?php foreach ($post as $item): ?>
<div class="card my-3 w-75">
    <div class="card-body text-center">
        <?php echo $item['body']; ?>
        <div class="text-secondary mt-2">
            Created By <?php echo $item['name']; ?> on <?php echo $item['date']; ?>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php include 'inc/footer.php'; ?>