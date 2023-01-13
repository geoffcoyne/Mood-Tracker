<html>
    <head>
        <title>Mood Tracker</title>
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="mainContent">
            <div class="content">
                <form action="./action.php" method="post">
                    <input type = "date" id="date" name="date" value="<?php date_default_timezone_set("America/New_York"); echo date('Y-m-d');?>">
                    <button type = "submit" value = "3" name = "mood">:D</button>
                    <button type = "submit" value = "2" name = "mood">:)</button>
                    <button type = "submit" value = "1" name = "mood">:|</button>
                    <button type = "submit" value = "0" name = "mood">:(</button>
                </form>
            </div>
            <div class="content">
                <a href="/table.php">
                    <div class="link">
                        View Table
                    </div>
                </a>
            </div> 
        </div>
    </body>
</html>