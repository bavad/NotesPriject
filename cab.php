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
        <li class="active"><a href="cab.php">Заметки <span class="sr-only">(current)</span></a></li>
        <li><a href="add.php">Добавить</a></li>
        <li><a href="red.php">Редактировать</a></li>        
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index1.php">Выйти</a></li>
        
      </ul>
    </div>
  </div>
</nav>


	
	
	<div align="center" >
		<?php
		
		
		 $notes = $document["notes"];
		 if ($notes==null)
          echo '<div class="alert alert-info" role="alert">Заметки отсутствуют</div>';
         else{
          foreach ($notes as $document) {?> 
          	  <blockquote>
               <?php echo $document['content'];?>
              <footer><?php echo 'Название: ' . $document['name'];?></footer>
              </blockquote><?php
             /* echo 'Название заметки: ' . $document['name'] . '<br/>';               
              //echo 'Содержание: ' . $document['content'] . '<br/><br/>'; ?>
              Заметка:<br/><textarea name="content1" readonly>
			  <?php echo $document['content'] ?>	
			  </textarea></br></br>
          <?php*/
          }
          
      }
		?>
	</div>
</body>
</html>