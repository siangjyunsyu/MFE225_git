<?php
require_once("../db-connect.php");

$classify_id = $_GET["classify_id"];

// 所有使用者
$sql = "SELECT * FROM category WHERE id=1";
$result = $conn->query($sql);
$category_count = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);

?>

<!doctype html>
<html lang="en">

<head>
  <title>Category-doCreate</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.0.2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
  <?php if ($category_count > 0) : ?>
    <?php foreach ($rows as $row) : ?>
      <div class="container">
        <form action="category-doCreate-program.php" method="post">
          <div class="d-flex mt-3">
            <div class="mb-2 col-auto">
              <label class="me-3" for="name">類別名稱</label>
            </div>
            <input style="width: 10%" type="text" id="category_name" class="form-control" name="category_name" required>
          </div>
          <div class="py-2">
            <button type="button" class="btn btn-info text-white me-3">
              <a class="text-decoration-none text-white" href="category.php?id=<?= $row["id"] ?>&classify_id=<?=$classify_id?>">取消新增</a></button>
            <button type="submit" class="btn btn-info text-white">儲存</button>
          </div>
        </form>
      </div>
    <?php endforeach; ?>
  <?php else : ?>
    <?= "no data." ?>
  <?php endif; ?>
</body>

</html>