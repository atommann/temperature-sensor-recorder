<?php
    function show_buttons($refresh)
    {
        $url = $_SERVER['REQUEST_URI'];

        echo "<a href=\"{$url}\">[refresh]</a> ";
        if ($refresh == 1) {
            $url = preg_replace('/\?refresh$/', '', $url);
            echo "<a href=\"{$url}\">[stop auto-refresh]</a> ";
        } else {
            echo "<a href=\"{$url}?refresh\">[start auto-refresh]</a>\n";
        }
        echo "<a href=/beertemp.php>[back]</a>";
        echo "<br>\n";
    }

    function show_history()
    {
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
        echo "<br>\n";
    }

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

    show_buttons($refresh);
    show_history();
    show_buttons($refresh);

    echo "<a name=\"latest\">\n";
    echo "</pre>\n";
    echo "</body>\n";
    echo "</html>\n";
?>
