<html lang="en-US">

    <head>
        <meta charset="UTF-8">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
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
            $name = strtolower($name);

            $jsonurl = "https://na.api.pvp.net/api/lol/na/v1.4/summoner/by-name/".$name."?api_key=".$key;
            
            $json = file_get_contents($jsonurl);
            $data = json_decode($json, true);

            $id = $data[$name]['id'];

            $currentmatchjson = "https://na.api.pvp.net/observer-mode/rest/consumer/getSpectatorGameInfo/NA1/".$id."?api_key=".$key;

            $matchdata = file_get_contents($currentmatchjson);
            $match = json_decode($matchdata, true);
            
            for($i=1; $i<11; $i++){
                ${"summoner" . $i} = $match['participants'][$i-1]['summonerName'];
                ${"championId" . $i} = $match['participants'][$i-1]['championId'];
                
                $champnamejson = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion/".${"championId" . $i}."?champData=image&api_key=".$key;
                $champdata = file_get_contents($champnamejson);
                $champname = json_decode($champdata, true);
                
                ${"champion" . $i} = $champname['name'];
                ${"championimg" . $i} = $champname['image']['full'];
                echo $champion1;
                echo $championimg1;
            }
        ?>
    </head>
    
    <body>
        <div class="container-fluid row">
            <div class="col-md-3 col-md-offset-9 title">SUMMONERS RIF<span style="padding-left:3px;"></span>T</div>
        </div>
        
        <div class="container-fluid row team1">
            <div class="col-md-2 skew"><?=$summoner1?><?=$champion1?><img src="assets/<?=$championimg1?>"></img></div>
            <div class="col-md-2 skew"><?=$summoner2?><?=$champion2?><img src="assets/<?=$championimg2?>"></img></div>
            <div class="col-md-2 skew"><?=$summoner3?><?=$champion3?><img src="assets/<?=$championimg3?>"></img></div>
            <div class="col-md-2 skew"><?=$summoner4?><?=$champion4?><img src="assets/<?=$championimg4?>"></img></div>
            <div class="col-md-2 skew"><?=$summoner5?><?=$champion5?><img src="assets/<?=$championimg5?>"></img></div>
        
        </div>
            <div class="container-fluid row team2">
            <div class="col-md-2 skew"><?=$summoner6?><img src=""></img></div>
            <div class="col-md-2 skew"><?=$summoner7?></div>
            <div class="col-md-2 skew"><?=$summoner8?></div>
            <div class="col-md-2 skew"><?=$summoner9?></div>
            <div class="col-md-2 skew"><?=$summoner10?></div>
        
        </div>
    <script> $.backstretch("bg.jpg");</script>
    </body>
</html>
