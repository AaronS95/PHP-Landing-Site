<?php
include "../utils/functions.php";

if (isset($_GET['num1'], $_GET['num2'], $_GET['operator'])) {
    $num1 = $_GET['num1'];
    $num2 = $_GET['num2'];
    $operator = $_GET['operator'];
    $result = myCalculator($num1, $num2, $operator);
}
?>

<div class="card mx-auto" style="width: 600px;">
    <div class="card-header text-center">
        <h1>Simple Calculator</h1>
    </div>
    <div class="card-body">
        <p>Enter 2 numbers below and choose an operator.</p>
        <form action="index.php" method="get">
            <input type="hidden" name="page" value="calculator">
            <div class="mb-3">
                <label class="form-label">Number 1:</label>
                <input class="form-control" type="text" name="num1">
            </div>
            <div class="mb-3">
                <label class="form-label">Operator:</label>
                <select name="operator">
                    <option value="add">Add</option>
                    <option value="sub">Subtract</option>
                    <option value="mul">Multiply</option>
                    <option value="div">Divide</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Number 2:</label>
                <input class="form-control" type="text" name="num2">
            </div>
            <button class="btn btn-primary">Calculate!</button>
        </form>
    </div>
    <?php if (isset($result)): ?>
        <div class="card-footer text-center">
            <p class='font-weight-bold'>The result is: <?= $result ?></p>
        </div>
    <?php endif; ?>
</div>
</div>