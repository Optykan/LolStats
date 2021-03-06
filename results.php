<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html lang="en-US">

<head>
    <meta charset="UTF-8">

    <link href='http://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/switchery.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.6.6/jquery.fullPage.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.6.6/jquery.fullPage.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/switchery.js"></script>

    <?php
        //$key = readfile("api.txt");

            $ver="v0.134a";

            $stringrequest = NULL;

            $key = getenv('apikey');
			      $key2 = getenv('apikey2');

            $id= $_GET['id'];
            $name=$_GET['name'];

            $currentmatchjson = "https://na.api.pvp.net/observer-mode/rest/consumer/getSpectatorGameInfo/NA1/".$id."?api_key=".$key;

            $matchdata = file_get_contents($currentmatchjson);
            $match = json_decode($matchdata, true);

            if(strpos($http_response_header[0],'200') !== false){

                $mapId = $match['mapId'];
                $gameQueue = $match['gameQueueConfigId'];

                $time = $match['gameLength'];


    /*
                function pg_connection_string(){
                    return "dbname=d39lujf7bsqfo4 host=ec2-54-227-249-165.compute-1.amazonaws.com port=5432 user=atsokaxrphxmkf password=bGCIwgCw-MfVEI-4dIoSvMr0_A sslmode=require";
                }
                $db = pg_connect(pg_connection_string());
                $result = pg_query($db, "SELECT statement goes here");
    */

                if($gameQueue === 2 || $gameQueue === 31 || $gameQueue === 32 || $gameQueue === 7 || $gameQueue === 33 || $gameQueue === 14 || $gameQueue === 16 || $gameQueue === 17 || $gameQueue === 25 || $gameQueue === 4 || $gameQueue === 6 || $gameQueue === 42 || $gameQueue === 61 || $gameQueue === 65 || $gameQueue === 70 || $gameQueue === 76 || $gameQueue === 83 || $gameQueue === 91 || $gameQueue === 92 || $gameQueue === 93 || $gameQueue === 96 || $gameQueue === 300 || $gameQueue === 310){
                    $players = 10;
                    $ppteam = 5;
                }
                else if($gameQueue === 8 || $gameQueue === 9 || $gameQueue === 41 || $gameQueue === 52){
                    $players=6;
                    $ppteam=3;
                }
                else if($gameQueue === 72){
                    $players=2;
                    $ppteam=1;
                }
                else if($gameQueue === 73){
                    $players=4;
                    $ppteam=2;
                }

                if($gameQueue === 0){
                   $gameType = 'Custom';
                }
                else if($gameQueue === 2 || $gameQueue === 16 || $gameQueue === 17 || $gameQueue === 65 || $gameQueue === 61 || $gameQueue === 70  || $gameQueue === 76  || $gameQueue === 96 || $gameQueue === 300 || $gameQueue === 310){
                    $gameType = '5 vs 5 Unranked';
                }
                else if($gameQueue === 14){
                    $gameType = '5 vs 5 Draft';
                }
                else if($gameQueue === 7  || $gameQueue === 25 || $gameQueue === 31 || $gameQueue === 32 || $gameQueue === 33  || $gameQueue === 83 || $gameQueue === 91 || $gameQueue === 92 || $gameQueue === 93){
                    $gameType = '5 vs 5 AI';
                }
                else if($gameQueue === 8){
                    $gameType = '3 vs 3 Unranked';
                }
                else if($gameQueue === 4 || $gameQueue === 6 || $gameQueue === 42){
                    $gameType = '5 vs 5 Ranked';
                }
                else if($gameQueue === 9 || $gameQueue === 41){
                    $gameType = '3 vs 3 Ranked';
                }
                else if($gameQueue === 52){
                    $gameType = '3 vs 3 AI';
                }
                else if($gameQueue === 72){
                    $gameType = '1 vs 1';
                }
                else if($gameQueue === 73){
                    $gameType = '2 vs 2';
                }
                else{
                    $gameType = 'Mode Undefined';
                }

                $versusmargin = ($ppteam/2)*190+40;

                $before = microtime(true);
                date_default_timezone_set('Etc/UTC');
                $after = microtime(true);
                $debug=date("H:i:s",$after-$before);
                echo "<script>console.log('$debug');</script>";

                $champdata = file_get_contents("champions.json");
                $champname = json_decode($champdata, true);

                $spelldata = file_get_contents("spells.json");
                $spells = json_decode($spelldata,true);

                //SUMMONER DATA
                for($i=1; $i<=$players; $i++){

                    ${"summonerId" . $i} = $match['participants'][$i-1]['summonerId'];
                    ${"summoner" . $i} = $match['participants'][$i-1]['summonerName'];
                    ${"championId" . $i} = $match['participants'][$i-1]['championId'];



                    ${"champion" . $i} = $champname[${'championId'.$i}]['name'];
                    ${"championimg" . $i} = $champname[${'championId'.$i}]['key'].".png";

                    ${"champSpell".$i."1"}= $match['participants'][$i-1]['spell1Id'];
                    ${"champSpell".$i."2"}= $match['participants'][$i-1]['spell2Id'];


                    ${'champspell'.$i.'1img'}=$spells[${"champSpell".$i."1"}]['image'];
                    ${'champspell'.$i.'2img'}=$spells[${"champSpell".$i."2"}]['image'];

                    $stringrequest = $stringrequest.${"summonerId" . $i}.',';

                }


                $champdata = file_get_contents("champions.json");
                $champname = json_decode($champdata, true);

                //BANS

                for($i=1; $i<=6; $i++){
                    ${"ban".$i} = $match['bannedChampions'][$i-1]['championId'];

                    ${"banimg" . $i} = $champname[${'ban'.$i}]['key'].".png";
                }

                $rankedinfourl = "https://na.api.pvp.net/api/lol/na/v2.5/league/by-summoner/".$stringrequest."/entry?api_key=".$key;
                //echo "<script>console.log('$rankedinfourl')</script>";
                $rankedcontents = file_get_contents($rankedinfourl);
                $rankedinfo = json_decode($rankedcontents,true);

                for($i=1;$i<=$players;$i++){
                    $playerQueue=$rankedinfo[${'summonerId'.$i}][0]['queue'];
                    if($playerQueue == "RANKED_SOLO_5x5"){
                        ${'player'.$i.'tier'} = $rankedinfo[${'summonerId'.$i}][0]['tier'];
                        ${'player'.$i.'div'} = $rankedinfo[${'summonerId'.$i}][0]['entries'][0]['division'];
                        ${'player'.$i.'lp'} = $rankedinfo[${'summonerId'.$i}][0]['entries'][0]['leaguePoints'];
                        ${'player'.$i.'wins'} = $rankedinfo[${'summonerId'.$i}][0]['entries'][0]['wins'];
                        ${'player'.$i.'loss'} = $rankedinfo[${'summonerId'.$i}][0]['entries'][0]['losses'];
                        ${'playerStats'.$i}=${'player'.$i.'tier'}." ".${'player'.$i.'div'}." (".${'player'.$i.'lp'}.")";
                        ${'series'.$i}=$rankedinfo[${'summonerId'.$i}][0]['entries'][0]['miniSeries']['progress'];
                        if(isset(${'series'.$i})){
                            ${'serieslength'.$i}=strlen(${'series'.$i});
                            ${'seriesprogress'.$i}=str_split(${'series'.$i});
                        }
                    }
                    else{
                        ${'player'.$i.'tier'}='ETC';
                        ${'player'.$i.'div'}='Unranked';
                        ${'playerStats'.$i}='Unranked';
                        ${'player'.$i.'wins'} = '0';
                        ${'player'.$i.'loss'} = '0';
                    }
                }
            }

            else{
                if(strpos($http_response_header[0],'503')!==false){
                    echo "<META http-equiv='refresh' content='0; URL=index.html?error=2'>";
                    exit(0);
                }
                else if(strpos($http_response_header[0],'404')!==false){
                    echo "<META http-equiv='refresh' content='0; URL=index.html?error=1'>";
                    exit(0);
                }

            }

        ?>
        <title>Current Game Info for:
            <?=$name?>
        </title>
</head>

<body>
    <div id="fullpage">

        <!------------------------------------------>
        <!---------------SECTION 1------------------>
        <!------------------------------------------>

        <div class="section">
            <div class="options">
                Lock Ranked Info:
                <input type="checkbox" class="js-switch" id="switch">
            </div>
            <div class="build os" id="build"><i class="fa fa-exclamation-triangle"></i>&nbsp;Build in progress
                <p style="font-size:0.7em;">Expect service interruptions</p>
            </div>
            <div class="ro version">
                <?=$ver?>
            </div>
            <div class="container-fluid row">
                <!--<div class="col-md-3 col-md-offset-9 title">SUMMONER'S RIF<span style="padding-left:3px;"></span>T</div>-->
            </div>
            <div class="container-fluid row resultshead">
                <div class="col-md-5 title">
                    <?php
                        if($mapId === 11){
                            echo "SUMMONERS RIF<span style='padding-left:3px'></span>T";
                        }
                        else if($mapId === 12){
                            if (rand (0,10)==7)
                                echo "MURDER BRIDGE";
                            else
                                echo "HOWLING ABYSS";
                        }
                        else if($mapId === 10){
                            echo "TWISTED TREELINE";
                        }
                        else if($mapId === 8){
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
                <div class="col-md-5 gametype">
                    <?=$gameType?>
                </div>
            </div>

            <!--<img src='${'champspell'.$i.'1img'}'/><img src='${'champspell'.$i.'2img'}'/>-->

            <div class="container row team" style="width:<?php echo $ppteam*200+250;?>px">
                <?php
        /*                for ($i=1; $i<=$ppteam; $i++){
                            echo "<div class='col-md-2 summname do'><span>${'summoner'.$i}</span></div>";
                        }*/
                    ?>

            </div>
            <div class="container row team" style='width:<?php echo $ppteam*200+250;?>px'>
                <?php
                        for ($i=1; $i<=$ppteam; $i++){
                            echo "<div class='col-md-2 champimg'>
                                <img class='splash' src='assets/splash/${'championimg' . $i}'></img>

                                <div class='name' onmouseover='info($i,1)' onmouseout='info($i,0)'>
                                <div class='row spellrow' id='spellrow$i'>
                                    <img class='spell' src='${'champspell'.$i.'1img'}' id='spell${i}1'>
                                    <img class='spell' src='${'champspell'.$i.'2img'}' id='spell${i}2'>
                                </div>
                                <p class='osans champion' id='champ$i'>${'champion'.$i}</p>
                                <div class='rank row' id='rank$i'>
                                    <img src='assets/ranked/${'player'.$i.'tier'}/${'player'.$i.'div'}.png'>
                                    <p class='tier'>${'playerStats'.$i}</p>";

                                    if(isset(${'series'.$i})){
                                        ${'seriesset'.$i}=true;
                                        echo "<div class='series'><span>";
                                        for($d=1;$d<=${'serieslength'.$i};$d++){
                                            if(${'seriesprogress'.$i}[$d-1]=='W'){
                                                echo "<i class='fa fa-check'></i>";
                                            }
                                            else if(${'seriesprogress'.$i}[$d-1]=='L'){
                                                echo "<i class='fa fa-times'></i>";
                                            }
                                            else{
                                                echo "<i class='fa fa-minus'></i>";
                                            }
                                        }
                                        echo "</span></div>";
                                    }

                            echo  "<span class='wins'>W:${'player'.$i.'wins'} /</span><span class='loss'>/ L:${'player'.$i.'loss'}</span>
                                </div>
                                <p class='osans ";
                                    if(${'seriesset'.$i}==true){
                                        echo "seriesset";
                                    }
                                    else{
                                        echo "summoner";
                                    }
                            echo "'>${'summoner'.$i}</p>
                                </div>
                                <div class='dim' id='$i' onmouseover='info($i,1)' onmouseout='info($i,0)'></div>
                            </div>";
                        }
                    ?>
                    <div class="col-md-2">
                        <div class="container-fluid bans">
                            <?php

                                for($i=1;$i<=3;$i++){
                                    if(${'banimg'.$i}!='.png'){
                                         echo "<div class='row'><img class='banimg' src='assets/square/${'banimg'.$i}'></img></div>";
                                    }

                                }
                            ?>
                        </div>
                    </div>
            </div>
            <div class="container row versus">

                <div class='ro'>VS</div>
            </div>
            <div class="container row team" style="width:<?php echo $ppteam*200+250;?>px">
                <?php
        /*                for ($i=$ppteam+1; $i<=$players; $i++){
                            echo "<div class='col-md-2 summname do'><span>${'summoner'.$i}</span></div>";
                        }*/
                    ?>

            </div>
            <div class="container row team" style='width:<?php echo $ppteam*200+250;?>px'>
                <?php
                        for ($i=$ppteam+1; $i<=$players; $i++){
                            echo "<div class='col-md-2 champimg'>
                                <img class='splash' src='assets/splash/${'championimg' . $i}'></img>

                                <div class='name' onmouseover='info($i,1)' onmouseout='info($i,0)'>
                                <div class='row spellrow' id='spellrow$i'>
                                    <img class='spell' src='${'champspell'.$i.'1img'}' id='spell${i}1'>
                                    <img class='spell' src='${'champspell'.$i.'2img'}' id='spell${i}2'>
                                </div>
                                <p class='osans champion' id='champ$i'>${'champion'.$i}</p>
                                <div class='rank row' id='rank$i'>
                                    <img src='assets/ranked/${'player'.$i.'tier'}/${'player'.$i.'div'}.png'>
                                    <p class='tier'>${'playerStats'.$i}</p>";

                                    if(isset(${'series'.$i})){
                                        ${'seriesset'.$i}=true;
                                        echo "<div class='series'><span>";
                                        for($d=1;$d<=${'serieslength'.$i};$d++){
                                            if(${'seriesprogress'.$i}[$d-1]=='W'){
                                                echo "<i class='fa fa-check'></i>";
                                            }
                                            else if(${'seriesprogress'.$i}[$d-1]=='L'){
                                                echo "<i class='fa fa-times'></i>";
                                            }
                                            else{
                                                echo "<i class='fa fa-minus'></i>";
                                            }
                                        }
                                        echo "</span></div>";
                                    }

                            echo  "<span class='wins'>W:${'player'.$i.'wins'} /</span><span class='loss'>/ L:${'player'.$i.'loss'}</span>
                                </div>
                                <p class='osans ";
                                    if(${'seriesset'.$i}==true){
                                        echo "seriesset";
                                    }
                                    else{
                                        echo "summoner";
                                    }
                            echo "'>${'summoner'.$i}</p>
                                </div>
                                <div class='dim' id='$i' onmouseover='info($i,1)' onmouseout='info($i,0)'></div>
                            </div>";
                        }


                    ?>
                    <div class="col-md-2">
                        <div class="container-fluid bans">
                            <?php
                                for($i=4;$i<=6;$i++){
                                    if(${'banimg'.$i}!='.png'){
                                         echo "<div class='row'><img class='banimg' src='assets/square/${'banimg'.$i}'></img></div>";
                                    }
                                }
                            ?>
                        </div>
                    </div>


            </div>
        </div>

        <!------------------------------------------>
        <!---------------SECTION 2------------------>
        <!------------------------------------------>

        <!--<div class="section"></div>-->


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

            function format(num) {
                if (num > 0) {
                    if (num >= 10)
                        val = num;
                    else
                        val = '0' + num;
                } else
                    val = '00';

                return val;
            }
        </script>
        <script>
            <?php
    echo "$.backstretch('assets/maps/";
        if($mapId === 11){
            echo "summonersrift";
        }
        else if($mapId === 12){
            echo "howlingabyss";
        }
        else if($mapId === 10){
            echo "twistedtreeline";
        }
        else if($mapId === 8){
            echo "crystalscar";
        }
        else{
            echo "bg";
        }
    echo ".jpg');"
                    ?>
        </script>
        <script>
            $(function () {
                if ($.cookie('lock') == 'true') {
                    document.getElementById("switch").checked = true;
                    for (var i = 1; i <= 10; i++) {
                        up(i);
                    }
                } else {
                    document.getElementById("switch").checked = false;
                    for (var i = 1; i <= 10; i++) {
                        down(i);
                    }
                }
                $('.js-switch').click();
                $('.js-switch').click();
            });
        </script>

        <script>
            var elem = document.querySelector('.js-switch');
            var init = new Switchery(elem, {
                size: 'small'
            });
            var changeCheckbox = document.querySelector('.js-switch');
            changeCheckbox.onchange = function () {
                if (changeCheckbox.checked == false) {
                    $.cookie('lock', 'false', {
                        expires: 365
                    });
                    for (var i = 1; i <= 10; i++) {
                        down(i);
                    }
                } else {
                    $.cookie('lock', 'true', {
                        expires: 365
                    });
                    for (var i = 1; i <= 10; i++) {
                        up(i);
                    }
                }
            };

            function info(splash, updown) {
                if (changeCheckbox.checked == false) {
                    if (updown === 1) {
                        up(splash);
                    } else {
                        down(splash);
                    }
                } else {
                    for (var i = 1; i <= 10; i++) {

                        document.getElementById(i).style.marginTop = "-450px";
                        document.getElementById('spellrow' + i).style.marginTop = "-160px";
                        document.getElementById('spellrow' + i).style.marginLeft = "31px";
                        //document.getElementById('champ'+splashid).style.top = "-230px";
                        document.getElementById('rank' + i).style.opacity = "1";
                        document.getElementById('spell' + i + '1').style.width = "30px";
                        document.getElementById('spell' + i + '2').style.width = "30px";
                        document.getElementById('spell' + i + '1').style.height = "30px";
                        document.getElementById('spell' + i + '2').style.height = "30px";
                    }
                }
            }

            function up(splashid) {
                document.getElementById(splashid).style.marginTop = "-450px";
                document.getElementById('spellrow' + splashid).style.marginTop = "-160px";
                document.getElementById('spellrow' + splashid).style.marginLeft = "31px";
                //document.getElementById('champ'+splashid).style.top = "-230px";
                document.getElementById('rank' + splashid).style.opacity = "1";
                document.getElementById('spell' + splashid + '1').style.width = "30px";
                document.getElementById('spell' + splashid + '2').style.width = "30px";
                document.getElementById('spell' + splashid + '1').style.height = "30px";
                document.getElementById('spell' + splashid + '2').style.height = "30px";
            }

            function down(splashid) {
                document.getElementById(splashid).style.marginTop = "-250px";
                document.getElementById('spellrow' + splashid).style.marginTop = "0px";
                document.getElementById('spellrow' + splashid).style.marginLeft = "21px";
                document.getElementById('champ' + splashid).style.top = "0px";
                document.getElementById('rank' + splashid).style.opacity = "0";
                document.getElementById('spell' + splashid + '1').style.width = "40px";
                document.getElementById('spell' + splashid + '2').style.width = "40px";
                document.getElementById('spell' + splashid + '1').style.height = "40px";
                document.getElementById('spell' + splashid + '2').style.height = "40px";
            }
            $(document).ready(function () {
                $('#fullpage').fullpage({
                    verticalCentered: false,
                    easing: 'easeInOutExpo',
                });
            });
        </script>
        <!--      <script>
            var gitAPI = "https://api.github.com/repos/:owner/:repo/commits/master?access_token=TOKEN";

            $.getJSON(gitAPI, function (json) {
                var commit = json.commit.author.date;
                var time = commit.split("T");
                var time1 = time[1].replace("Z","");

                var time2 = time1.split(":");
                var h=time2[0];
                var m=time2[1];
                var d = new Date();
                var uh = d.getUTCHours();
                var um = d.getUTCMinutes();
                m=parseInt(m);
                h=parseInt(h);
                um=parseInt(um);
                uh=parseInt(uh);
                m=m+2;
                if(m>59){
                    m=m-59;
                    h=h+1;
                }
                if(m<10){
                    m = "0"+m;
                }
                if(h<10){
                    h = "0"+h;
                }
                if(uh<10){
                    uh="0"+uh;
                }
                if(um<10){
                    um="0"+um;
                }
                var utctime= uh+":"+um+":"+"00";
                var formattedtime=h+":"+m+":"+"00";
                console.log("UTC: " +utctime);
                console.log("LAST BUILD: "+formattedtime);
                if(formattedtime>utctime){
                    document.getElementById("build").style.opacity="1";
                }

            });
        </script>-->
</body>

</html>
