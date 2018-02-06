<?php  
  
 


 function APP_CREATE($appid, $pass, $email  )
{     
  //existe app?
  
  $stmt = SQLITEexecSQL('SELECT * FROM  apps 
            WHERE appid = :appid  ', 
            
            array(':appid' => $appid   )   ); 
    
  $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  foreach ($arr as $titleData) 
  { 
    echo  json_encode(array('rest' => -1 ) );
    exit(); 
  } 




    //ingresar app ---------

    $clave = hash('sha256', $pass);

    $stmt = SQLITEexecSQL('INSERT INTO apps(appid, pass, email) 
     				VALUES(:appid, :pass, :email)', 
            array(':appid' => $appid , ':pass' => $clave,  ':email' => $email 
              )   );
    
    if ( $stmt->rowCount() > 0)     
     echo  json_encode(array('rest' => 1 ) ); 
    else
     echo  json_encode(array('rest' => 0 ) ); 
      
      
   exit();
        
}









//====================================================================
//====================================================================
//====================================================================


if (isset( $_POST["pp"] ))
{

 if ( $_POST["pp"] == 1000 
     && isset( $_POST["appid"]) && isset( $_POST["pass"])
     &&  isset( $_POST["email"]) 
 ) 
 {	 
    APP_CREATE($_POST["appid"], $_POST["pass"], $_POST["email"]  );
 }
 
 
}
 
  
?>