<?php
    $data = array();

    // check for ajax
    if(isset($_POST['ajax'])) {
        // connect to db
        $conn_string = "host=ec2-174-129-1-179.compute-1.amazonaws.com port=5432 dbname=d6e1frjth87pfd user=cizbwdxggeralb password=Vxbh0ac32QujliNdiV74wBe11N sslmode=require";
        $conn = pg_connect($conn_string);
        
        $query = "SELECT * FROM high_score ORDER BY score DESC LIMIT 10";
        $result = pg_query($conn, $query);
        
        while ($row = pg_fetch_object($result)) {
            array_push(
                $data,
                array(
                    "player" => (string) $row->player,
                    "map"    => (string) $row->map,
                    "wave"   => (int) $row->wave,
                    "score"  => (int) $row->score
                )
            );
        }
        
        echo json_encode($data);
        exit();
    }
    
    echo json_encode($data);
    
    