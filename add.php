<?php  
session_start();
$dbhost = 'localhost';
  $dbname = 'users';
  $m = new Mongo("mongodb://$dbhost");
  $db = $m->$dbname;
  $collection = $db->users;
  $fin=array("login"=>$_SESSION['login'],);

  $document = $collection->findOne($fin);
  
  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>Кабинет</title>
</head>

<body>
	<script src="js/bootstrap.min.js"></script>
	<nav class="navbar navbar-default">
  <div class="container-fluid">
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>        
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?php echo $_SESSION['login'];?></a>
    </div>
    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      	<li><a href="cab.php">Заметки</a></li>
        <li class="active"><a href="cab.php">Добавить <span class="sr-only">(current)</span></a></li>
        <li><a href="red.php">Редактировать</a></li>        
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index1.php">Выйти</a></li>
        
      </ul>
    </div>
  </div>
</nav>


	
	<div style="width:900px;padding-left:470px">
		<form action="" method="post" >
			<label >Название заметки:</label>
			<input name="name" class="form-control" type="text" size="25"><br/>
            <label >Заметка:</label>
			<textarea name="content" class="form-control"></textarea></br>
			<button name="submit" type="submit" class="btn btn-success">Добавить</button><br/><br/>
	    </form>
	 </div>
	 <div style="width:900px;padding-left:470px">
	 	<?php
	 	if(isset($_POST['submit'])){
	 		if(empty($_POST['name']))
				echo'<div class="alert alert-danger" role="alert">Вы не ввели название заметки!</div>';
			elseif(empty($_POST['content']))
				echo'<div class="alert alert-danger" role="alert">Вы не написали заметку!</div>';
			else{
				$name=$_POST['name'];
				$content=$_POST['content'];
				
				$not=array("name"=>$name,"content"=>$content);
				/*$document["notes"][count($document["notes"])]=$not;
				$collection->save($document);*/
				$collection->update(array("login"=>$_SESSION['login']),array('$addToSet' => array("notes"=>$not)));
				echo '<div class="alert alert-success" role="alert">Заметка добавлена!</div>';


			}
		}
	 	?>
	 </div>
	
</body>
</html>