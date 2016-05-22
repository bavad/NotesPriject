<?php  
$dbhost = 'localhost';
  $dbname = 'users';
  $m = new Mongo("mongodb://$dbhost");
  $db = $m->$dbname;
  $collection = $db->users;

  $cursor = $collection->find();
  session_start();
  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>Вход</title>
</head>

<body>
<script src="js/bootstrap.min.js"></script>
<div align="center">
  <h1>Пожалуйста, войдите</h1>
</div>
<div style="width:900px;padding-left:470px">
<form action="" method="post" enctype="multipart/form-data">
<label >Логин:</label>
<input name="login" class="form-control" type="text" size="25" pattern="[-a-zA-Z0-9]{3,15}" required><br/>
<label >Пароль:</label>
<input name="password" class="form-control" type="password" size="25" pattern="[-a-zA-Z0-9]{3,30}" required><br/>

<button name="submit" type="submit" class="btn btn-success">Войти</button>
<a class="btn btn-default"  role="button" href="registration.php">Или зарегистрироваться</a></br></br>
</form>
</div>

<div align="center" id="error" style="width:900px;padding-left:470px"> 
<?php  
if(isset($_POST['submit'])){ 
  $login = $_POST['login']; 
  $password = md5($_POST['password']); 
  $f=false;
  foreach ($cursor as $document) {
	if ($document['login']==$login && $document['password']==$password){
		$f=true;
		break;
	}
  }
  if($f==true){   
  echo '<div class="alert alert-success" role="alert">Вы успешно авторизировались!</div>';
  $_SESSION['login']=$login;

  echo '<p><a class="btn btn-success"  role="button" href="cab.php">Перейти к заметкам</a></p>';
  }else{  
  echo '<div class="alert alert-danger" role="alert">Неправильный логин или пароль!</div>';  
  }  
   
  }  
 
?>
</div>
</body>
</html>