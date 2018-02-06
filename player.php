<?php  
  
 


function PLAYER_USER_CREATE($appid, $user, $pass ,$email )
{
  //existe player?
  
  $stmt = SQLITEexecSQL('SELECT * FROM  player 
            WHERE appid = :appid AND user = :user  ', 
            
            array(':appid' => $appid  , ':user' => $user  )   ); 
    
  $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  foreach ($arr as $titleData) 
  { 
    echo  json_encode(array('rest' => -1 ) );
    exit(); 
  } 

  
	
 //==================== ingresar 	
    $clave = hash('sha256', $pass);

    $stmt = SQLITEexecSQL('INSERT INTO player(appid,user,pass,email) VALUES(:appid,:user,:pass,:email)', 
            array(':appid' => $appid , ':user' => $user,  ':pass' => $clave ,   ':email' => $email )   );
    
    if ( $stmt->rowCount() > 0)     
     echo  json_encode(array('rest' => 1 ) ); 
    else
     echo  json_encode(array('rest' => 0 ) ); 
      
      
   exit();
        
}




 





function PLAYER_USER_LIST($appid )
{
    $stmt = SQLITEexecSQL('SELECT user,email FROM  player WHERE appid = :appid', 
            array(':appid' => $appid    )   );
 
    
 $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
 
 $registros = json_encode(array('rest' => 1 , 'list' => $arr)  );
 
 if (count($arr) > 0)
   echo  $registros; 
 else
   echo  json_encode(array('rest' => 0  )  );     //vacio
      
  exit();  
}




function PLAYER_USER_LOGIN($appid , $user, $pass)
{   
 
 if ( VerificarCredencialesUSER($appid , $user, $pass)    )   
 {  
     Login_Insert_Record($appid , $user);
   
     echo  json_encode(array('rest' => 1 ) ); 
 }
  
 exit();   
}





function PLAYER_USER_CATALOG_UPLOAD($appid, $user , $code, $data )
{     
   SQLITEexecSQL('DELETE FROM player_catalog WHERE appid = :appid AND user = :user AND code = :code ',
              array(':appid' => $appid , ':user' => $user,  ':code' => $code)
              );  //borra el actual catalogo
   
   
    $stmt = SQLITEexecSQL('INSERT INTO player_catalog(appid,user,code, data) VALUES(:appid,:user, :code, :data)', 
            array(':appid' => $appid , ':user' => $user,  ':code' => $code , ':data' => $data )   );
    
    if ( $stmt->rowCount() > 0)     
     echo  json_encode(array('rest' => 1 ) ); 
    else
     echo  json_encode(array('rest' => 0 ) ); 
      
      
   exit();
        
}





function PLAYER_USER_CATALOG_GET($appid, $user , $code )
{
    $stmt = SQLITEexecSQL('SELECT data FROM  player_catalog 
		WHERE appid = :appid  AND user = :user AND code = :code', 
            array(':appid' => $appid , ':user' => $user, ':code' => $code   )   );
 
    
 $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
  
 
 if (count($arr) > 0)
   echo  json_encode(array('rest' => 1 ,'list' => $arr ) ); 
 else
   echo  json_encode(array('rest' => 0  )  );     //vacio
      
  exit();  
}



 
 
 
 
 
 
 

  //====================================================================
//====================================================================
//====================================================================


if (isset( $_POST["pp"] ))
{
 
 //crear player 
 if ( $_POST["pp"] == 4000   
     &&  isset( $_POST["appid"]) && isset( $_POST["apppass"])	 
     &&  isset( $_POST["user"]) &&  isset( $_POST["userpass"])
     &&  isset( $_POST["email"])	  
 )  
 {	 
  
   if (VerificarCredencialesAPP($_POST["appid"], $_POST["apppass"]  )      )	   
   {    
	PLAYER_USER_CREATE($_POST["appid"], $_POST["user"], $_POST["userpass"] , $_POST["email"] );
   }
   
 }
 //=====================
 


 //listar players 
 if ( $_POST["pp"] == 4100   
     &&  isset( $_POST["appid"]) && isset( $_POST["apppass"])	 
     
	  
 )  
 {	 
  
   if (VerificarCredencialesAPP($_POST["appid"], $_POST["apppass"]  )      )	   
   {    
	PLAYER_USER_LIST($_POST["appid"]  );
   }
   
 }
 //=====================
  
 
  // player login 
 if ( $_POST["pp"] == 4200   
     &&  isset( $_POST["appid"]) && isset( $_POST["apppass"])	 
     &&  isset( $_POST["user"]) &&  isset( $_POST["userpass"])
	  
 )  
 {	 
  
   if (VerificarCredencialesAPP($_POST["appid"], $_POST["apppass"]  )      )	   
   {    
	PLAYER_USER_LOGIN($_POST["appid"], $_POST["user"], $_POST["userpass"] );
   }
   
 }
 //=====================

 
 
   // player up catalog 
 if ( $_POST["pp"] == 4300   
     &&  isset( $_POST["appid"]) && isset( $_POST["apppass"])	 
     &&  isset( $_POST["user"]) &&  isset( $_POST["userpass"])
	 &&  isset( $_POST["cat_code"]) &&  isset( $_POST["data"])
	 
	  
 )  
 {	 
  
   if (VerificarCredencialesAPP($_POST["appid"], $_POST["apppass"]  )      &&
       VerificarCredencialesUSER($_POST["appid"], $_POST["user"], $_POST["userpass"])    ) 	   
   {    
	PLAYER_USER_CATALOG_UPLOAD($_POST["appid"], $_POST["user"], $_POST["cat_code"],
					$_POST["data"] );
	
	 
   }
   
 }
 //=====================

 
 
 
   // player DWN catalog 
 if ( $_POST["pp"] == 4400   
     &&  isset( $_POST["appid"]) && isset( $_POST["apppass"])	 
     &&  isset( $_POST["user"]) &&  isset( $_POST["userpass"])
	 &&  isset( $_POST["cat_code"])  
	 
	  
 )  
 {	 
  
   if (VerificarCredencialesAPP($_POST["appid"], $_POST["apppass"]  )      &&
       VerificarCredencialesUSER($_POST["appid"], $_POST["user"], $_POST["userpass"])    ) 	   
   {    
	PLAYER_USER_CATALOG_GET($_POST["appid"], $_POST["user"], $_POST["cat_code"]	  );
	
	 
   }
   
 }
 //=====================

 
 
}//if isset pp

 
?>