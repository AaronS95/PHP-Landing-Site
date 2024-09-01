<?php

include '../utils/functions.php';

$threads = getFourChanData();

?>

<div class="card mx-auto" style="width: 800px;">
    <div class="card-header text-center">
        <h1>4chan Posts and Comments on the /o/ board (Auto)</h1>
    </div>
    <div class="card-body">
        <p>I use the 4chan API to pull a list of threads and the latest replies associated with it. This page is "NSFW" due to the nature of 4chan and its users...</p>
        <p class="fw-bold text-center">THREADS:</p>
        <div class="accordion" id="accordionExample">
            <?php foreach ($threads as $thread) { ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse<?= $thread['no'] ?>" aria-expanded="false"
                                aria-controls="collapse<?= $thread['no'] ?>">
                            Thread #<?= $thread['no'] ?> - <?= $thread['sub'] ?? substr($thread['com'], 0, 80) . "..." ?>

                        </button>
                    </h2>
                    <div id="collapse<?= $thread['no'] ?>" class="accordion-collapse collapse"
                         data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?php foreach ($thread['last_replies'] as $comment) { ?>
                                <div class="card my-2">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $comment['name'] ?? "Anonymous" ?></h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary"><?= $comment['now'] ?></h6>
                                        <p class="card-text"><?= $comment['com'] ?? "" ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="card-footer">
        <p class="card-text text-center">"Refresh" to get the latest posts and comments... &#8594;
            <button class="btn btn-success" onclick='window.location.reload();'>Refresh</button>
        </p>
    </div>
</div>

<!-- <pre><?php //var_dump($json) ?></pre> -->