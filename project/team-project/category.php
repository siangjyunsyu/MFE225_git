<?php
require_once("../db-connect.php");

if (!isset($_GET["p"])) { // p是指page
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
  case "1":
    $order = "id ASC";
    break;
  case "2":
    $order = "id DESC";
    break;
  default:
    $order = "id ASC";
}
// ASC:升冪、DESC:降冪

// 所有使用者
$sql = "SELECT * FROM category WHERE valid=1"; //修改成你要的SQL語法,WHERE:選取匹配指定條件的數據
$result = $conn->query($sql); // query:引用資料 $conn:連結
$total = $result->num_rows; //總共有幾筆
$per_page = 10; //每頁顯示項目數量
$page_count = CEIL($total / $per_page); // SQL中的取整函數:將最後結果的餘數取正數
$start = ($p - 1) * $per_page; // 最開始從最0筆資料開始,所以(頁數-1)*每頁顯示項目數量


$classify_id = $_GET["classify_id"];

$sql = "SELECT * FROM category WHERE valid=1 AND classify_id = $classify_id
  ORDER BY $order 
  LIMIT $start,$per_page"; //LIMIT 限制傳回的資料筆數

$result = $conn->query($sql);
$category_count = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);
$total = $result->num_rows;
$page_count = CEIL($total / $per_page);
$start = ($p - 1) * $per_page;

?>

<!doctype html>
<html lang="en">

<head>
  <title>Category</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.0.2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    .btn-check:active+.btn-info,
    .btn-check:checked+.btn-info,
    .btn-info.active,
    .btn-info:active,
    .show>.btn-info.dropdown-toggle {
      background-color: #CCC;
      border-color: #aaa;
    }
  </style>
</head>

<body>
  <div class="container d-flex ">
    <div class="justify-content-between mx-auto">
      <div class="text-start">
        <a class="btn btn-info text-white me-3 mt-3" href="classify.php?type=1&classify_id=<?= $classify_id ?>&p=<?= $p ?>">回總分類列表</a>
      </div>
      <div class="text-start">
        <div class="d-flex justify-content-between">
          <div class="text-start my-3">
            <a class="btn btn-info text-white me-3 <?php if ($type == 1) echo "active" ?>" href="category.php?type=1&classify_id=<?= $classify_id ?>&p=<?= $p ?>">遞增</a>
            <a class="btn btn-info text-white me-3 <?php if ($type == 2) echo "active" ?>" href="category.php?type=2&classify_id=<?= $classify_id ?>&p=<?= $p ?>">遞減</a>
            <a class="btn btn-info text-white" href="category-doCreate.php?classify_id=<?= $classify_id ?>">新增類別</a>
          </div>
          <div class="py-2 d-flex d-inline text-end my-3">
            共 <?= $total ?> 筆
          </div>
        </div>
      </div>

      <table class="table table-bordered text-center">
        <thead>
          <tr>
            <th>刪除</th>
            <th>編輯</th>
            <th>總分類ID</th>
            <th>總分類名稱</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($category_count > 0) : ?>
            <?php
            foreach ($rows as $row) :
            ?>
              <tr class="align-middle text-center">
                <td><a class="p-2" href='category-doDelete-program.php?id=<?= $row["id"] ?>'><i class="fa-solid fa-calendar-xmark"></i> 刪除</a></td>
                <td><a class="p-2" href='category-edit.php?id=<?= $row["id"] ?>&classify_id=<?= $classify_id ?>'><i class="fa-solid fa-pen-to-square"></i> 編輯</a></td>
                <td><?= $row["id"] ?></td>
                <td><?= $row["category_name"] ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <?= "no data." ?>
          <?php endif; ?>
        </tbody>
      </table>
      <div class="py-2">
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $page_count; $i++) : ?>
              <li class="page-item 
                    <?php if ($i == $p) echo "active"; ?>">
                <a class="page-link" href="category.php?p=<?= $i ?>&type=<?= $type ?>"><?= $i ?></a>
              </li>
            <?php endfor; ?>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>