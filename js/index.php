<?php
session_start();
?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>WhiteWall</title>
	<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
	<script src="http://libs.baidu.com/bootstrap/2.3.1/js/bootstrap.min.js"></script>
	<link href="http://libs.baidu.com/bootstrap/2.3.1/css/bootstrap.min.css" rel="stylesheet">
	<style>
		.navbar {
			margin-bottom: 20px
		}
	</style>
</head>

<body>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span8">
				<h1>
					<strong>WhiteWall</strong>
				</h1>
				<li class="nav-item">
                  <a class="nav-link" href="./add.php">写纸条</a>
                </li>
				<h3>
					By：
				</h3>
			</div>
		</div>
		<div class="row-fluid">
<?php
include("sql.php");
$conn = new mysqli($SQLservername, $SQLusername, $SQLpassword, "whitewall");
if ($conn->connect_error)
    die("SqlErr: " . $conn->connect_error . '<br/>' . "请联系崽种并附上这条信息。这有助于解决问题。");
$sql = "SELECT * FROM White;";
$conn->query("set names 'utf-8'");
$result = $conn->query($sql);
try {
    if ($result->num_rows > 0) {
        // 锟斤拷锟斤拷锟斤拷锟?
        echo "<div id=\"lst\">";
        while ($row = $result->fetch_assoc()) {
            $_nickname = $row['nickname'];
            $_note = $row['note'];
            $_id = $row['id'];
            $_title = $row['title'];
            echo <<<EOF
            <tr>
            <div class="mb-4">
                <div class="card" style="width: 200;margin:10px">
  <div class="card-body">
    <h5 class="card-title">$_title</h5>
    <h6 class="card-subtitle mb-2 text-muted"> $_nickname</h6>
    
    <p class="card-text overflow-auto">$_note</p>
	<a class="card-link">署名：$_nickname</a>
    <a class="card-link">NoteID:$_id</a>
  </div>
</div>
</div>
EOF;
        }
        echo <<<EOF
	</dev><script src="masonry.pkgd.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			var masonry = new Masonry($('#lst')[0],{
				itemSelector:'.card',
columnWidth: '.card',
                percentPosition: true
			});
</script>
EOF;


    }
    else {
        echo "0 锟斤拷锟?";
    }
}
catch (Exception $e) 
{
    echo "ERR";
}
$conn->close();
?>
		</div>
</body>

</html>