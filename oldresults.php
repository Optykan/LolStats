<html>
    <head>
      <?php

            //$myfile = fopen("api.key", "r") or die("404 File Not Found");
            //<?=$variable endquote> for cheaty variable output
            //VERY HELPFUL HERE http://jsonformatter.curiousconcept.com/
            //BUG - CAPS DO NOT REGISTER WITH THE API
            $name = $_POST['inputname'];
            $name = strtolower($name);
            $jsonurl = "https://na.api.pvp.net/api/lol/na/v1.4/summoner/by-name/".$name."?api_key=b0cc9773-08ca-4a5b-8d05-f767de88fcc3";
            $json = file_get_contents($jsonurl);
            $data = json_decode($json, true);
            $id = $data[$name]['id'];
            $level = $data[$name]['summonerLevel'];
            if(isset($id)){
                echo $id."</br>";
                echo $level;
                echo "<script> console.log($id)</script>";
                echo "<script> console.log($level)</script>";
            }
            else{
                echo "Summoner not found";   
           
            }
        ?>
    </head>
    
    <body>

    </body>
</html>
