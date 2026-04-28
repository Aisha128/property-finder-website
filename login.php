<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["username"])) {
    if (isset($_GET["redirect"]) && $_GET["redirect"] != "") {
        header("Location: " . $_GET["redirect"]);
    } else {
        header("Location: index.php");
    }
    exit();
}

$error = "";
$redirect = isset($_GET["redirect"]) ? $_GET["redirect"] : "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $redirect = isset($_POST["redirect"]) ? $_POST["redirect"] : "";

    $data = file_get_contents("data/users.json");
    $users = json_decode($data, true);

    $validUser = false;

    foreach ($users as $user) {
        if ($user["username"] == $username && $user["password"] == $password) {
            $validUser = true;
            break;
        }
    }

    if ($validUser) {
        $_SESSION["username"] = $username;

        if ($redirect != "") {
            header("Location: " . $redirect);
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<?php include 'includes/header.php'; ?>

<main>
    <div class="login-box">
        <h2>Login</h2>

        <?php if ($error != ""): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="post" action="login.php<?php echo $redirect != '' ? '?redirect=' . urlencode($redirect) : ''; ?>">
            <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect); ?>">

            <label for="username">Username:</label><br>
            <input type="text" name="username" id="username" required><br><br>

            <label for="password">Password:</label><br>
            <input type="password" name="password" id="password" required><br><br>

            <button type="submit">Login</button>
        </form>
    </div>
</main>

<?php include 'includes/footer.php'; ?>