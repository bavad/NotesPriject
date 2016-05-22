
<?php  
$dbhost = 'localhost';
  $dbname = 'users';
  $m = new Mongo("mongodb://$dbhost");
  $db = $m->$dbname;
  $collection = $db->users;

  $cursor = $collection->find();
  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>Регистрация</title>
</head>

<body>
<script src="js/bootstrap.min.js"></script>
<div align="center">
  <h1>Пожалуйста, зарегестрируйтесь</h1>
</div>
<div style="width:900px;padding-left:470px">
<form action="" method="post" enctype="multipart/form-data">
<label >Логин:</label>
<input name="login" class="form-control" type="text" size="25"><br />
<label >Пароль:</label>
<input name="password" class="form-control" type="password" size="25"><br />
<label >Повторите пароль:</label>
<input name="password2" class="form-control" type="password" size="25"><br />
<label >E-mail:</label>
<input name="email" class="form-control" type="email" size="25"><br />
<button name="submit" type="submit" class="btn btn-success">Зарегестрироваться</button><br />
</form>
</div>
</br>
<div align="center" id="error" style="width:900px;padding-left:470px">
<?php  
if(isset($_POST['submit'])){ 
$f=true;
foreach ($cursor as $document) {
	if ($document['login']==$_POST['login']){
		$f=false;
		break;
	}
}

if(empty($_POST['login'])){   
echo'<div class="alert alert-danger" role="alert">Вы не ввели логин!</div>';  
  }elseif(!preg_match("/[-a-zA-Z0-9]{3,15}/", $_POST['login'])){ 
echo'<div class="alert alert-danger" role="alert">Некорректный логин!</div>';  
  }elseif(empty($_POST['password'])){   
echo'<div class="alert alert-danger" role="alert">Вы не ввели пароль!</div>';  
  }elseif($f==false){  
echo'<div class="alert alert-danger" role="alert">Пользователь с таким логином уже существует!</div>'; 
  }elseif(!preg_match("/[-a-zA-Z0-9]{3,30}/", $_POST['password'])){   
echo'<div class="alert alert-danger" role="alert">Некорректный пароль!</div>';   
  }elseif(empty($_POST['password2'])){ 
echo'<div class="alert alert-danger" role="alert">Вы не ввели подтверждение пароля!</div>'; 
  }elseif(!preg_match("/[-a-zA-Z0-9]{3,30}/", $_POST['password2'])){   
echo'<div class="alert alert-danger" role="alert">Некорректное подтверждение пароля!</div>';   
  }elseif($_POST['password'] != $_POST['password2']){   
echo'<div class="alert alert-danger" role="alert">Пароли не совпадают!</div>'; 
  }else{ 
  $login = $_POST['login'];   
  $password = md5($_POST['password']); 
  $email = $_POST['email'];
  $t=array();
  $ins=array("login"=>$login,"password"=>$password,"email"=>$email, "notes"=>$t); 
  $collection->insert($ins);
  echo '<div class="alert alert-success" role="alert">Вы успешно зарегестрированы!</div>';
  echo '<p><a class="btn btn-success"  role="button" href="index1.php">Войти</a></p>';
    
   
  }  
}  
?>
</div>
</body>
</html>