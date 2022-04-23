<?php
    require_once("../db-connect.php");

    if(!isset($_GET["id"]))
    {
        header("location: 404.php");
    }

    $id=$_GET["id"];
    // echo $id;

    require_once("../db-connect.php");

    //SOFT DELETE
    $sql_category="UPDATE category SET valid=0 WHERE id='$id'";
    
    // echo $sql;
    if ($conn->query($sql_category) === TRUE)
        {
            echo "刪除成功"; 
        } 
            else 
            {
            echo "刪除資料錯誤: " . $conn->error;
            } 

    $conn->close();
    echo "<script> location.href = document.referrer; </script>"
?>