<?php
require_once("../db-connect.php");

if (!isset($_GET["p"])) {
  $p = 1;
} else {
  $p = $_GET["p"];
}

if (!isset($_GET["type"])) {
  $type = 1;
} else {
  $type = $_GET["type"];
}


switch ($type) {
  case "1";
    $order = "id ASC";
    break;
  case "2";
    $order = "id DESC";
    break;
  case "3";
    $order = "name ASC";
    break;
  case "4";
    $order = "name ASC";
    break;
  default:
    $order = "id ASC";
}


//所有使用者
$sql = "SELECT * FROM product WHERE valid=1";
$result = $conn->query($sql);
$total = $result->num_rows;


$per_page = 10;

$page_count = CEIL($total / $per_page);

//CEIL 無條件進位

$start = ($p - 1) * $per_page;
$sql = "SELECT * FROM product WHERE valid=1 ORDER BY $order LIMIT $start, $per_page";




//ASC 升冪
//DESC 降冪

// $arr=[
//     "name" => "Joe"
// ];

// =>
// -> 取得

$result = $conn->query($sql);

$rows = $result->fetch_all(MYSQLI_ASSOC);

$user_count = $result->num_rows;

// if($user_count>0){
//     while($row = $result->fetch_assoc()) {
//         echo $row ["name"].", email is".$row ["email"]. ", phone is ".$row["phone"];
//         echo "<br>";

//     }

// }else{
//     echo "no data.";
// }
?>


<!doctype html>
<html lang="en">

<head>
  <title>商品管理</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.0.2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    .btn-check:active+.btn-info,
    .btn-check:checked+.btn-info,
    .btn-info.active,
    .btn-info:active,
    .show>.btn-info.dropdown-toggle {
      background: #aaa;
      border-color: #aaa;
    }
  </style>

</head>

<body>
  <div class="container">
    <?php //echo $order; 
    ?>
    <h3 class="text-center">商品管理</h3>
    <div class="py-2 text-end">
      <a class="btn btn-info text-white" href="createproduct.php">新增商品</a>
    </div>
   
    <div class="row justify-content-between py-3">
            <div class="col-auto">
               <a class="btn btn-info text-white">依日期排序</a>
               <a class="btn btn-info text-white">依編號排序</a>
               <a class="btn btn-info text-white">依數量排序</a>
               <a class="btn btn-info text-white">依金額排序</a>
            </div>
            <div class="col-auto">
               <form action="">
                  <div class="row">
                     <div class="col-auto">
                        <input type="date" name="date1" class="form-control">
                     </div>
                     <div class="col-auto">
                        <label class="col-form-label" for="">~</label>
                     </div>
                     <div class="col-auto">
                        <input type="date" name="date2" class="form-control">
                     </div>
                     <div class="col-auto">
                        <button type="submit" class="btn btn-info">查詢</button>
                     </div>
                  </div>
               </form>
            </div>
</div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>商品編號</th>
      <th>商品名稱</th>
      <th>類別</th>
      <th>金額</th>
      <th>庫存數量</th>
    </tr>
  </thead>
  
  <!-- foreach可以跑兩次迴圈 用fetch_all抓資料-->
  <tbody>
    <?php if ($user_count > 0) : ?>
      <?php foreach ($rows as $row) : ?>
        <tr>
          <td width="5em"><?= $row["product_num"] ?></td>
          <td width="5em"><?= $row["product_name"] ?></td>
          <td width="5em"><?= $row["category_id"] ?></td>
          <td width="5em"><?= $row["price"] ?></td>
          <td width="5em"><?= $row["product_count"] ?></td>
          
          <!-- <td><a class="btn btn-info text-white" href="user.php?id=<?= $row["id"] ?>">詳細</a></td> -->
        </tr>
        <?php endforeach ?>
        
        <?php else : ?>
          <?= "no data." ?>
          <?php endif; ?>
        </tbody>
      </table>
      
      
      <div class="py-2 ">
        <nav aria-label="Page navigation example ">
          <ul class="pagination justify-content-center ">
            <?php if($p > 1):?>
              <li class="page-item"><a class="page-link" href="miu_product.php?p=<?=$p-1?>"><</a></li>
            <?php endif; ?>

            <?php if($p == $page_count):?>
              <li class="page-item"><a class="page-link" href="miu_product.php?p=<?=$p-2?>"><?=$p-2?></a></li>
            <?php endif; ?>

            <?php if($p > 1):?>
              <li class="page-item"><a class="page-link" href="miu_product.php?p=<?=$p-1?>"><?=$p-1?></a></li>
            <?php endif; ?>

            <li class="page-item active"><a class="page-link active" href="miu_product.php?p=<?=$p?>"><?=$p?></a></li>
            
            <?php if($p < $page_count):?>
              <li class="page-item"><a class="page-link" href="miu_product.php?p=<?=$p+1?>"><?=$p+1?></a></li>
            <?php endif; ?>

            <?php if($p == 1):?>
              <li class="page-item"><a class="page-link" href="miu_product.php?p=<?=$p+2?>"><?=$p+2?></a></li>
            <?php endif; ?>


            <?php if($p < $page_count):?>
              <li class="page-item"><a class="page-link" href="miu_product.php?p=<?=$p+1?>">></a></li>
            <?php endif; ?>
          </ul>
        </nav>
            
      </div>
          <div class="py-2 text-center">
            第<?= $p ?> 頁,共<?= $page_count ?>頁,共<?= $total ?> 筆
          </div>
      <!-- 上面的fetch_assoc資料已經被抽出來了 所以迴圈會跑不出來-->
    <?php
    if ($user_count > 0) {
      while ($row = $result->fetch_assoc()) {
        echo $row["name"] . ", email is" . $row["email"] . ", phone is " . $row["phone"];
        echo "<br>";
      }
    }
    ?>
  </div>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>