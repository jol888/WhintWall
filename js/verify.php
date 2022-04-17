<html>
<head>
<meta charset="utf-8">
<title>注册</title><!–标题–>
<style>
.error{color:red;}
</style>
</head>
<body>
<?php
$preg = '/^[a-zA-Z\x{4e00}-\x{9fa5}]{6,20}$/u';
$preg2 = '/^[a-zA-Z]+$/u';
$preg3 = '/^[\x{4e00}-\x{9fa5}]+$/u';
$isInfoCanUse = false;
$email = "";
$emailErr = "必填项目";
function dealInfo($data)
{

    
$data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
$isInfoCanUse = true;
    if (empty($_POST['email'])) {
        $isInfoCanUse = false;
        $emailErr = "注册邮箱不能为空";
    }else {
        if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/", $_POST['email'])) {
            $email = dealInfo($_POST['email']);
            $isInfoCanUse = true;
        }
        else {
            $emailErr = "非法邮箱格式";
            $isInfoCanUse = false;
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && $isInfoCanUse == true) {
    $dbhost = '127.0.0.1';
    $dbuser = 'login';
    $dbpass = 'root';
    $dbname = 'users';
    $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!$link) {
        die("<span style='color:red'><h1 align='center'>无法连接数据库</h1></span>");
    }
    else {
    }
    $sql = "SELECt email FROM users WHERe users=' ". $email . "'";
    $result = mysqli_query($link, $sql);
    if ($result != false) {
        $emailErr = "邮箱已经存在";
    }
    else {
        $sql = "INSERT INTO users(email)
VALUES('$email')";
        if (mysqli_query($link, $sql)) {
            echo "注册成功";
            session_start();
            $_SESSION['email'] = $email;
        
}
        else {
            echo "注册失败<br/>";
        }
        echo '<a href = "index.php"><input type = "button" value = "返回主页" /></a>';
    }
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
验证邮箱：<input type="text" name="email" />
<?php echo "<span class=error>*" . $emailErr . "</span>"; ?><br/>
<input type="submit" value="验证" />
</form>
</body>
</html>