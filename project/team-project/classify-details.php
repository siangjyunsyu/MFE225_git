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
    case "1":
        $order = "id ASC";
        break;
    case "2":
        $order = "id DESC";
        break;
    default:
        $order = "category_id ASC";
}
// ASC:升冪、DESC:降冪

// 所有使用者
$sql = "SELECT * FROM category WHERE valid=1";
$result = $conn->query($sql);
$total = $result->num_rows; //總共要幾頁

$per_page = 10;

$page_count = CEIL($total / $per_page);

$start = ($p - 1) * $per_page;
$sql = 
"SELECT * FROM category WHERE valid=1 
ORDER BY $order 
LIMIT $start,$per_page";

$result = $conn->query($sql);
$user_count = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);

// -------------------------------------

if (!isset($_GET["classify_id"])) {
header("location: 404.php");
}

$id = $_GET["id"];



$sql = "SELECT * FROM category_id WHERE id='$id' AND valid=1";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
if (!$row) {
header("location: 404.php");
}
?>


<!doctype html>
<html lang="en">

<head>
    <title>user</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <?php //var_dump($row);
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="py-2">
                    <a class="btn btn-info text-white" href="classify.php">回總分類列表</a>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>刪除</th>
                        <th>修改總分類</th>
                        <th>總分類ID</th>
                        <th>總分類名稱</th>
                    </tr>
                    <tr>
                        <td><a href="doDelete.php">刪除</a></td>
                        <td><a href="">修改</a></td>
                        <td><?= $row["email"] ?></td>
                        <td><?= $row["phone"] ?></td>
                    </tr>
                    <tr>
                        <th>create time</th>
                        <td><?= $row["create_time"] ?></td>
                    </tr>
                </table>
                <div class="py-2">
                    <a class="btn btn-info text-white" href="user-edit.php?id=<?= $row["id"] ?>">編輯</a>
                    <a class="btn btn-danger" href="doDelete.php?id=<?= $row["id"] ?>">刪除</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>