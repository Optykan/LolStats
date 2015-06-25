<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">

		<title>LoL Stats</title>
		<!-- FONTS -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link ref="stylesheet" href="css/styles.css">
        
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        


    </head>
    <body>

        <input type="text" id="inputname">
        <button onclick="request()">Submit</button>
        
        <p id="idresult"></p>
        <script>
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

        </script>

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

    </body>
</html>