<?php
  $dbhost = 'localhost';
  $dbname = 'users';
  $m = new Mongo("mongodb://$dbhost");
  $db = $m->$dbname;
  $collection = $db->users;

  $cursor = $collection->find();
  
  foreach ($cursor as $document) { 

      echo 'Имя: ' . $document['firstname'] . '<br/>'; 
      echo 'Фамилия: ' . $document['surname'] . '<br/>'; 
      echo 'Логин: ' . $document['username'] . '<br/>'; 
      echo 'Пароль: ' . $document['password'] . '<br/>'; 
      echo 'Электронная почта: ' . $document['email'] . '<br/>'; 
      $notes = $document["notes"]; 
      if ($notes==null)
          echo 'Нет заметок <br/>';
      else{
          foreach ($notes as $document) { 
              echo 'Название заметки: ' . $document['name'] . '<br/>'; 
              echo 'Дата создания: ' . $document['date'] . '<br/>'; 
              echo 'Содержание: ' . $document['content'] . '<br/>'; 
          }
          } 
      echo '<br/>'; 
} 
?>
