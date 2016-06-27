<?php
try {
    $mbd = new PDO('mysql:host=localhost;dbname=aluvidriosf3', 'root', '');
    

     $result = mysqli_query($mysqli,"SELECT * from operarios");   
          }

    }
    $mbd = null;
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>