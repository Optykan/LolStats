<html lang="en-US">

    <head>
        <meta charset="UTF-8">
		<link href='http://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">
        
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
       <?php
            $key = "b0cc9773-08ca-4a5b-8d05-f767de88fcc3";

            $name = $_POST['inputname'];
            $name = preg_replace('/\s+/', '', $name);
            $name = strtolower($name);

            //https://na.api.pvp.net/api/lol/na/v1.4/summoner/by-name/netfx?api_key=b0cc9773-08ca-4a5b-8d05-f767de88fcc3

            $jsonurl = "https://na.api.pvp.net/api/lol/na/v1.4/summoner/by-name/".$name."?api_key=".$key;
            
            $json = file_get_contents($jsonurl);
            $data = json_decode($json, true);

            $id = $data[$name]['id'];

            $currentmatchjson = "https://na.api.pvp.net/observer-mode/rest/consumer/getSpectatorGameInfo/NA1/".$id."?api_key=".$key;

            $matchdata = file_get_contents($currentmatchjson);
            $match = json_decode($matchdata, true);

            $mapId = $match['mapId'];
            $gameQueue = $match['gameQueueConfigId'];

            $time = $match['gameLength'];

            if($gameQueue == 2 || $gameQueue == 31 || $gameQueue == 32 || $gameQueue == 7 || $gameQueue == 33 || $gameQueue == 14 || $gameQueue == 16 || $gameQueue == 17 || $gameQueue == 25 || $gameQueue == 4 || $gameQueue == 6 || $gameQueue == 42 || $gameQueue == 61 || $gameQueue == 65 || $gameQueue == 70 || $gameQueue == 76 || $gameQueue == 83 || $gameQueue == 91 || $gameQueue == 92 || $gameQueue == 93 || $gameQueue == 96 || $gameQueue == 300 || $gameQueue == 310){
                $players = 10;
                $ppteam = 5;
            }
            else if($gameQueue == 8 || $gameQueue == 9 || $gameQueue == 41 || $gameQueue == 52){
                $players=6;
                $ppteam=3;
            }
            else if($gameQueue == 72){
                $players=2;
                $ppteam=1;
            }
            else if($gameQueue == 73){
                $players=4;
                $ppteam=2;
            }
                
            if($gameQueue == 0){
               $gameType = 'Custom';
            }
            else if($gameQueue == 2 || $gameQueue == 14 || $gameQueue == 16 || $gameQueue == 17 || $gameQueue == 65 || $gameQueue == 61 || $gameQueue == 70  || $gameQueue == 76  || $gameQueue == 96 || $gameQueue == 300 || $gameQueue == 310){
                $gameType = '5 vs 5 Unranked';
            }
            else if($gameQueue == 7  || $gameQueue == 25 || $gameQueue == 31 || $gameQueue == 32 || $gameQueue == 33  || $gameQueue == 83 || $gameQueue == 91 || $gameQueue == 92 || $gameQueue == 93){
                $gameType = '5 vs 5 AI';
            }
            else if($gameQueue == 8){
                $gameType = '3 vs 3 Unranked';
            }
            else if($gameQueue == 4 || $gameQueue == 6 || $gameQueue == 42){
                $gameType = '5 vs 5 Ranked';
            }
            else if($gameQueue == 9){
                $gameType = '3 vs 3 Ranked';
            }
            else if($gameQueue == 52){
                $gameType = '3 vs 3 AI';
            }
            else if($gameQueue == 72){
                $gameType = '1 vs 1';
            }
            else if($gameQueue == 73){
                $gameType = '2 vs 2';
            }
            else{
                $gameType = 'Map Undefined';
            }


              
 
            for($i=1; $i<=$players; $i++){
                ${"summoner" . $i} = $match['participants'][$i-1]['summonerName'];
                ${"championId" . $i} = $match['participants'][$i-1]['championId'];

                $champnamejson = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion/".${"championId" . $i}."?champData=image&api_key=".$key;
                $champdata = file_get_contents($champnamejson);
                $champname = json_decode($champdata, true);

                ${"champion" . $i} = $champname['name'];
                ${"championimg" . $i} = $champname['image']['full'];
            }
            
        ?>
    </head>
    
    <body>
        <div class="container-fluid row">
            <!--<div class="col-md-3 col-md-offset-9 title">SUMMONER'S RIF<span style="padding-left:3px;"></span>T</div>-->
        </div>
        
        <div class="container-fluid row team1">
            <?php 
                for ($i=1; $i<=$ppteam; $i++){
                    echo "<div class='col-md-2 skew'>
                        <img src='assets/splash/${'championimg' . $i}'></img>
                        
                        <div class='name' onmouseenter='info($i,1);' onmouseout='($i,0);'>
                        <p class='ro champion'>${'champion'.$i}</p>
                        <p class='ro summoner'>${'summoner'.$i}</p>
                        </div>
                        <div class='dim' id='$i'></div>
                    </div>";
                }
            ?>
            <div class="col-md-2 title">
             <?php 
                    echo "<script>console.log('$mapId');</script>";
                        if($mapId == 11){
                            echo "SUMMONERS </br>RIF<span style='padding-left:3px;'></span>T";
                        }
                        else if($mapId == 12){
                            echo "HOWLING </br>ABYSS";
                        }
                        else if($mapId == 10){
                            echo "TWISTED </br>TREELINE";
                        }
                        else if($mapId == 8){
                            echo "THE CRYSTAL </br>SCAR";
                        }
                        else{
                            echo "SUMMONER NOT FOUND";
                        }
                ?>
                </br>
                <?php echo "<p class='gametype'>$gameType</p>";?>
            </div>
        
        </div>
        <div class="container-fluid row bans">
            <div class="banimg col-md-1">1</div>
            <div class="banimg col-md-1">2</div>
            <div class="banimg col-md-1">3</div>
            <div class="versus ro">VS</div>
            <div class="banimg col-md-1">4</div>
            <div class="banimg col-md-1">5</div>
            <div class="banimg col-md-1">6</div>
        </div>
        
        <div class="container-fluid row team2">
            <?php 
                for ($i=$ppteam+1; $i<=$players; $i++){
                    echo "<div class='col-md-2 skew2'>${'summoner'. $i}${'champion' . $i}<img src='assets/splash/${'championimg' . $i}'></img></div>";
                }
                echo gmdate("i:s", $time);
            ?>
            
        
        </div>
    <script> $.backstretch("bg.jpg");</script>
    <script>
        function info(splashid, i){
            console.log(splashid, i);
            if(i == 1){
                document.getElementById(splashid).style.marginTop="-375px;";
            }
            else{
                document.getElementById(splashid).style.marginTop="-120px;";
            }
        }
    </script>
    </body>
</html>
