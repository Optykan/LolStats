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

            if($mapId = 8 or 11 or 12){
                for($i=1; $i<11; $i++){
                    ${"summoner" . $i} = $match['participants'][$i-1]['summonerName'];
                    ${"championId" . $i} = $match['participants'][$i-1]['championId'];

                    $champnamejson = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion/".${"championId" . $i}."?champData=image&api_key=".$key;
                    $champdata = file_get_contents($champnamejson);
                    $champname = json_decode($champdata, true);

                    ${"champion" . $i} = $champname['name'];
                    ${"championimg" . $i} = $champname['image']['full'];
                }
            }
        ?>
    </head>
    
    <body>
        <div class="container-fluid row">
            <!--<div class="col-md-3 col-md-offset-9 title">SUMMONER'S RIF<span style="padding-left:3px;"></span>T</div>-->
        </div>
        
        <div class="container-fluid row team1">
            <div class="col-md-2 skew"><?=$summoner1?><?=$champion1?><img src="assets/<?=$championimg1?>"></img></img></div>
            <div class="col-md-2 skew"><?=$summoner2?><?=$champion2?><img src="assets/<?=$championimg2?>"></img></div>
            <div class="col-md-2 skew"><?=$summoner3?><?=$champion3?><img src="assets/<?=$championimg3?>"></img></div>
            <div class="col-md-2 skew"><?=$summoner4?><?=$champion4?><img src="assets/<?=$championimg4?>"></img></div>
            <div class="col-md-2 skew"><?=$summoner5?><?=$champion5?><img src="assets/<?=$championimg5?>"></img></div>
            <div class="col-md-2 title"><?php 
            echo '<script>console.log("$mapId);</script>';
                if($mapId = 11){
                    echo 'SUMMONER\'S </br>RIF<span style="padding-left:3px;"></span>T';
                }
                else if($mapId = 12){
                    echo 'HOWLING </br>ABYSS';
                }
                else if($mapId = 10){
                    echo 'TWISTED </br>TREELINE';
                }
                else if($mapId = 8){
                    echo 'THE CRYSTAL </br>SCAR';
                }
                else{
                    echo 'MAP UNDEFINED';
                }
                ?>
            </div>
        
        </div>
        <div class="versus ro">VS</div>
        <div class="container-fluid row team2">
            <div class="col-md-2 skew2"><?=$summoner6?><img src="assets/<?=$championimg6?>"></img></img></div>
            <div class="col-md-2 skew2"><?=$summoner7?><img src="assets/<?=$championimg7?>"></img></div>
            <div class="col-md-2 skew2"><?=$summoner8?><img src="assets/<?=$championimg8?>"></img></div>
            <div class="col-md-2 skew2"><?=$summoner9?><img src="assets/<?=$championimg9?>"></img></div>
            <div class="col-md-2 skew2"><?=$summoner10?><img src="assets/<?=$championimg10?>"></img></div>
        
        </div>
    <script> $.backstretch("bg.jpg");</script>
    </body>
</html>
