<?php
    require_once("../db-connect.php"); 

    if(!isset($_POST["category_name"]))
    {
        echo "您不是透過正常管道到此頁";
        exit;
    }

    $category_name=$_POST["category_name"];
    if(empty($category_name))
    {
        echo "您有欄位沒有填寫";
        return;
    }

    $sql_category="INSERT INTO category (category_name)
    VALUES ('$category_name')";
    
    if ($conn->query($sql_category) === TRUE) 
        {
            echo "新增資料完成<br>"; 
            $last_id=$conn->insert_id; // 最新資料取得
            // echo "last id is $last_id";
            // exit;
        } 
            else 
            {
            echo "新增資料錯誤: " . $conn->error;
            exit; // 錯誤的話會停在這
            }
        
        $conn->close();
        // echo "<script>history.back(-2)</script>"
        // echo "<script> location.href = document.referrer; </script>" 
        // JS語法：獲取上一個訪問頁面的URL地址document.referrer實現
        
        header("location: category.php");
?>