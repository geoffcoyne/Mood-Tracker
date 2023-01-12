<?php
    function downloadAsCSV(){
        date_default_timezone_set("America/New_York");

        $dbname = 'moodDatabase';
        $tablename = 'mood';
        $username = 'YOUR POSTGRES USERNAME HERE';
        $password = "YOUR PASSWORD HERE";

        $conn = pg_connect("host=localhost dbname=" . $dbname . " user=" . $username . " password=" . $password) or die('Could not connect: ' . pg_last_error());
        $table = pg_query($conn, "SELECT * FROM " . $tablename . " ORDER BY date ASC");
        $fileName = "MoodData-" . date('m-d-Y') . ".csv";

        $csvfile = fopen($fileName, 'w');
                    
        $i=0;
        $fields=array();
        while ($i < pg_num_fields($table)) {
            $fieldName = pg_field_name($table, $i);
            array_push($fields, $fieldName);
            $i = $i + 1;
        }

        $i = 0;
        fputcsv($csvfile, $fields);
        while($row = pg_fetch_row($table)){
            fputcsv($csvfile, $row);
        }
        pg_close($conn);
        
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename=' . $fileName);
        header('Pragma: no-cache');
        readfile($fileName);
        fclose($csvfile);
        unlink('./' . $fileName);
        exit();
    } 
    if (array_key_exists('f', $_GET) and function_exists($_GET['f']) and $_GET['f'] == "downloadAsCSV"){
       $_GET['f']();
    }
?>
<html>
    <head>
        <title>Table - Mood Tracker</title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="mainContent">
            <div class="content">
                <div class="tablediv">
                    <table>
                        <?php
                            $dbname = 'moodDatabase';
                            $tablename = 'mood';
                            $username = 'YOUR POSTGRES USERNAME HERE';
                            $password = "YOUR PASSWORD HERE";
                            date_default_timezone_set("America/New_York");

                            $conn = pg_connect("host=localhost dbname=" . $dbname . " user=" . $username . " password=" . $password) or die('Could not connect: ' . pg_last_error());

                            $table = pg_query($conn, "SELECT * FROM " . $tablename . " ORDER BY date ASC");
                            $i = 0;
                            echo"<tr><th>#</th>";
                            while ($i < pg_num_fields($table)) {
                            	$fieldName = pg_field_name($table, $i);
                            	echo '<th>' . $fieldName . '</th>';
                            	$i = $i + 1;
                            }
                            $i = 1;
                            echo "</tr>";
                            while($row = pg_fetch_row($table)) {
                                echo "<tr><td>" . $i . "</td>";
                                foreach($row as $value){
                                    echo "<td>" . $value . "</td>";
                                }
                                echo "</tr>";
                                $i = $i+1;
                            }
                            pg_close($conn);
                        ?>
                    </table>
                </div>
            </div>
            <div class="content">
                <a href="table.php?f=downloadAsCSV">
                    <div class="link">
                        Download Table as a CSV file
                    </div>
                </a>
                <a href = "/">
                    <div class="link">
                        Return to Form
                    </div>
                </a>
            </div>
        </div>
    </body>
</html>