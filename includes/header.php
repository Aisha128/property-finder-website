<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Find Your Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<audio id="bg-music" loop>
    <source src="music.mp4" type="audio/mp4">
</audio>

<button class="music-button" onclick="toggleMusic()">Play Music</button>

<script>
let isPlaying = false;

function toggleMusic() {
    const music = document.getElementById("bg-music");
    const button = document.querySelector(".music-button");

    if (!isPlaying) {
        music.play();
        isPlaying = true;
        button.innerText = "Pause Music";
    } else {
        music.pause();
        isPlaying = false;
        button.innerText = "Play Music";
    }
}
</script>

<header>
    <h1>Find Your Home</h1>

    <div class="user-box">
        <?php if (isset($_SESSION['username'])): ?>
            <span class="welcome-text">Welcome, <?php echo $_SESSION['username']; ?></span>
            <a href="logout.php" class="login-btn">Logout</a>
        <?php else: ?>
            <a href="login.php" class="login-btn">Login</a>
        <?php endif; ?>
    </div>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="aboutus.php">About Us</a>
    <a href="overview.php">Overview</a>
    <a href="ranking.php">Ranking</a>
    <a href="search.php">Search</a>
</nav>

<main>