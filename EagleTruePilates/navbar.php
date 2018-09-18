<html>
<body>
<div class="nav-bar">
    <ul>
        <li><a <?php if ($thisPage=="home") echo " id=\"currentpage\""; ?> href="home.php">home</a></li>
        <li><a <?php if ($thisPage=="services") echo " id=\"currentpage\""; ?> href="services.php">services</a></li>
        <li><a <?php if ($thisPage=="about") echo " id=\"currentpage\""; ?> href="about.php">about</a></li>
        <li><a <?php if ($thisPage=="contact") echo " id=\"currentpage\""; ?> href="contact.php">contact</a></li>
    </ul>
</div>
</html>