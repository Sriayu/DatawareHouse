<?php
//$this->breadcrumbs=array(
//	'Tbl Servers'=>array('index'),
//	$model->id,
//);
$this->menu=array(
	array('label'=>'Koneksi Server', 'url'=>array('create')),
	array('label'=>'Tambah Profile Host', 'url'=>array('TambahKoneksi')),
);

        $host = $model->host;
        $userid = $model->username;
        $passwd = $model->password;
        $port = $model->port;
        
//                include_once 'koneksi.php';

     $link =  @mysql_connect( $host, $userid, $passwd );
        if($link)
        {
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
                
            <?php
        }
        else {
            ?>
            <script>
                alert('Koneksi Gagal');
                window.location = 'index.php?r=tblServer/create';
            </script>


</body>
</html>
            <?php

         }
?>