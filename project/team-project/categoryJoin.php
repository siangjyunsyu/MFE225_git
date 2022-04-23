<?php
require_once("../admin-db-connect.php");

// 資料表合併:代表同欄位的資料JOIN在一起
// 選取 資料表A.*,資料表B.* 從資料表A
// JOIN 資料表B ON 資料表A.classify_id欄位= 資料表B.id欄位
$sql="SELECT classify.*, category.*  FROM classify
JOIN category ON classify.id = category.classify_id
";

$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

var_dump($rows);

?>