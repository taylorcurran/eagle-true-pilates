<?php $thisPage="services";
session_start();

require_once "Dao.php";
$dao = new Dao();

$logged_in = isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : 'false';
$email = isset($_SESSION['presets']['email']) ? $_SESSION['presets']['email'] : 'no email';
$first_name = $dao->getFirstName($email)[0];
$last_name = $dao->getLastName($email)[0];
$user_id = $dao->getUserId($email)[0];
$isMember = $dao->isMember($user_id)[0];
$isInstructor = $dao->isInstructor($user_id)[0];
$isAdmin = $dao->isAdmin($user_id)[0];
$messages = $dao->getMessages();

?>
<html>
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel='stylesheet' href='css/schedule.css' />
    <link rel='stylesheet' href='css/fullcalendar.css' />
    <link href="css/fullcalendar.print.css" media="print" rel="stylesheet" />
    <script src='js/jquery-3.3.1.js'></script>
    <script src='js/moment.js'></script>
    <script src='js/fullcalendar.js'></script>

    <script>
        $(function() {
            // page is now ready, initialize the calendar...

            $('#calendar').fullCalendar({
            // put your options and callbacks here
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,list'
                },

                businessHours: {
                    // days of week. an array of zero-based day of week integers (0=Sunday)
                    dow: [ 1, 2, 3, 4, 5, 6], // Monday - Saturday

                    start: '10:00', // a start time (10am in this example)
                    end: '20:00' // an end time (8pm in this example)
                },

            })
        });
    </script>
</head>
<?php require_once "header.php"; ?>

<div class="body_container">

    <?php if(strcmp($logged_in, 'true') == 0) : ?>

        <div id="banner">
            <div id="hello_message">
                <p>Hello <?php echo $first_name?>!</p>
            </div>
            <button id="logout_button" class="login_button" onclick="location.href='logout.php'">
                Log Out <i id="login_icon" class="fas fa-sign-out-alt"></i></button>
        </div>

        <?php if($isMember) : ?>
            <div>
                <div>
                    <h3>Account Info</h3>
                    <p>Name: <?php echo $first_name," ", $last_name?></p>
                    <p>Email: <?php echo $email?></p>
                </div>
                <div>
                    <h3>Upcoming Classes</h3>
                    <p></p>
                </div>
            </div>
        <?php endif; ?>
        <?php if($isInstructor) : ?>
            <hr>
            <div>
                <div>
                    <h2>Instructor</h2>
                </div>
            </div>
        <?php endif; ?>
        <?php if($isAdmin) : ?>
            <hr>
            <div>
                <div>
                    <h2>Admin</h2>
                </div>
                <div>
                    <h3>Messages</h3>
                    <?php if($messages[0] != null) {
                        echo "<table>
                        <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Country</th>
                        <th>Message</th>
                        </tr>";

                        foreach ($messages as $message) {
                            echo "<tr><td>" . $message['first_name'] . "</td><td>" . $message['last_name']
                                . "</td><td>{$message['country']}</td><td>{$message['message']}</td><td>
                                <a href='delete_message.php?id={$message['id']}'/>
                                <i id='delete_icon' class=\"fas fa-trash-alt\"></i>
                                </a></td></tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p>no new messages</p>"; } ?>

                </div>
            </div>
        <?php endif; ?>
        <br>
    <?php else : ?>
    <div id="banner">
        <button class="login_button" onclick="location.href='login.php'">Log In <i id="login_icon" class="fas fa-sign-in-alt"></i></button>
    </div>
    <?php endif; ?>

    <div id='calendar'></div>
</div>

<?php require_once "footer.php";
unset($_SESSION['login_message']);
?>
</html>
