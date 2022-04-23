<?php
    if(!isset($_GET["id"]))
    {
        header("location: 404.php");
    }
    $id=$_GET["id"];
    
    require_once("../db-connect.php");
    $classify_id = $_GET["classify_id"];
    
    $sql="SELECT * FROM category WHERE id='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();  
    if(!$row)
    {
        header("location: 404.php");
    }
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Category-edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>      
      <div class="container">
          <div class="row justify-content-center">
                <div class="col-lg-4">
                    <form action="updateCategory.php" method="post">
                        <table class="table table-bordered">
                            <input type="hidden" name="id" value="<?=$row["id"]?>">
                            <tr>
                                <th>類別ID</th>
                                <td><?=$row["id"]?></td>                            
                            </tr>
                            <tr>
                                <th>類別名稱</th>                                
                                <td><input class="form-control" name="category_name" type="text" value="<?=$row["category_name"]?>"></td>                            
                            </tr>
                        </table>
                        <div class="py-2">                            
                            <a class="btn btn-info text-white" href="category.php?id=<?=$row["id"]?>&classify_id=<?=$classify_id?>">取消編輯</a>
                            <button type="submit" class="btn btn-info text-white">儲存</button>
                        </div>
                    </form>
                </div>
          </div>
      </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>