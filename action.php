<html>
    <head>
        <title>Submitted</title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php      
            $ini = parse_ini_file('/etc/moodtrackerconf.ini');
            date_default_timezone_set("America/New_York");
            
            // connecting to the database
            $conn = pg_connect("host=localhost dbname=" . $ini['dbname'] . " user=" . $ini['username'] . " password=" . $ini['password']) or die('Could not connect: ' . pg_last_error());
    
            $mood = (int)$_POST["mood"];
            $date = $_POST["date"];
            if (!(is_int($mood))){
                $mood = 'error';
            }
            if($date == null){
                $date=date("Y-m-d");
            }

            $entry = array("mood"=>$mood, "date"=>$date);
            $sqlCheckDates = "SELECT date FROM " . $ini['tablename'] . " WHERE date = $1";
            $checkDates = pg_prepare($conn, 'checkDates', $sqlCheckDates);
            $checkDates = pg_execute($conn, 'checkDates', array($date));

            if($mood != "error" and pg_num_rows($checkDates) == 0){
                $insert = pg_prepare($conn, "insertQuery", "INSERT INTO " . $ini['tablename'] . " (mood, date) VALUES ($1 , $2)");
                $insert = pg_execute($conn, "insertQuery", array($mood, $date));
            }
            elseif($mood != "error"){
                $update = pg_prepare($conn, "updateQuery", "UPDATE " . $ini['tablename'] . " SET mood = $1 WHERE date = $2");
                $update = pg_execute($conn, "updateQuery", array($mood, $date));
            }
            pg_close($conn)
        ?>
        <div class="mainContent">
            <div class="confirmation">
                <h1 id="confirmed"><?php if ($mood != "error") {echo "Submitted!";} else {echo "Error with submission. Please try again.";} ?></h1>
                <a href = "/">
                    <div class="link">
                        Return to Form
                    </div>
                </a>
            </div>
        </div>
    </body>
</html>