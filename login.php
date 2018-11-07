<?php $thisPage="services";
session_start();

require_once "Dao.php";
$dao = new Dao();

$login_message = isset($_SESSION['login_message']) ? $_SESSION['login_message'] : '';
unset($_SESSION['login_message']);

//echo "<pre>" . print_r($_SESSION,1) . "</pre>";

?>

<html>
<?php require_once "header.php"; ?>
<body>
<div class="body_container form_wrapper">
    <form class="form" action="login_handler.php" method="post">
        <div class="form_container">
            <label for="email">Email</label>
            <input type="text" name="email" id="email">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <?php if(!empty($login_message)) { ?>
                <div class="message"><?php echo $login_message; ?></div>
            <?php } ?>
            <button class="form_button" type="submit">Login</button>
        </div>
    </form>

    <div id="or">OR</div>

    <form class="form" action="signup_handler.php" method="post">
        <div class="form_container">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name"
                   value="<?php echo isset($_SESSION['presets']['first_name']) ? $_SESSION['presets']['first_name'] : '';?>">

            <?php if (isset($_SESSION['signup_message']['first_name'])) {
                foreach ($_SESSION['signup_message']['first_name'] as $signup_message) {?>
                    <div class="message">
                        <?php echo $signup_message; ?></div>
                <?php  } ?>
            <?php } ?>

            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name"
                   value="<?php echo isset($_SESSION['presets']['last_name']) ? $_SESSION['presets']['last_name'] : '';?>">

            <?php if (isset($_SESSION['signup_message']['last_name'])) {
                foreach ($_SESSION['signup_message']['last_name'] as $signup_message) {?>
                    <div class="message">
                        <?php echo $signup_message; ?></div>
                <?php  } ?>
            <?php } ?>

            <label for="email">Email</label>
            <input type="email" name="email" id="email"
                   value="<?php echo isset($_SESSION['presets']['email']) ? $_SESSION['presets']['email'] : '';?>">

            <?php if (isset($_SESSION['signup_message']['email'])) {
                foreach ($_SESSION['signup_message']['email'] as $signup_message) {?>
                    <div class="message">
                        <?php echo $signup_message; ?></div>
                <?php  } ?>
            <?php } ?>

            <label for="password">Password</label>
            <input type="password" name="password" id="password"
                   value="<?php echo isset($_SESSION['presets']['password']) ? $_SESSION['presets']['password'] : '';?>">

            <?php if (isset($_SESSION['signup_message']['password'])) {
                foreach ($_SESSION['signup_message']['password'] as $signup_message) {?>
                    <div class="message">
                        <?php echo $signup_message; ?></div>
                <?php  } ?>
            <?php } ?>

            <label for="verifyPassword">Verify Password</label>
            <input type="password" name="verifyPassword" id="verifyPassword"
                   value="<?php echo isset($_SESSION['presets']['verifyPassword']) ? $_SESSION['presets']['verifyPassword'] : '';?>">


            <?php if (isset($_SESSION['signup_message']['verifyPassword'])) {
                foreach ($_SESSION['signup_message']['verifyPassword'] as $signup_message) {?>
                    <div class="message">
                        <?php echo $signup_message; ?>
                    </div>
                <?php  } ?>
            <?php } ?>

            <?php unset($_SESSION['presets']);
                  unset($_SESSION['signup_message']);?>

            <button class="form_button" type="submit">Sign Up</button>
        </div>
    </form>
</div>
</body>
</html>
<?php require_once "footer.php"; ?>