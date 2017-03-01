<?php
require_once('functions.php');
$data = detail($_GET['id']);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>編集</title>
</head>
<body>
	<form action="store.php" method="post">
		<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
		<input type="text" name="todo" value="<?php echo $data ?>">
		<input type="submit" value="更新">
	</form>
  <div>
    <a href="index.php">一覧へもどる</a>
  </div>
</body>
</html>