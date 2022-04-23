<?php
require_once("../admin-db-connect.php");

// 所有使用者
$sql = "SELECT * FROM classify WHERE id=1";
$result = $conn->query($sql);
$user_count = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
  <title>Classify-doCreate</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.0.2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
  <?php if ($user_count > 0) : ?>
    <?php foreach ($rows as $row) : ?>
      <div class="container">
        <form action="admin-classify-doCreate-program.php" method="post">
          <div class="d-flex mt-3">
            <div class="mb-2 col-auto">
              <label class="me-3" for="name">總分類名稱</label>
            </div>
            <input style="width: 10%" type="text" id="classify_name" class="form-control" name="classify_name" required>
          </div>
          <div class="py-2">
            <button type="submit" class="me-3 btn btn-info">
              <a class="text-decoration-none  text-white" href="admin-classify.php?id=<?= $row["id"] ?>">取消新增</a></button>
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