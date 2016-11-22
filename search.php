<?php

require "lib.php"; // move all DB work outside

    //get search term
    $searchTerm = strtoupper($_GET['term']);    
    //get matched data from skills table
    $sql = "SELECT * FROM ingredients WHERE upper(Name) LIKE '%".$searchTerm."%' ORDER BY Name ASC";

    $result = sendSql($sql);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row['Name']; 
    }    
    //return json data
    echo json_encode($data);
?>
