<?php $thisPage="services";

require_once "Dao.php";
$dao = new Dao();

session_start();

if (isset($_SESSION["access_granted"]) && $_SESSION["access_granted"]) {
header("Location:granted.php");
}

$email = "";
if (isset($_SESSION["email_preset"])) {
$email = $_SESSION["email_preset"];
}
?>

<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
    <link href="css/services.css" rel="stylesheet">
</head>
<?php require_once "header.php"; ?>

<div>
<!--    --><?php
/*    if (isset($_SESSION["status"])) {
        echo "<div id="status">" .  $_SESSION["status"] . "</div>";
      unset($_SESSION["status"]);
    }
    */?>
    <form action="login_handler.php" method="post">
        <div class="container">
            <label for="email"><b>Email</b></label>
            <input type="text" name="email" id="email" value="<?php echo $email; ?>" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <button type="submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" class="cancelbtn">Cancel</button>
        </div>
    </form>
</div>
<div>
    <?php
    $user = $dao->getUser($email);
    echo $user
    ?>
</div>

<?php require_once "footer.php"; ?>
</html>