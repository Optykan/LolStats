<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
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
        //$key = readfile("api.txt");
        
            $ver="v0.118a";
            
            
            $key = "b0cc9773-08ca-4a5b-8d05-f767de88fcc3";
			$key2 = "ad5dd762-64f7-424f-8d53-181211bbe833";


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

            $githuburl = "https://api.github.com/repos/Optykan/LolStats/commits?access_token=8bb2c4af9f0fbc0392bdd18ebbc4a8a884d88f9b";
            $githubjson = file_get_contents($githuburl);
            $commitdata = json_decode($githubjson, true);

            echo "<script>console.log('$commitdata')</script>";

            $commit = $commitdata[0]['commit']['author']['date'];

            echo "<script>console.log('$commit')</script>";

            list($commitdate,$committime) = explode("T",$commit);
            $commitformattime = preg_replace("Z","",$committime);
            echo "<script>console.log('$committime')</script>";
            echo "<script>console.log('$commitformattime')</script>";
            
            


/*
            function pg_connection_string(){
                return "dbname=d39lujf7bsqfo4 host=ec2-54-227-249-165.compute-1.amazonaws.com port=5432 user=atsokaxrphxmkf password=bGCIwgCw-MfVEI-4dIoSvMr0_A sslmode=require";
            }
            $db = pg_connect(pg_connection_string());
            $result = pg_query($db, "SELECT statement goes here");
*/

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
            else if($gameQueue == 2 || $gameQueue == 16 || $gameQueue == 17 || $gameQueue == 65 || $gameQueue == 61 || $gameQueue == 70  || $gameQueue == 76  || $gameQueue == 96 || $gameQueue == 300 || $gameQueue == 310){
                $gameType = '5 vs 5 Unranked';
            }
            else if($gameQueue == 14){
                $gameType = '5 vs 5 Draft';
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
            else if($gameQueue == 9 || $gameQueue == 41){
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


            $versusmargin = ($ppteam/2)*190+50;
 
            for($i=1; $i<=$players; $i++){
                ${"summoner" . $i} = $match['participants'][$i-1]['summonerName'];
                ${"championId" . $i} = $match['participants'][$i-1]['championId'];

                $champnamejson = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion/".${"championId" . $i}."?champData=image&api_key=".$key;
                $champdata = file_get_contents($champnamejson);
                $champname = json_decode($champdata, true);

                ${"champion" . $i} = $champname['name'];
                ${"championimg" . $i} = $champname['image']['full'];
            }
            
            for($i=1; $i<=6; $i++){
                ${"ban".$i} = $match['bannedChampions'][$i-1]['championId'];
                
                $champnamejson = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion/".${"ban" . $i}."?champData=image&api_key=".$key;
                $champdata = file_get_contents($champnamejson);
                $champname = json_decode($champdata, true);
                
                ${"banimg" . $i} = $champname['image']['full'];
                
            }
            
        ?>
        <title>Current Game Info for: <?=$name?></title>
    </head>
    
    <body>
        <div class="ro version"><?=$ver?></div>
        <div class="container-fluid row" >
            <!--<div class="col-md-3 col-md-offset-9 title">SUMMONER'S RIF<span style="padding-left:3px;"></span>T</div>-->
        </div>
        <div class="container-fluid row resultshead" style="padding-left:auto; padding-right:auto;">
            <div class="col-md-5 title">
                 <?php 
                            if($mapId == 11){
                                echo "SUMMONERS RIF<span style='padding-left:3px'></span>T";
                            }
                            else if($mapId == 12){
                                echo "HOWLING ABYSS";
                            }
                            else if($mapId == 10){
                                echo "TWISTED TREELINE";
                            }
                            else if($mapId == 8){
                                echo "THE CRYSTAL SCAR";
                            }
                            else{
                                echo "SUMMONER NOT FOUND";
                            }
                    ?>
            </div>
            <div class="col-md-2">
                <p class="ro time" id="time"></p>
            </div>
            <div class="col-md-5 gametype"><?=$gameType?></div>
        </div>

        
        <div class="container row team">
            <?php 
                for ($i=1; $i<=$ppteam; $i++){
                    echo "<div class='col-md-2 champimg'>
                        <img src='assets/splash/${'championimg' . $i}'></img>
                        
                        <div class='name' onmouseover='info($i,1)' onmouseout='info($i,0)'>
                        <p class='ro champion'>${'champion'.$i}</p>
                        <p class='ro summoner'>${'summoner'.$i}</p>
                        </div>
                        <div class='dim' id='$i' onmouseover='info($i,1)' onmouseout='info($i,0)'></div>
                    </div>";
                }
            ?>
            <div class="col-md-2">
                <div class="container-fluid bans">
                        <?php 

                        for($i=1;$i<=3;$i++){
                            if(isset(${'banimg'.$i})){
                                 echo "<div class='row'><img class='banimg' src='assets/square/${'banimg'.$i}'></img></div>";
                            }
                           
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="container-fluid row">
            <center><div class='versus ro'>VS</div></center>
        </div>
        
        <div class="container row team">
            <?php 
                for ($i=$ppteam+1; $i<=$players; $i++){
                    echo "<div class='col-md-2 champimg'>
                        <img src='assets/splash/${'championimg' . $i}'></img>
                        
                        <div class='name' onmouseover='info($i,1)' onmouseout='info($i,0)'>
                        <p class='ro champion'>${'champion'.$i}</p>
                        <p class='ro summoner'>${'summoner'.$i}</p>
                        </div>
                        <div class='dim' id='$i' onmouseover='info($i,1)' onmouseout='info($i,0)'></div>
                    </div>";
                }
                
               
            ?>
            <div class="col-md-2">
                <div class="container-fluid bans">
                        <?php 
                        for($i=4;$i<=6;$i++){
                            if(isset(${'banimg'.$i})){
                                 echo "<div class='row'><img class='banimg' src='assets/square/${'banimg'.$i}'></img></div>";
                            }
                        }
                    ?>
                </div>
            </div>
            
        
        </div>
            <?php 
        echo "<script>
                var time=$time;
                time=time+180;
                    setInterval(function(){
                    document.getElementById('time').innerHTML=SecondsToHMS(time);
                    time=time+1;
                    },1000);
            </script>";
        ?>

    <script>
     function SecondsToHMS(d) {
        d = Number(d);
        var m = Math.floor(d % 3600 / 60);
        var s = Math.floor(d % 3600 % 60);
        var min = format(m);
        var sec = format(s);
        val = min + ':' + sec;
        return val;
        }

        function format(num)
        {
        if (num > 0){
           if (num >= 10)
             val = num;
            else
             val = '0' + num;
        }
        else
          val = '00';

        return val;
        }
    </script>
    <script> $.backstretch("assets/bg.jpg");</script>
<!--    <script>
        function info(splashid, i){
            if(i===1){
                console.log(i);
                document.getElementById(splashid).style.marginTop = "-380px";
            }
            else{
                console.log('out');
                document.getElementById(splashid).style.marginTop = "-120px";
            }
        }
    </script>-->
    </body>
</html>
