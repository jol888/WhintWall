<?php
session_start();
?>


<head>
        <meta charset="utf-8">
        <script src="./js/jquery.js"></script>
        <script src="./popper.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        </dev><script src="./masonry.pkgd.min.js"></script>
        <style>
            body{background:url('./bg.png') center no-repeat fixed; background-size:cover}
            .navbar{
                margin-bottom:20px
            }
            #lst{
                background-color:rgba(10,10,10,0.4);
                margin:30px;
                
            
            }
            .card{
                opacity: 0.6;
            }
            .navbar{
                opacity: 0.9;
                
            }
            
            </style>
        <meta name="viewport" content="width=device-width, user-scalable=no, 
initial-scale=1.0, maximumscale=1.0, minimum-scale=1.0">
    </head>
    <body>
<nav class="navbar navbar-default"></nav>
<nav class="navbar navbar-default"></nav>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top " >
            <a class="navbar-brand" href="#">GWhintWall</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="/">表白墙</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./add.php">写纸条</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    友链
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Jol888</a>
                    <a class="dropdown-item" href="#">DLL</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">加入我们</a>
                  </div>
                </li>
                
              </ul>
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="看看有咩有你的名字" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">检索</button>
              </form>
            </div>
          </nav>
<?php
include("sql.php");
$conn = new mysqli($SQLservername, $SQLusername, $SQLpassword, "whitewall");
if ($conn->connect_error)
    die("SqlErr: " . $conn->connect_error . '<br/>' . "请联系崽种是谁并附上这条信息。这有助于解决问题。");
$sql = "SELECT * FROM White;";
$conn->query("set names 'utf-8'");
$result = $conn->query($sql);
try {
    if ($result->num_rows > 0) {
        // 锟斤拷锟斤拷锟斤拷锟?
        echo "<div id=\"lst\"  >";
        while ($row = $result->fetch_assoc()) {
            $_nickname = $row['nickname'];
            $_note = $row['note'];
            $_id = $row['id'];
            $_title = $row['title'];
            echo <<<EOF
            <tr>
            <div class="mb-4">
                <div class="card" style="max-width: 200px;max-width: 410px;margin:10px">
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

		<script type="text/javascript">
			var masonry = new Masonry($('#lst')[0],{
				itemSelector:'.card',
columnWidth: 10
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