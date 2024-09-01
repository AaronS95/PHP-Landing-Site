<?php
$name = $_GET['name'] ?? "World";
?>

<div class="card mx-auto" style="width: 600px">
    <div class="card-header text-center">
        <h1>Hello <?= $name ?>!</h1>
    </div>
    <div class="card-body">
        <form action="index.php" method="get">
            <input type="hidden" name="page" value="hello">
            <?php if (!isset($_GET['name'])): ?>
                <label class="form-label">Enter your name:</label>
                <input class="form-control my-3" type="text" name="name">
                <button class="btn btn-primary">Submit</button>
            <?php else: ?>
                <div class="text-center">
                    <button class="btn btn-primary">Go back</button>
                </div>
                <?php unset($name); ?>
            <?php endif; ?>
        </form>
    </div>
</div>
