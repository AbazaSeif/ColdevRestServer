<?php  
  
 

function GAME_CATALOG_UPLOAD($appid,   $code, $data )
{     
   SQLITEexecSQL('DELETE FROM game_catalog WHERE appid = :appid AND   code = :code ',
              array(':appid' => $appid ,    ':code' => $code)
              );  //borra el actual catalogo
   
   
    $stmt = SQLITEexecSQL('INSERT INTO game_catalog(appid, code, data) VALUES(:appid, :code, :data)', 
            array(':appid' => $appid ,   ':code' => $code , ':data' => $data )   );
    
    if ( $stmt->rowCount() > 0)     
     echo  json_encode(array('rest' => 1 ) ); 
    else
     echo  json_encode(array('rest' => 0 ) ); 
      
      
   exit();
        
}




function GAME_CATALOG_GET($appid,   $code )
{
    $stmt = SQLITEexecSQL('SELECT data FROM  game_catalog 
		WHERE appid = :appid    AND code = :code', 
            array(':appid' => $appid  , ':code' => $code   )   );
 
    
 $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
 
 $registros = json_encode(array('rest' => 1, 'list' => $arr)  );
 
 if (count($arr) > 0)
   echo  $registros ; 
 else
   echo  json_encode(array('rest' => 0  )  );     //vacio
      
  exit();  
}
 

 
  



  
  
  //====================================================================
//====================================================================
//====================================================================


if (isset( $_POST["pp"] ))
{
 
 //subir catalogo 
 if ( $_POST["pp"] == 3000   
     &&  isset( $_POST["appid"]) && isset( $_POST["apppass"])	 
     &&  isset( $_POST["cat_code"]) &&  isset( $_POST["data"])
	  
 )  
 {	 
  
   if (VerificarCredencialesAPP($_POST["appid"], $_POST["apppass"]  )      )	   
   {    
	GAME_CATALOG_UPLOAD($_POST["appid"], $_POST["cat_code"], $_POST["data"] );
   }
   
 }
 //=====================
 
 
 
 
  //descargar catalogo 
 if ( $_POST["pp"] == 3100   
     &&  isset( $_POST["appid"]) && isset( $_POST["apppass"])	 
     &&  isset( $_POST["cat_code"]) 
	  
 )  
 {	 
  
   if (VerificarCredencialesAPP($_POST["appid"], $_POST["apppass"]  )      )	   
   {    
	GAME_CATALOG_GET($_POST["appid"], $_POST["cat_code"]  );
   }
   
 }
 //=====================
 
 
 
 
 
}//if isset pp   
  
?>