<?php include_once "../utils/functions.php"; ?>

<div class="card mx-auto text-center" style="width: 600px;">
    <div class="card-header">
        <h1>Dog Generator</h1>
    </div>
    <div class="card-body">
        <form action="index.php" method="get">
            <input type="hidden" name="page" value="dog">
            <img id="dogImage" src="<?= $dogImageUrl ?>" alt="Random dog image">
            <br>
            <button id="generateDogButton" class="btn btn-primary mt-3">Generate Dog Image</button>
        </form>
    </div>
    <div class="card-footer">
        <p class="card-text">If an image doesn't appear, try clicking the button again.</p>
    </div>
</div>