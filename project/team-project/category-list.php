<?php
    require_once("../db-connect.php"); 
    $classify_id=$_GET["classify_id"];
    $sql="SELECT classify.*, category.name AS category_name, classify.name AS classify_name, classify.id FROM classify 
    JOIN category ON classify.id = category.classify_id
    WHERE classify.id = '$classify_id'";
    
    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    ?>

<!doctype html>
<html lang="en">
  <head>
    <title>Order List</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>
      <div class="container">    
          <div class="py-2">
              <a class="btn btn-info text-white" href="order-list.php">回到分類列表</a>
          </div>      
          <?php if(isset($_GET["classify_id"])): ?>
                <div class="py-2">
                    <h1><?=$rows[0]["user_name"]?> 的訂購資料</h1>
                </div> 
          <?php endif; ?>
          <div class="py-2">
              <form action="">
                  <div class="row justify-content-end gx-2">
                    <div class="col-auto">
                        <label class="col-form-label" for="">~</label>
                    </div>
                    <div class="col-auto">
                        <input type="date" name="date2" 
                        <?php if(isset($_GET["date2"])): ?>
                        value="<?=$_GET["date2"]?>"
                        <?php endif; ?>
                        class="form-control">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-info">查詢</button>
                    </div>
                </div>
            </form>
        </div>  
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>編號</th>
                        <th>產品</th>
                        <th>單價</th>
                        <th>數量</th>
                        <th>總價</th>                      
                        <th>訂購者</th>
                        <th>訂購日期</th>
                    </tr>
                </thead>
                <tbody>              
                    <?php foreach($rows as $row): ?>
                        <tr>
                            <td><?=$row["id"]?></td>
                            <td>
                                <a href='doDelete.php?id=<?=$row["id"]?>'><i class="fa-solid fa-calendar-xmark"></i> 刪除</a>
                            </td>
                            <td>
                                <a href='category-edit.php?id=<?=$row["id"]?>'><i class="fa-solid fa-pen-to-square"></i> 編輯</a>
                            </td>                           
                            <td>
                                <a href="category-list.php?category_id=
                                    <?=$row["category_id"]?>">
                                    <?=$row["category_name"]?>
                                </a>                         
                            </td>  
                            <td>
                                <a href="order-list.php?user_id=<?=$row["user_id"]?>"><?=$row["user_name"]?></a>
                                </td>
                            <td><a href="order-list.php?date=<?=$row["order_date"]?>"><?=$row["order_date"]?></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>