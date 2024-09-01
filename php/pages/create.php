<div class="card mx-auto" style="width: 600px;">
    <div class="card-header text-center">
        <h1>Create User</h1>
    </div>
    <form action="../utils/functions.php" method="post">
        <div class="card-body">
            <input type="hidden" name="createUser">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email">
                <label for="occupation" class="form-label">Occupation</label>
                <input type="text" class="form-control" id="occupation" name="occupation">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" name="create">Create user</button>
            <a href="index.php?page=database" class="btn btn-primary">Go back</a>
        </div>
    </form>
</div>