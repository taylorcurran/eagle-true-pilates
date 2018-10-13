<?php $thisPage="services";
session_start();

require_once "Dao.php";
$dao = new Dao();

$logged_in = isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : 'false';
$email = isset($_SESSION['presets']['email']) ? $_SESSION['presets']['email'] : 'no email';
$first_name = $dao->getFirstName($email);
$last_name = $dao->getLastName($email);
$user_id = $dao->getUserId($email);

echo $user_id[0], " ";
echo $email, " ";

$memberId = $dao->getGroupMemberId()[0];
echo $memberId[0], " ";

$isMember = $dao->isMember($user_id[0]);

echo $isMember[0];

?>
<html>
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel='stylesheet' href='css/schedule.css' />
    <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
    <link href="fullcalendar/fullcalendar.print.css" media="print" rel="stylesheet" />
    <script src='lib/jquery-3.3.1.js'></script>
    <script src='lib/moment.js'></script>
    <script src='fullcalendar/fullcalendar.js'></script>

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
                <p>Hello <?php echo $first_name[0]?>!</p>
            </div>
            <div id="login_button">
                <form action="logout.php">
                    <button type="button">Sign Out</button>
                </form>
            </div>
        </div>

        <?php if($isMember) : ?>
            <div>
                <div>
                    <h3>Account Info</h3>
                    <p>Name: <?php echo $first_name[0]," ", $last_name[0]?></p>
                    <p>Email: <?php echo $email?></p>
                </div>
                <div>
                    <h3>Upcoming Classes</h3>
                    <p></p>
                </div>
            </div>
        <?php endif; ?>

    <?php else : ?>
    <div id="banner">

        <div id="login_button">
            <form action="login.php">
                <input type="submit" value="Log In"/>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <div id='calendar'></div>
</div>

<?php require_once "footer.php";
unset($_SESSION['login_message']);
?>
</html>
