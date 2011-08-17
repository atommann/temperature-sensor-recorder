<?php
    $refresh = 0;
    if (isset($_GET['refresh'])) {
       $refresh = 1;
    }

    echo "<html>\n";
    echo "<head>\n";
    if ($refresh == 1) {
       echo "<meta http-equiv=\"refresh\" content=\"5\">\n";
    }

    echo "</head>\n";
    echo "<body>\n";
    echo "<pre> <a href=/showrecords.php>[refresh history]</a> <a href=/beertemp.php>[back]</a></pre>\n";

    # output a history of temperatures
    echo "<pre>";
    echo "Temperature History\n";
    echo "Time                  Beer T  Ice T\n";

    # open file "history.txt" in 'rb' mode
    $fp = fopen("history.txt", 'rb');

    if ($fp) {
        while (!feof($fp)) {
            # read a line
            $record = fgets($fp, 999);
            echo $record;
        }
        # close file
        fclose($fp);
    }

    echo "</pre>";
    echo "</body>";
    echo "</html>";
?>
