<!DOCTYPE html>
<body>
    <?php
        $firstname = "";
        $key = "";
        $array = array();
        $isSuccess = false;

        $handle = fopen("data.txt", "r");
        if ($handle) {
            $i=0;
            while (($line=fgets($handle)) !== false) {
                $data = explode(",", $line);
                $array[$i] = array (
                    1 => $data[0],
                    2 => $data[1],
                    3 => $data[2],
                    4 => $data[3]
                );
                $i++;
            }
            fclose($handle);
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET['firstname']) && isset($_GET['key'])) {
                $firstname = $_GET['firstname'];
                $key = $_GET['key'];
            }
        }
        else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['firstname']) && isset($_POST['key'])) {
                $firstname = $_POST['firstname'];
                $key = $_POST['key'];
            }
        }
        
        for ($i = 0; $i < count($array); $i++) {
            if (strcmp(strtolower($key), strtolower($array[$i][1])) == 0) {
                if (strcmp(strtolower($firstname), strtolower($array[$i][2])) == 0) {
                    echo "<h1>".$array[$i][2]."'s Coffee Choice</h1>";
                    echo "<figure><img src=\"".$array[$i][4]."\" alt=\"Coffee\">";
                    echo "<figcaption>".$array[$i][3]."</figcaption></figure>";
                    $isSuccess = true;
                }
            }
        }
        if (!$isSuccess) {
            echo "<p>The user and/or key is invalid or not provided.</p>";
        }
    ?>
</body>