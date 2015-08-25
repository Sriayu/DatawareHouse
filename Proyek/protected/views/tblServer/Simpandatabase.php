<?php
//membuat koneksi ke database lokal
$link = mysql_connect('127.0.0.1', 'root', '');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$dbname2 = "warehouse_db";
$table2 = "tbl_database";
?>
<?php CHtml::encode(Yii::app()->name); ?>
<html>
    <head>
        <meta charset="utf-8">
        <!--memuat file javascript yang digunakan untuk treeview dan drag and rop-->
        <script src="dist/libs/jquery.js"></script>
        <script src="dist/jstree.min.js"></script>
        <!--memuat file cascading style sheet untuk treeview-->
        <link rel="stylesheet" href="dist/themes/default/style.min.css" />
        <!--memuat file cascading style sheet untuk canvas-->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.css">
        <style>
            /*style untuk kanvas tempat tree di drop*/
            #canvas {float: right; width: 100%; min-height: 10em; padding:0px; position:  relative;}
            /*style untuk text field tempat nama tabel output*/
            #input {float: right; width: 13%; min-height: 10em; padding: 0px 20px 35px 40px; position:  absolute;}            
        </style>
    </head>
    <body>
        <form method="post" action="" id="form" name="myform2">
            <table style=" border: 2px;" >
                <tr>
                    <td colspan="3">
                        <?php
                        $this->breadcrumbs = array(
                            'Simpan Database',
                        );
                        ?>
                    </td>
                </tr>
                <tr>
                    <!-- Menambahkan gambar di sebelah kiri halaman untuk menambahkan database ke treeview -->
                    <td><a href ="<?php echo $this->createURL('tblServer/create'); ?>"><img title="Add database" src="<?php echo Yii::app()->request->baseUrl; ?>/images/db.jpg"></img>  </td>
                    <!-- Menambahkan gambar di sebelah kiri halaman untuk megatur sinkronisasi update database berupa durasi -->
                    <td align="left" colspan="2"><a href ="<?php echo $this->createURL('tblServer/Setting'); ?>"><img title="Setting" src="<?php echo Yii::app()->request->baseUrl; ?>/images/syn.jpg"></img>  </td>
                    <!-- Letak kanvas-->
                    <td title="Drop here" rowspan="2" id="canvas"  class="drop ui-widget-content ui-state-default ui-widget-header">
                    </td>
                    <!-- Letak text field-->
                    <td id="input">  
                        <INPUT TYPE="text" NAME="output" title="Table output name" />
                        <font color="grey" size= 1px align="center"><br><i><b>Masukkan nama tabel output</b></i></font><br><br>
                        <input type="submit" name="button" value="Save">
                    </td>
                </tr>
                <tr>
                    <!-- Memuat semua database yang telah di-copy ke server lokal -->
                    <td colspan="2" id="jstree" title="Databases" class="dragui-widget-content ui-widget ui-helper-clearfix">
                        <?php
                        $res = mysql_query("SHOW DATABASES");
                        while ($row = mysql_fetch_assoc($res)) {
                            $result = mysql_query("SELECT * FROM $dbname2.$table2");
                            while ($row1 = mysql_fetch_array($result)) {
                                if ($row['Database'] == $row1['database_local']) {
                                    $resultTable = mysql_query("SHOW TABLES FROM " . $row['Database']);
                                    $table_count = mysql_num_rows($resultTable);
                                    $database = $row['Database'];
                                    ?><ul id="gallery" class="gallery ui-helper-reset ui-helper-clearfix"><li ><?php echo $database . "  (" . $table_count . ")"; ?> <ul><?php
                                    while ($row = mysql_fetch_row($resultTable)) {
                                        $tbl = "{$row[0]}\n";
                                        $qColumnNames = mysql_query("SHOW COLUMNS FROM " . $database . ".$tbl") or die("mysql error");
                                        $fields_count = mysql_num_rows($qColumnNames);
                                        ?><li class="ui-widget-content ui-corner-tr" ><?php echo $tbl . " (" . $fields_count . ")"; ?><ul><?php
                                                            while ($row = mysql_fetch_row($qColumnNames)) {
                                                                ?><li><?php echo "{$row[0]}\n"; ?></li><?php }
                                                            ?></ul></li><?php }
                                                        ?></ul></li></ul><?php
                                }
                            }
                        }
                        ?>
                    </td>
                    <!-- 2 buah menu yang terdapat di sebelah kanan halaman-->
                    <td>
                        <?php
                        $this->menu = array(
                            array('label' => 'Server Connection', 'url' => array('create')),
                            array('label' => 'Add Host Profile', 'url' => array('TambahKoneksi')),
                        );
                        ?>
                    </td>
                </tr>
            </table>
        </form>
    </body>
    <script language="javascript">
        $(function() {
            $('#jstree').jstree({
                //memperkenalkan plugin yang digunakan dari jstree
                'plugins': ['dnd']
            });
            //ketika tabel di drag
            $('.drag')
                    .on('mousedown', function(e) {
                        return $.vakata.dnd.start(e, {'jstree': true, 'obj': $(this), 'nodes': [{id: true, text: $(this).text()}]}, '<div id="jstree-dnd" class="jstree-default"><i class="jstree-icon jstree-er"></i>' + $(this).text() + '</div>');
                    });
            $(document)
                    .on('dnd_move.vakata', function(e, data) {
                        var t = $(data.event.target);
                        if (!t.closest('.jstree').length) {

                            if (t.closest('.drop').length) {
                                data.helper.find('.jstree-icon').removeClass('jstree-er').addClass('jstree-ok');
                            }

                            else {
                                data.helper.find('.jstree-icon').removeClass('jstree-ok').addClass('jstree-er');
                            }
                        }
                    })
                    //Setelah tabel di drop di kanvas
                    .on('dnd_stop.vakata', function(e, data) {
                        var t = $(data.event.target);
                        if (!t.closest('.jstree').length) {

                            if (t.closest('.drop').length) {
                                $(data.element).clone().appendTo(t.closest('.drop'));
                            }
                        }
                    });
        }
        );
    </script>
</html>