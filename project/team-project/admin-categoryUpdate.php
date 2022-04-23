<?php
    require_once("../admin-db-connect.php");

    $id=$_POST["id"];
    $category_name=$_POST["category_name"];
    $classify_id=$_POST["classify_id"];
    
    $sql="UPDATE category SET category_name='$category_name' WHERE id='$id'";

    // echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo "更新成功";
        $conn->close();
        header("location: admin-category.php?id=".$id."&classify_id=".$classify_id);
    } else {
        echo "更新資料錯誤: " . $conn->error;
        exit;
    }
?>