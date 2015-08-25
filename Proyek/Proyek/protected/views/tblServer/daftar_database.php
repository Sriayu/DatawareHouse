<?php
//$this->breadcrumbs=array(
//	'Tbl Servers'=>array('index'),
//	$model->id,
//);
$this->menu=array(
	array('label'=>'Koneksi Server', 'url'=>array('create')),
	array('label'=>'Tambah Profile Host', 'url'=>array('tambah')),
);

        $host = $model->host;
        $userid = $model->username;
        $passwd = $model->password;
        $port = $model->port;
     $link =  mysql_connect( $host, $userid, $passwd );
        
//         $connectionString = 'mysql:host='.$host.';port='.$port.';dbname=NULL';
//        $connection=new CDbConnection($connectionString, $userid, $passwd);
//        $connection->emulatePrepare = true;
//        $connection->charset = 'utf8';
//        $connection->active=true;
        if($link)
        {
           

//          throw new CHttpException(500,'An active "db" connection is required to run this generator.');

            ?><html>
                <body>
                    <form method="post" action="" id="form" name="myform">
            <table>
                <tr>
                    <td>
                        Daftar Database yang tersedia : 
                    </td>
                    <tr>
                        <td>
                        <?php
                            $res = mysql_query("SHOW DATABASES");

                            while ($row = mysql_fetch_assoc($res)) {
                                $nama = $row['Database'];
                                ?><input type="checkbox" name ="database" value="<?php echo $nama; ?>"><?php
                                echo $nama . "<br />";
                                ?><?php
                            }
                        ?> 
                       </td>
                </tr>
                <tr>
                    <td> <input type="submit" name="Simpan" id="Simpan" value="Simpan" /></td>
                </tr>
            </table>
                        </form>
                </body>
            </html><?php
        }
        else {
            die('Could not connect ');

         }
?>