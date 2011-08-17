<?php
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
?>
