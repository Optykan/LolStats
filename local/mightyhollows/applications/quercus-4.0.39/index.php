<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">

		<title>Lolstats (Ayy Lmao)</title>
		<!-- FONTS -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
        
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>

    </head>
    <body>
		<div class="searchcontainer">
			<h1>In-game Champion Lookup</h1><br>
			<!--Im gonna need a separate style for whatever text we put here but screw that Im going to bed its like 4.-->
        	<form action="results.php" method="get" class="search">
        		<input type="text" name="inputname" placeholder="Summoner Name" required>
				<button type="submit" class="searchbutton"><span>
					<label for="submit">Search Game</label>
        	</form>
		</div>
        <!--Summoner Name: <input type="text" name="inputname"><br>
		<Input class="searchbutton" type="submit">
        -->
			
<!--        <script>
            function request(){
                
                
                var name = document.getElementById('inputname').value;
                var idnum=data.name.id;
                $.ajax({
                    url:"https://na.api.pvp.net/api/lol/na/v1.4/summoner/by-name/"+name+"?api_key=b0cc9773-08ca-4a5b-8d05-f767de88fcc3",
                    dataType:"json",
                    type:"GET",
                    data: {"id": idnum},
                    success:function(data) {
                        
                        console.log(idnum);
                        $("#idresult").text(data);
                        
                    }
                });
            }

        </script>-->

<!--        <script>
        function submitreq(){
            console.log("err");
            var name = document.getElementById('inputname').value;
            var summIDAPI = "https://na.api.pvp.net/api/lol/na/v1.4/summoner/by-name/"+name+"?api_key=b0cc9773-08ca-4a5b-8d05-f767de88fcc3";

            $.getJSON(summIDAPI, function (json) {
                var summID = json..id;
                $("#idresult").text(summID);
            });
        }

        </script>-->
			<!--Linebump, Git got confused who was editing and fucked it up-->
		<script> $.backstretch("assets/bg.jpg");</script>
    </body>
</html>