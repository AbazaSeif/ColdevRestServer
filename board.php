<?php  
  
 


 function BOARD_SCORE_UPLOAD($appid, $boardcode, $user, $score  )
{
     

    $stmt = SQLITEexecSQL('INSERT INTO board(appid,boardcode,user,score) 
     				VALUES(:appid,:boardcode,:user,:score)', 
            array(':appid' => $appid , ':boardcode' => $boardcode,  ':user' => $user,  ':score' => $score 
              )   );
    
    if ( $stmt->rowCount() > 0)     
     echo  json_encode(array('rest' => 1 ) ); 
    else
     echo  json_encode(array('rest' => 0 ) ); 
      
      
   exit();
        
}




function BOARD_SCORE_LIST($appid , $boardcode, $fechadesde, $fechahasta, $resultcount )
{
	$cadenaGroup = '';  //fix resultados repetidos
	if (isset($_POST["notrepeat"])  )  $cadenaGroup = ' GROUP BY user ';
	
	
    $stmt = SQLITEexecSQL('SELECT DISTINCT user,score, scoredate FROM  board 
    			WHERE appid = :appid AND boardcode = :boardcode
    			AND scoredate BETWEEN :fechadesde AND :fechahasta
				'.$cadenaGroup.'
                      ORDER BY score DESC, scoredate DESC					  
                      LIMIT :resultcount',
                       
            array(':appid' => $appid , ':boardcode' => $boardcode, 
                  ':fechadesde' => $fechadesde , ':fechahasta' => $fechahasta , ':resultcount' => $resultcount    )   );
 
    
 $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
 
 $registros = json_encode(array('rest' => 1 , 'list' => $arr)   );
 
 if (count($arr) > 0)
   echo  $registros; 
 else
   echo  json_encode(array('rest' => 2  )  );     //vacio
      
  exit();  
}










//====================================================================
//====================================================================
//====================================================================


if (isset( $_POST["pp"] ))
{
 
 //subir puntaje 
 if ( $_POST["pp"] == 2000   
     && isset( $_POST["appid"]) && isset( $_POST["apppass"])
     && isset( $_POST["user"])  && isset( $_POST["userpass"])
	 && isset( $_POST["boardcode"]) && isset( $_POST["score"] )
 )  
 {	 
  
   if (VerificarCredencialesAPP($_POST["appid"], $_POST["apppass"]  )   &&
	   VerificarCredencialesUSER($_POST["appid"], $_POST["user"], $_POST["userpass"]) )	   
   {    
	BOARD_SCORE_UPLOAD($_POST["appid"], $_POST["boardcode"], $_POST["user"], $_POST["score"] );
   }
   
 }
 //=====================
 
 
  //descargar puntaje 
 if ( $_POST["pp"] == 2100   
     && isset( $_POST["appid"]) && isset( $_POST["apppass"])
     &&  isset( $_POST["boardcode"]) &&  isset( $_POST["date1"])
	 &&  isset( $_POST["date2"])    &&  isset( $_POST["count"] )
 )  
 {	 
  
   if (VerificarCredencialesAPP($_POST["appid"], $_POST["apppass"]  )      )	   
   {    
	BOARD_SCORE_LIST($_POST["appid"], $_POST["boardcode"], 
	$_POST["date1"], $_POST["date2"], $_POST["count"] );
   }
   
 }
 //=====================
 
 
 
}//if isset pp

 
  
?>