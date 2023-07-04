<?php
try {
  $db_name = 'gs_db2';
  $db_id   = 'root';
  $db_pw   = '';
  $db_host = 'localhost';
  $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
  exit('DB Connection Error:' . $e->getMessage());
}

$stmt = $pdo->prepare("SELECT * FROM gs_osteo");
$status = $stmt->execute();

$view = "";
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    $view .= '<table class="table table-striped">';
    $view .= '<thead><tr><th>Name</th><th>Birthday</th><th>Sex</th><th>PMH</th><th>PFX</th><th>Osteo</th><th>Operations</th></tr></thead>';
    $view .= '<tbody>';
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<tr>';
        $view .= '<td><a href="detail.php?id=' . $result['id'].'">'. $result['name'].'</a></td>';
        $view .= '<td>'. $result['birthday'].'</td>';
        $view .= '<td>'. $result['sex'].'</td>';
        $view .= '<td>'. $result['pmh'].'</td>';
        $view .= '<td>'. $result['pfx'].'</td>';
        $view .= '<td>'. $result['posteo'].'</td>';
        $view .= '<td><a href="delete.php?id=' . $result['id'].'"> [削除] </a></td>';
        $view .= '</tr>';
    }
    $view .= '</tbody>';
    $view .= '</table>';
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ユーザー情報表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>

<div>
    <div class="container jumbotron">
    <a href="detail.php"></a>
    <?= $view ?></div>
</div>

</body>
</html>
