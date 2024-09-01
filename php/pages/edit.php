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
            <h1>Edit User</h1>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID #</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Occupation</th>
                    <th scope="col">Edit?</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                <?php foreach ($users as $user) {
                    $modalId = "editModal" . $user['id'];
                    ?>
                    <tr>
                        <th scope="row"><?= htmlspecialchars($user['id']) ?></th>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['occupation']) ?></td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#<?= $modalId; ?>">
                                Edit
                            </button>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="<?= $modalId; ?>" data-bs-backdrop="static" data-bs-keyboard="false"
                         tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Editing user</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="../utils/functions.php" method="post">
                                    <div class="modal-body">
                                        <input type="hidden" name="editUser">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="<?= htmlspecialchars($user['name']) ?>">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                               value="<?= htmlspecialchars($user['email']) ?>">
                                        <label for="occupation" class="form-label">Occupation</label>
                                        <input type="text" class="form-control" id="occupation" name="occupation"
                                               value="<?= htmlspecialchars($user['occupation']) ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="index.php?page=database" class="btn btn-primary">Go back</a>
        </div>
    </div>
</div>