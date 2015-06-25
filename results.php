        
        <?php

            //$myfile = fopen("api.key", "r") or die("404 File Not Found");
            $name = $_POST['inputname'];
            $jsonurl = "https://na.api.pvp.net/api/lol/na/v1.4/summoner/by-name/".$name."?api_key=b0cc9773-08ca-4a5b-8d05-f767de88fcc3";
            $json = file_get_contents($jsonurl);
            var_dump(json_decode($json));
            echo "<p id='idresult'>$json</p>";
        ?>
