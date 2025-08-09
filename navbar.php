<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>

</head>
<body>

<nav class="navbar">
    <div class="navbar-left">Goko</div>
    <div class="navbar-right">
        <a href="index.php">News</a>
        <a href="#">Projects</a>
        <a href="about.php">About</a>
        <div class="theme-toggle light" id="themeToggle">
            <div class="toggle-thumb"></div>
            <div class="icon sun-icon"><i class="bi bi-sun"></i></div>
            <div class="icon moon-icon"><i class="bi bi-moon"></i></div>


        </div>
    </div>
</nav>

</body>
<script>
    const toggle = document.getElementById("themeToggle");

    toggle.addEventListener("click", () => {
        toggle.classList.toggle("light");
        document.body.classList.toggle("light-theme");
    });
</script>

</html>

