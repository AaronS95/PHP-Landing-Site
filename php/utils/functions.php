<?php

include 'logger.php';

if (isset($_POST['seed'])) {
    seedDatabase();
}

if (isset($_POST['createUser'])) {
    createUser();
}

if (isset($_POST['editUser'])) {
    editUser();
}

if (isset($_POST['deleteUser'])) {
    deleteUser();
}

function myCalculator($num1, $num2, $operator): float|int|string
{
    return match ($operator) {
        "add" => $num1 + $num2,
        "sub" => $num1 - $num2,
        "mul" => $num1 * $num2,
        "div" => $num2 != 0 ? $num1 / $num2 : "Cannot divide by zero!",
        default => "There was an error!",
    };
}

function getDogImage(): string
{
    $response = file_get_contents("https://random.dog/woof.json");
    if ($response) {
        $json = json_decode($response);
        $url = $json->url;
        if (!str_contains($url, ".mp4") && !str_contains($url, ".webm")) {
            return $url;
        }
    }
    return "";
}

function seedDatabase(): void
{
    session_start();
    try {
        $db = new PDO('sqlite:../../db/database.sqlite');

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->exec("DROP TABLE IF EXISTS users");

        $createTable = "CREATE TABLE users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL,
            occupation TEXT NOT NULL
        )";

        $db->exec($createTable);

        $query = "INSERT INTO users (name, email, occupation) VALUES
            ('John Doe', 'john.doe@gmail.com', 'Accountant'),
            ('Jane Doe', 'jane.doe@gmail.com', 'Manager')
            ";

        $db->exec($query);

        $_SESSION['flash_message'] = [
            'type' => "success",
            'message' => "Seeded the database successfully!"
        ];
        header("Location: ../pages/index.php?page=database");
        exit();
    } catch (PDOException $e) {
        $_SESSION['flash_message'] = [
            'type' => "danger",
            'message' => "There was a problem with seeding the database: " . $e->getMessage()
        ];
        header("Location: ../pages/index.php?page=database");
        die();
    }
}

function createUser(): void
{
    session_start();
    try {
        $db = new PDO('sqlite:../../db/database.sqlite');

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $name = $_POST['name'];
        $email = $_POST['email'];
        $occupation = $_POST['occupation'];

        $query = "INSERT INTO users (name, email, occupation) VALUES (:name, :email, :occupation)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':occupation', $occupation);

        $stmt->execute();

        $_SESSION['flash_message'] = [
            'type' => "success",
            'message' => "User created successfully!"
        ];
        header("Location: ../pages/index.php?page=database");
        exit();
    } catch (PDOException $e) {
        $_SESSION['flash_message'] = [
            'type' => "danger",
            'message' => "There was a problem creating the user: " . $e->getMessage()
        ];
        header("Location: ../pages/index.php?page=database");
        die();
    }
}

function editUser(): void
{
    session_start();
    try {
        $db = new PDO('sqlite:../../db/database.sqlite');

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $occupation = $_POST['occupation'];

        $query = "UPDATE users SET name = :name, email = :email, occupation = :occupation WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':occupation', $occupation);

        $stmt->execute();

        $_SESSION['flash_message'] = [
            'type' => "success",
            'message' => "User updated successfully!"
        ];
        header("Location: ../pages/index.php?page=edit");
        exit();
    } catch (PDOException $e) {
        $_SESSION['flash_message'] = [
            'type' => "danger",
            'message' => "There was a problem updating the user: " . $e->getMessage()
        ];
        header("Location: ../pages/index.php?page=edit");
        die();
    }
}

function deleteUser(): void
{
    session_start();
    try {
        $db = new PDO('sqlite:../../db/database.sqlite');

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_POST['id'];

        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $_SESSION['flash_message'] = [
            'type' => "success",
            'message' => "User deleted successfully!"
        ];
        header("Location: ../pages/index.php?page=delete");
        exit();
    } catch (PDOException $e) {
        $_SESSION['flash_message'] = [
            'type' => "danger",
            'message' => "There was a problem deleting the user: " . $e->getMessage()
        ];
        header("Location: ../pages/index.php?page=delete");
        die();
    }
}

function generatePassword(
    $length = 8,
    $numbers = false,
    $uppercase = false,
    $specialChars = false,
    $apple = false
): string
{
    $characters = "abcdefghijklmnopqrstuvwxyz";

    if ($apple) {
        $length = 18;
        $numbers = true;
        $uppercase = true;
    }

    if ($numbers) {
        $characters .= "0123456789";
    }

    if ($uppercase) {
        $characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    }

    if ($specialChars) {
        $characters .= "?!”@#$%^&*~|/<>[]()";
    }

    $password = "";

    for ($i = 0; $i < $length; $i++) {
        if ($apple && $i == 6 || $i == 12) {
            $password .= "-";
        }
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $password;
}

function getFourChanData(): array
{
    $url = "https://a.4cdn.org/o/catalog.json";
    $opts = array(
        'http' => array(
            'method' => "GET",
            'header' => "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:128.0) Gecko/20100101 Firefox/128.0"
        )
    );

    $context = stream_context_create($opts);

    $data = file_get_contents($url, false, $context);

    logRequest($url);
    logHeaders($url);

    $json = json_decode($data, true);
    return $json[0]['threads'];
}

$dogImageUrl = getDogImage();
$newPassword = generatePassword();