<?php

	require '/var/www/vendor/autoload.php';

	$name = $_POST['name'];
	$age = $_POST['age'];
	
	//test the post data
	echo "<p>Name: $name and Age: $age</p>";
	
	$connection = new MongoDB\Client("mongodb://root:mongopwd@mongo:27017");
	
	$db = $connection->gettingstarted;
	echo "db 'gettingstarted' selected<br><br>";
	$col = $db->users;
	echo "Collection $col selected<br><br>";
	
	$doc = ["name" => $name,"age" => $age];
	
	$col->insertOne($doc);
	echo "<p>User inserted successfully: ";
	
	
	$record = $col->find( [ 'name' =>$name] );  
    foreach ($record as $user) {  
        echo $user['name'], ': ', $user['age']."</p>";  
    }


?>
