<?php
session_start();

try {
    $db = new PDO('sqlite:../../db/database.sqlite');
    $sql = "SELECT * FROM users";
    $result = $db->query($sql);

    $users = [];
    while ($user = $result->fetch(PDO::FETCH_ASSOC)) {
        $users[] = $user;
    }

    $rowCount = count($users);
} catch (PDOException $e) {
    echo "Error occurred when connecting to the database: " . $e->getMessage();
    die();
}
?>


<div class="mx-auto" style="width: 600px;">
    <?php if (isset($_SESSION['flash_message'])) { ?>
        <div class='alert alert-<?= $_SESSION['flash_message']['type'] ?> alert-dismissible text-center'
             role='alert'><?= htmlspecialchars($_SESSION['flash_message']['message']) ?>
            <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden="true">&times;</span></button>
        </div>
        <?php unset($_SESSION['flash_message']);
    }
    ?>
    <div class="card">
    <div class="card-header text-center">
        <h1>Delete User</h1>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID #</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Occupation</th>
                <th scope="col">Delete?</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            <?php foreach ($users as $user) { ?>
                <tr>
                    <th scope="row"><?php echo htmlspecialchars($user['id']) ?></th>
                    <td><?php echo htmlspecialchars($user['name']) ?></td>
                    <td><?php echo htmlspecialchars($user['email']) ?></td>
                    <td><?php echo htmlspecialchars($user['occupation']) ?></td>
                    <form action="../utils/functions.php" method="post">
                        <input type="hidden" name="deleteUser">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']) ?>">
                        <td>
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </td>
                    </form>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <a href="index.php?page=database" class="btn btn-primary">Go back</a>
    </div>
</div>