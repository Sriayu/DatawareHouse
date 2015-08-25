<?php
$link = mysql_connect('127.0.0.1', 'root', '');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$dbname2 = "warehouse_db";
$table2 = "tbl_database";
?>
<?php CHtml::encode(Yii::app()->name); ?>
<html>
    <head><title></title>
        <meta charset="utf-8">
        <title>jsTree test</title>
        <!-- 2 load the theme CSS file -->
        <script src="dist/libs/jquery.js"></script>
        <!-- 5 include the minified jstree source -->
        <script src="dist/jstree.min.js"></script>
        <!--  Agar item bisa di drag pakai js ini-->
        <script src="js/jquery-ui.js"></script>

        <link rel="stylesheet" href="dist/themes/default/style.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.css">
        <style> 
            #canvas {float: right; width: 100%; min-height: 10em; padding:0px; position:  relative;}
            #input {float: right; width: 13%; min-height: 10em; padding: 0px 20px 35px 40px; position:  absolute;}
        </style>
    </head>
    <body>
        <form method="post" action="" id="form" name="myform2">
            <table style=" border: 2px;" >
                <tr>
                    <td colspan="3">
                        <?php
                        /* @var $this RequestController */
                        /* @var $model Request */
                        $this->breadcrumbs = array(
                            'Simpan Database',
                        );
//$this->widget('ext.menu.EMenu', array('items' => $items));
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><a href ="<?php echo $this->createURL('tblServer/create'); ?>"><img title="Add database" src="<?php echo Yii::app()->request->baseUrl; ?>/images/db.jpg"></img>  </td>
                    <td align="left" colspan="2"><a href ="<?php  echo $this->createURL('tblServer/setting');            ?>"><img title="Setting" src="<?php echo Yii::app()->request->baseUrl; ?>/images/syn.jpg"></img>  </td>
                    <td title="Drop here" rowspan="2" id="canvas" class="ui-widget-content ui-state-default ui-widget-header"></td>
                    <td id="input">  
                        <INPUT TYPE="text" NAME="output" title="Table output name" />
                        <font color="grey" size= 1px align="center"><br><i><b>Masukkan nama tabel output<br>kemudian ENTER </b></i></font><br><br>
                    </td>
                </tr>
                <tr>

                    <td colspan="2" id="jstree" title="Databases" class="ui-widget ui-helper-clearfix">
                        <?php
                        $res = mysql_query("SHOW DATABASES");

                        while ($row = mysql_fetch_assoc($res)) {
                            $result = mysql_query("SELECT * FROM $dbname2.$table2");

                            while ($row1 = mysql_fetch_array($result)) {
                                if ($row['Database'] == $row1['database_local']) {
                                    $resultTable = mysql_query("SHOW TABLES FROM " . $row['Database']);
                                    $table_count = mysql_num_rows($resultTable);
                                    $database = $row['Database'];
                                    ?><ul id="gallery" class="gallery ui-helper-reset ui-helper-clearfix"><li><?php echo $database . "  (" . $table_count . ")"; ?> <ul><?php
                                                while ($row = mysql_fetch_row($resultTable)) {
                                                    $tbl = "{$row[0]}\n";
                                                    $qColumnNames = mysql_query("SHOW COLUMNS FROM " . $database . ".$tbl") or die("mysql error");
                                                    $fields_count = mysql_num_rows($qColumnNames);
                                                    ?><li class="ui-widget-content ui-corner-tr"><?php echo $tbl . " (" . $fields_count . ")"; ?><ul><?php
                                                            while ($row = mysql_fetch_row($qColumnNames)) {
                                                                ?><li><?php echo "{$row[0]}\n"; ?></li><?php }
                                                            ?></ul></li><?php }
                                                        ?></ul></li></ul><?php
                                }
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $this->menu = array(
                            array('label' => 'Server Connection', 'url' => array('create')),
                            array('label' => 'Add Host Profile', 'url' => array('tambah')),
                        );
                        ?>
                    </td>
                </tr>
                <!-- 4 include the jQuery library -->
            </table>
        </form>
    </body>
    <script>
        $(function() {
            // 6 create an instance when the DOM is ready
            $('#jstree')
                    .jstree(
                            /* {
                             "themes":
                             {
                             "theme": "applet",
                             "dots": true,
                             "icons": true,
                             }
                             "types":
                             {
                             "dnd" : {
                             "copy_modifier" : false,
                             "drag_check" : function (data)
                             {
                             return {
                             after : true,
                             before : true,
                             inside : true
                             };   
                             }
                             }
                             }
                             
                             }*/
                            );
            // 7 bind to events triggered on the tree
            $('#jstree').on("changed.jstree", function(e, data) {
                console.log(data.selected);
            });
            // 8 interact with the tree - either way is OK
           /* 
            $('button').on('click', function() {
            $('#jstree').jstree(true).select_node('child_node_1');
            $('#jstree').jstree('select_node', 'child_node_1');
            $.jstrwee.reference('#jstree').select_node('child_node_1');
            });
           */
                var $jstree = $("#jstree"),
                    $canvas = $("#canvas");
                    // let the jstree items be draggable
                    $("li", $jstree).draggable({
                        cancel: "a.ui-icon", // clicking an icon won't initiate dragging
                        revert: "invalid", // when not dropped, the item will revert back to its initial position
                        containment: "document",
                        helper: "clone",
                        cursor: "move",
                        repeat:true
                    });

                    // let the canvas be droppable, accepting the jstree items
                    $canvas.droppable({
                        accept: "ul > li",
                        activeClass: "ui-state-highlight",
                        drop: function(event, ui) {
                            deleteTree(ui.draggable);
                        }
                    });
                    // let the jstree be droppable as well, accepting items from the canvas
                    $jstree.droppable({
                        accept: "#canvas li",
                        activeClass: "custom-state-active",
                        drop: function(event, ui) {
                            recycleTree(ui.draggable);

                        }
                    });
                    // Tree deletion function
                    var recycle_icon = "<a href='link/to/recycle/script/when/we/have/js/off' title='Recycle this Tree' class='ui-icon ui-icon-refresh'>Recycle Tree</a>";
                    function deleteTree($item) {
                        $item.fadeOut(function() {
                            var $list = $("ul", $canvas).length ?
                                    $("ul", $canvas) :
                                    $("<ul class='jstree ui-helper-reset'/>").appendTo($canvas);
                            $item.find("a.ui-icon-canvas").remove();
                            $item.append(recycle_icon).appendTo($list).fadeIn(function() {
                                $item
                                        .animate({width: "48px"})
                                        .find("img")
                                        .animate({height: "36px"});
                            });
                        });
                    }
                    
    
                    // Tree recycle function
                    var canvas_icon = "<a href='link/to/canvas/script/when/we/have/js/off' title='Delete this Tree' class='ui-icon ui-icon-canvas'>Delete Tree</a>";
                    function recycleTree($item) {
                        $item.fadeOut(function() {
                            $item
                                    .find("a.ui-icon-refresh")
                                    .remove()
                                    .end()
                                    .css("width", "96px")
                                    .append(canvas_icon)
                                    .find("img")
                                    .css("height", "72px")
                                    .end()
                                    .appendTo($jstree)
                                    .fadeIn();
                        });
                    }

                    // Tree preview function, demonstrating the ui.dialog used as a modal window
                    function viewLargerTree($link) {
                        var src = $link.attr("href"),
                                title = $link.siblings("img").attr("alt"),
                                $modal = $("img[src$='" + src + "']");

                        if ($modal.length) {
                            $modal.dialog("open");
                        } else {
                            var img = $("<img alt='" + title + "' width='384' height='288' style='display: none; padding: 8px;' />")
                                    .attr("src", src).appendTo("body");
                            setTimeout(function() {
                                img.dialog({
                                    title: title,
                                    width: 400,
                                    modal: true
                                });
                            }, 1);
                        }
                    }
                    // resolve the icons behavior with event delegation
                    $("ul.jstree > li").click(function(event) {
                        var $item = $(this),
                                $target = $(event);
                        if ($target.is("a.ui-icon-canvas")) {
                            deleteTree($item);
                        } else if ($target.is("a.ui-icon-zoomin")) {
                            viewLargerTree($target);
                        } else if ($target.is("a.ui-icon-refresh")) {
                            recycleTree($item);
                        }
                        return false;
                    });
        });
    </script>
</html>
<?php
if (isset($_POST['output'])) {
    $tbl = $_POST['output'];

    $tabelOut = new TblOutput;
    $tabelOut->tbl_output_name = $tbl;
    echo '<h2>Output text field = ' . $tbl . '</h2>';
}
//} else if (empty($_POST['output'])) {
//    echo '<i>Text field empty</i>';
//}
?>