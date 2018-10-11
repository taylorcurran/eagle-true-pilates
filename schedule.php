<?php $thisPage="services";
session_start();

require_once "Dao.php";
$dao = new Dao();

$logged_in = isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : 'false';

$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'no email';

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

<?php if($logged_in == 'true') {
    $user = $dao->getUser($email);
    echo $user;
    ?>
    <div>
        <p>Hello <?php echo $first_name?>!</p>
    </div>
    <? } else { ?>

<?php } ?>


<div id="login_button">
    <form action="login.php">
        <input type="submit" value="Log In"/>
    </form>
</div>

<div id='calendar'></div>


<?php require_once "footer.php"; ?>
</html>
