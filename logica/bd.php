<?php

function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "sodapp";
 $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
 
 if(!$conn->set_charset("utf8")){
   printf("Error cargando el conjunto de caracteres utf8: %\n", $conn->error);
   exit();
 }

 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }

 function runQuery($c, $query)
 {
   $result = mysqli_query($c,$query);
   while($row=mysqli_fetch_assoc($result)) {
      $resultset[] = $row;
   }		
   if(!empty($resultset))
      return $resultset;
 }
 
?>