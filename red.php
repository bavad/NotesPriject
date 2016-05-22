<?php  
session_start();
$dbhost = 'localhost';
  $dbname = 'users';
  $m = new Mongo("mongodb://$dbhost");
  $db = $m->$dbname;
  $collection = $db->users;

  $cursor = $collection->find();
  $fin=array("login"=>$_SESSION['login'],);

  $document = $collection->findOne($fin);
  
  ?>
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>Редактирование заметок</title>
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
        <li><a href="add.php">Добавить</a></li> 
        <li class="active"><a href="red.php">Редактировать <span class="sr-only">(current)</span></a></li>       
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index1.php">Выйти</a></li>
        
      </ul>
    </div>
  </div>
</nav>

	
	<div style="width:900px;padding-left:470px">
	<form action="" method="post">
	<label >Название заметки:</label>
    <p><select size="1" class="form-control" name="num">
   	<?php
   	for ($i=0;$i<count($document["notes"]);$i++){?>    
    <option value="<?php echo $i ?>"> <?php echo $document["notes"][$i]['name'] ?></option>
   <?php }?>
   <?php $x=$_POST['num'];?>
   </select></p>
   <p><button name="submit1" type="submit" class="btn btn-success">Выбрать</button></p>
  </form>
  </div>
  <div style="width:900px;padding-left:470px">
  	<?php
	 	if(isset($_POST['submit1'])){?>
	 	<form action="" method="post" >
			<label >Название заметки:</label>
			<input name="name1" class="form-control" type="text" size="25" value="<?php echo $document["notes"][$_POST['num']]['name'] ?>"><br/>
            <label >Заметка:</label>
			<textarea name="content1" class="form-control">
			<?php echo $document["notes"][$_POST['num']]['content'] ?>	
			</textarea></br>
			<button name="submit2" type="submit" class="btn btn-success">Изменить</button><br/><br/>
	    </form>
	<?php }?>
  </div>
  <div style="width:900px;padding-left:470px">
  <?php
	 	
	 	if (isset($_POST['submit2'])){
	 		if (empty($_POST['content1'])){
	 			/*$collection->update(array("login"=>$_SESSION['login']),array('$unset' =>$document["notes"][2] ));*/
	 		    $notes = $document["notes"];
	 		    $a=array();
	 		    $i=0;
	 		    foreach ($notes as $doc) { 
	 		    	if($doc['name']!=$_POST['name1']){
	 		    	$y=array("name"=>$doc['name'],"content"=>$doc['content']);
	 		    	$a[$i]=$y; 
	 		    	$i+=1; }             
                }
                $collection->update(array("login"=>$_SESSION['login']),array('$set' =>array("notes"=>$a)));
                echo '<div class="alert alert-success" role="alert">Заметка удалена!</div>';
            } 
            else{
            	$notes = $document["notes"];
	 		    $a=array();
	 		    $i=0;
	 		    foreach ($notes as $doc) { 
	 		    	if($doc['name']!=$_POST['name1']){
	 		    	$y=array("name"=>$doc['name'],"content"=>$doc['content']);
	 		    	$a[$i]=$y; 
	 		    	$i+=1; } 
	 		    	else{
	 		    		$y=array("name"=>$_POST['name1'],"content"=>$_POST['content1']);
	 		    	    $a[$i]=$y; 
	 		    	    $i+=1;
	 		    	}            
                }
                $collection->update(array("login"=>$_SESSION['login']),array('$set' =>array("notes"=>$a)));
                echo '<div class="alert alert-success" role="alert">Заметка изменена!</div>';
            }


	 		/*$name=$_POST['name1'];
			$content=$_POST['content1'];*/
	 		/*$document["notes"][$x-1]['name']=$_POST['name1'];
	 		$document["notes"][$x-1]['content']=$_POST['content1'];
			$collection->save($document);
			
				
			
			/*$collection->update(array("login"=>$_SESSION['login']),array('$set' => array('notes..name'=>$name)));
			$collection->update(array("login"=>$_SESSION['login']),array('$set' => array('notes.$x.content'=>$content)));*/
		}
	 	?>
   </div>


</body>
</html>