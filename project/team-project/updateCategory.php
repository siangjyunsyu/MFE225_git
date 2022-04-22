<?php
    require_once("../db-connect.php");

    $id=$_POST["id"];
    $category_name=$_POST["category_name"];
    
    $sql="UPDATE category SET category_name='$category_name' WHERE id='$id'";

    // echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo "更新成功";
        $conn->close();
        header("location: category.php?id=".$id);
    } else {
        echo "更新資料錯誤: " . $conn->error;
        exit;
    }
?>