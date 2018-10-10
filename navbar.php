<html>
<body>
<div class="nav-bar">
    <ul>
        <li><a <?php if ($thisPage=="index") echo " id=\"currentpage\""; ?> href="index.php">home</a></li>
        <li>
            <div class="dropdown">
                <button class="dropbtn" <?php if ($thisPage=="services") echo " id=\"currentpage\""; ?>>services
                    <i id="arrow" class="fas fa-chevron-down fa-xs"></i>
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="classes.php">classes</a>
                    <a href="schedule.php">schedule</a>
                </div>
            </div>
        </li>
        <li><a <?php if ($thisPage=="about") echo " id=\"currentpage\""; ?> href="about.php">about</a></li>
        <li><a <?php if ($thisPage=="contact") echo " id=\"currentpage\""; ?> href="contact.php">contact</a></li>
    </ul>
</div>
</html>
