<?php include_once "../utils/functions.php"; ?>

<div class="card mx-auto" style="width: 600px;">
    <div class="card-header text-center">
        <h1>Password Generator</h1>
    </div>
    <form action="index.php" method="get">
        <div class="card-body">
            <input type="hidden" name="page" value="password">
            <div class="mx-5">
                <p class="text-center">Click the button below to generate a random password.</p>
                <div class="mb-2">
                    <label for="length" class="form-label">Choose length of password:</label>
                    <input type="text" id="length" name="length" value="8">
                </div>
                <div class="form-check form-switch mb-2">
                    <input type="checkbox" class="form-check-input" role="switch" id="numbers" name="numbers">
                    <label for="numbers" class="form-check-label">Include numbers?</label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input type="checkbox" class="form-check-input" role="switch" id="uppercase" name="uppercase">
                    <label for="uppercase" class="form-check-label">Include uppercase characters?</label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input type="checkbox" class="form-check-input" role="switch" id="specialChars" name="specialChars">
                    <label for="specialChars" class="form-check-label">Include special characters? (!@£$%^&<>?)</label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input type="checkbox" class="form-check-input" role="switch" id="apple" name="apple">
                    <label for="apple" class="form-check-label">Make it like Apple? (6 + 6 + 6 format)</label>
                </div>
                <p>Password: <span class="fw-semibold" id="password"><?= $newPassword ?></span></p>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" id="generatePwButton" name="generate">Generate</button>
        </div>
    </form>
</div>