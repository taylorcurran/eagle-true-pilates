<?php $thisPage="services";
session_start();

require_once "Dao.php";
$dao = new Dao();

try {
    $logged_in = isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : 'false';
    $email = isset($_SESSION['presets']['email']) ? $_SESSION['presets']['email'] : 'no email';
    $first_name = $dao->getFirstName($email)[0];
    $last_name = $dao->getLastName($email)[0];
    $user_id = $dao->getUserId($email)[0];
    $isMember = $dao->isMember($user_id)[0];
    $isInstructor = $dao->isInstructor($user_id)[0];
    $isAdmin = $dao->isAdmin($user_id)[0];
    $messages = $dao->getMessages();
    $classes = $dao->getClasses();

    echo $logged_in . " " . $email;
} catch(Exception $e) {
    echo "<h2>Oops, Something went wrong!</h2>>";
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>
<html>
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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

                    start: '9:00', // a start time (9am in this example)
                    end: '20:00' // an end time (8pm in this example)
                },

                events: [
                    {
                        title  : 'event1',
                        start  : '2018-10-18'
                    },
                    {
                        title  : 'event2',
                        start  : '2018-10-05',
                        end    : '2018-10-07',
                        color  :  'red',
                    },
                    {
                        title  : 'event3',
                        start  : '2018-10-09T12:30:00',
                        allDay : false // will make the time show
                    },

                    <?php if($classes[0] != null) {
                        foreach ($classes as $class) { ?>
                            {
                                title  : '<?php echo $class['class_name']; ?>',
                                start  : '<?php echo $class['start'];?>',
                                end    : '<?php echo $class['end']?>',
                                allDay : false
                            }
                    <?php } } ?>
                ]
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
            <h2>Instructor</h2>
            <div>
                <h3>Schedule A Class</h3>
                <form class="form" action="schedule_handler.php" method="post">
                    <div class="form_container">
                        <input type="hidden" id="instructor_id" name="instructor_id" value="<?php echo $user_id; ?>">

                        <label for="class_name">Class Name</label>
                        <select class="custom-select" name="class_name" id="class_name">
                            <?php foreach ($dao->getClassNames() as $className) : ?>
                                <option><?php echo $className[0] ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label for="date">Date</label>
                        <input type="date" name="date" id="date"
                               value="<?php echo isset($_SESSION['presets']['date']) ? $_SESSION['presets']['date'] : '';?>">

                        <label for="start_time">Start Time</label>
                        <input type="time" name="start_time" id="start_time"
                               value="<?php echo isset($_SESSION['presets']['start_time']) ? $_SESSION['presets']['start_time'] : '';?>">

                        <label for="length">Length</label>
                        <select class="custom-select" name="length" id="length">
                            <option>30 mins</option>
                            <option>40 mins</option>
                            <option selected="selected">60 mins</option>
                        </select>

                        <label for="max_occupancy">Max Occupancy</label>
                        <input type="number" name="max_occupancy" id="max_occupancy"
                               value="<?php echo isset($_SESSION['presets']['max_occupancy']) ? $_SESSION['presets']['max_occupancy'] : '';?>">

                        <?php if (isset($_SESSION['schedule_message'])) : ?>
                            <?php foreach ($_SESSION['schedule_message'] as $signup_message) : ?>
                                <div class="message <?php echo isset($_SESSION['validated']) ? $_SESSION['validated'] : '';?>">
                                    <?php echo $signup_message; ?></div>
                            <?php endforeach; ?>
                            <?php unset($_SESSION['schedule_message']); ?>
                         <?php endif; ?>
                        <button class="form_button" type="submit">Schedule</button>
                    </div>
                </form>
            </div>
            <div>
                <h3>Upcoming Classes</h3>
                <?php
                $instructor_classes = $dao->getInstructorClasses($user_id);
                if($instructor_classes[0] != null) {
                    echo "<table><tr>
                            <th>Class Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Max Occupancy</th>
                            <th>Occupancy</th>
                            </tr>";
                    foreach ($instructor_classes as $class) {
                        echo "<tr><td>" . $class['class_name'] . "</td><td>" . $class['start']
                            . "</td><td>{$class['end']}</td><td>{$class['max_occupancy']}</td><td>
                            {$class['occupancy']}</td></tr>";
                    }
                    echo "<table>";
                } else { echo "<p>No scheduled classes</p>"; } ?>
            </div>
        <?php else : ?>
            <form id="link_form" action="instructor_handler.php" method="post">
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
                <button id="link" type="submit">click here to become an instructor!</button>
            </form>
        <?php endif; ?>
        <?php if($isAdmin) : ?>
            <h2>Admin</h2>
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
                } else { echo "<p>no new messages</p>"; } ?>
            </div>
        <?php else : ?>
            <form id="link_form" action="admin_handler.php" method="post">
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
                <button id="link" type="submit">click here to become an administrator!</button>
            </form>
        <?php endif; ?>
    <?php else : ?>
    <div id="banner">
        <button class="login_button" onclick="location.href='login.php'">Log In
            <i id="login_icon" class="fas fa-sign-in-alt"></i></button>
    </div>
    <?php endif; ?>

    <div id='calendar'></div>
</div>

<?php require_once "footer.php"; ?>
</html>
