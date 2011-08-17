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

    $url = $_SERVER['REQUEST_URI'];
    echo "</head>\n";
    echo "<body>\n";
    echo "<a href=\"{$url}\">[refresh]</a> ";
	if ($refresh == 1) {
        $url = preg_replace('/\?refresh$/', '', $url);
        echo "<a href=\"{$url}\">[stop auto-refresh]</a> ";
	} else {
        echo "<a href=\"{$url}?refresh\">[start auto-refresh]</a>\n";
	}
    echo "<a href=/beertemp.php>[back]</a>";
    echo "<br>\n";


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
