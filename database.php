<html>

<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>
    <?php
        function pg_connection_string() {
          return "dbname=d30k0c9hk8q1qs host=ec2-107-21-219-109.compute-1.amazonaws.com port=5432 user=atkkgxyhgxqbft password=J4JTqhMa90yhlS4-bolWVxjnOO sslmode=require";
        }

        $db = pg_connect(pg_connection_string());
        if (!$db) {
            echo '<div class="alert alert-danger" role="alert">Database connection error.</div>';
            exit;
        }

        $sql="INSERT INTO keys (id, apikey) VALUES (1, 'f9b65dec-9317-4051-a031-b1a875a3a11f');";
        //$sql="CREATE TABLE keys (id int, apikey VARCHAR(36));";
    
    $result = pg_query($db, $sql);
    if(!result){
        echo '<div class="alert alert-danger" role="alert">Something happened. Row not updated.</div>';
    }
    else{
        echo '<div class="alert alert-success" role="alert">Row updated.</div>';
    }
/*    
    $result = pg_exec($conn, "SELECT * FROM keys");
    while ($row = pg_fetch_array($result))
    {
         echo "data: ".$row["id"];
    } */
    ?>
</body>

</html>