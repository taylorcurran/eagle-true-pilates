<html>
<body>
<div class="nav-bar">
    <ul>
        <li><a <?php if ($thisPage=="index") echo " id=\"currentpage\""; ?> href="index.php">home</a></li>
        <li>
            <div class="dropdown">
                <button onclick="myFunction()" class="dropbtn" <?php if ($thisPage=="services") echo " id=\"currentpage\""; ?>>services</button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="#">Link 1</a>
                    <a href="schedule.php">schedule</a>
                </div>
            </div>
        </li>
        <li><a <?php if ($thisPage=="about") echo " id=\"currentpage\""; ?> href="about.php">about</a></li>
        <li><a <?php if ($thisPage=="contact") echo " id=\"currentpage\""; ?> href="contact.php">contact</a></li>
    </ul>
</div>
</html>

<script>

</script>