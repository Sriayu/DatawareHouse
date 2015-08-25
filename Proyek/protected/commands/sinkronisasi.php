<?php
    $dbname2 = "warehouse_db";
    $table2 = "tbl_database";
//---------------------------------------- KHUSUS SERVER ------------------------------------------------------------------------------

    $host2 = "127.0.0.1";
    $userid2 = "root";
    $passwd2 = "";
    $port2 = "3306";
    $linkServer = mysql_connect($host2,$userid2,$passwd2);
    $dbServer = mysql_query("SHOW DATABASES");
    
    $result = mysql_query("SELECT * FROM $dbname2.$table2");
    
  while($row1 = mysql_fetch_array($result))
         {
    while ($rowServer = mysql_fetch_assoc($dbServer))
    {
         $databaseServer = $rowServer['Database'];
         if ($databaseServer == $row1['database_name'])
         {
//---------------------------------------- KHUSUS LOKAL ------------------------------------------------------------------------------
    $host1 = "127.0.0.1";
    $userid1 = "root";
    $passwd1 = "";
    $port1 = "3306";
    
    $linkLokal = mysql_connect($host1,$userid1,$passwd1);
    $dbLokal = mysql_query("SHOW DATABASES");
      
    while ($row = mysql_fetch_assoc($dbLokal))
    {
         $databaseLokal = $row['Database'];
         
         if ($databaseLokal == $row1['database_local'])
         {
            $resultTableServer = mysql_query("SHOW TABLES FROM ".$databaseServer."");
                 
              while ($rowServerKolom = mysql_fetch_row($resultTableServer))
              {
                  $tblServer = "{$rowServerKolom[0]}\n";
                  //echo $tblServer;
                  
                  $resultTableLokal = mysql_query("SHOW TABLES FROM ".$databaseLokal."");
                  while ($rowLokalKolom = mysql_fetch_row($resultTableLokal))
                  {
                      $tblLokal = "{$rowLokalKolom[0]}\n";
                      if ($tblLokal == $tblServer)
                      {
//                          echo $tblLokal;
//                          echo $tblServer;
                          $sql = "DROP TABLE $tblLokal";
                          mysql_select_db($databaseLokal);
                          if (mysql_query($sql))
                          {
                              //echo "Drop berhasil";
                              
                              $sql = "CREATE TABLE $databaseLokal.$tblLokal SELECT * FROM $databaseServer.$tblServer";
                            if (mysql_query($sql, $linkLokal))
                            {
                                echo "Update Tabel berhasil";
                            }else{
                                //echo "Create Tabel Gagal";
                                //echo mysql_error();
								continue;
                            }
                          }
                          else {
//                              echo "Drop Gagal";
//                              echo "<br/>";
                              //echo mysql_error();
							  continue;
                          }
                      }
                  }
              }
          }
      } 
//---------------------------------------- KHUSUS LOKAL ------------------------------------------------------------------------------
//---------------------------------------- KHUSUS SERVER ------------------------------------------------------------------------------
             }
         }
    }
?>