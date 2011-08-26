<?php
    function makeurl($url, $refresh, $newest)
    {
        $args = array();
        if ($refresh) {
            $args["refresh"] = "";
        }
        if ($newest) {
            $args["newest"] = "";
        }
        $query = http_build_query($args);
        $return = $url . ($query != "" ? ("?" . $query) : "");
        if ($newest) {
            $return = $return . "#newest";
        }

        return $return;
    }

    function show_buttons($url, $refresh, $newest)
    {
        echo "<a href=\"" . makeurl($url, $refresh, $newest) . "\">[refresh]</a> ";
        if ($refresh) {
            echo "<a href=\"" . makeurl($url, FALSE, $newest) . "\">[stop auto-refresh]</a> ";
        } else {
            echo "<a href=\"" . makeurl($url, TRUE, $newest) . "\">[start auto-refresh]</a> ";
        }
        echo "<a href=\"javascript: history.go(-1)\">[back]</a> ";
        echo "<a href=\"" . makeurl($url, $refresh, FALSE) . "\">[oldest]</a> ";
        echo "<a href=\"" . makeurl($url, $refresh, TRUE) . "\">[newest]</a>";
        echo "<br>\n";
    }

    function show_history()
    {
        # output a history of temperatures
        echo "<pre>";
        echo "Temperature History\n";
        echo "Time                  Beer T  Ice T\n";

        # Pull the contents of the history file into an array
        $file_contents = file('history.txt');

        # Display the contents of the array in reverse order
        if ($file_contents) {
            for ($i = count($file_contents) - 1; $i >= 0; $i--) 
                echo htmlentities($file_contents[$i]);
        }

        echo "</pre>\n";
        echo "<br>\n";
    }

    $url = $_SERVER['SCRIPT_NAME'];

    $refresh = isset($_GET['refresh']);
    $newest = isset($_GET['newest']);

    echo "<html>\n";
    echo "<head>\n";
    if ($refresh == 1) {
       echo "<meta http-equiv=\"refresh\" content=\"30\">\n";
    }

    echo "<title>Brewing@Chaihuo: Beer temperatures</title>\n";
    echo "</head>\n";
    echo "<body>\n";

    show_buttons($url, $refresh, $newest);
    show_history();
    show_buttons($url, $refresh, $newest);

    echo "<a name=\"newest\">\n";
    echo "</body>\n";
    echo "</html>\n";
?>
