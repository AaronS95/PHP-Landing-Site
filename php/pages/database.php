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
            <h1>Sample Database</h1>
        </div>
        <?php if ($rowCount === 0) { ?>
            <div class="card-body alert alert-warning text-center" role="alert">
                No users found in the database.<br>Click the "Seed DB" button to add some users.
            </div>
            <div class="card-footer">
                <form action="../utils/functions.php" method="post">
                    <input type="hidden" name="page" value="database">
                    <button class="btn btn-primary" name="seed">Seed DB</button>
                </form>
            </div>
        <?php } ?>
        <?php if ($rowCount > 0) { ?>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID #</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Occupation</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($user['id']) ?></th>
                            <td><?php echo htmlspecialchars($user['name']) ?></td>
                            <td><?php echo htmlspecialchars($user['email']) ?></td>
                            <td><?php echo htmlspecialchars($user['occupation']) ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="index.php?page=create" class="btn btn-primary">Create User</a>
                <a href="index.php?page=edit" class="btn btn-primary">Edit User</a>
                <a href="index.php?page=delete" class="btn btn-primary">Delete User</a>
            </div>
        <?php } ?>
    </div>
