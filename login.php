<?php $thisPage="services";
session_start();

require_once "Dao.php";
$dao = new Dao();

$login_message = isset($_SESSION['login_message']) ? $_SESSION['login_message'] : '';
unset($_SESSION['login_message']);

?>

<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
    <link href="css/services.css" rel="stylesheet">
</head>
<?php require_once "header.php"; ?>
<body>
<div class="form_wrapper">
    <form action="login_handler.php" method="post">
        <div class="container">
            <label for="email">Email</label>
            <input type="text" name="email" id="email">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <?php if(!empty($login_message)) { ?>
                <div class="message"><?php echo $login_message; ?></div>
            <?php } ?>
            <button type="submit">Login</button>
        </div>
    </form>

    <div id="or">OR</div>

    <form action="signup_handler.php" method="post">
        <div class="container">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name"
                   value="<?php echo isset($_SESSION['presets']['first_name']) ? $_SESSION['presets']['first_name'] : '';?>">

            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name"
                   value="<?php echo isset($_SESSION['presets']['last_name']) ? $_SESSION['presets']['last_name'] : '';?>">

            <label for="email">Email</label>
            <input type="text" name="email" id="email"
                   value="<?php echo isset($_SESSION['presets']['email']) ? $_SESSION['presets']['email'] : '';?>">

            <label for="password">Password</label>
            <input type="password" name="password" id="password"
                   value="<?php echo isset($_SESSION['presets']['password']) ? $_SESSION['presets']['password'] : '';?>">

            <?php unset($_SESSION['presets']); ?>

            <?php if (isset($_SESSION['signup_message'])) {
                foreach ($_SESSION['signup_message'] as $signup_message) {?>
                    <div class="message <?php echo isset($_SESSION['validated']) ? $_SESSION['validated'] : '';?>">
                        <?php echo $signup_message; ?></div>
                <?php  }
                unset($_SESSION['signup_message']);
                ?> </div>
            <?php } ?>
            <button type="submit">Sign Up</button>
        </div>
    </form>
</div>
</body>
</html>
<?php require_once "footer.php"; ?>