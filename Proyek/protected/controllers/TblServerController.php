<?php

class TblServerController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
//        return array(
//            'accessControl', // perform access control for CRUD operations
//            'postOnly + delete', // we only allow deletion via POST request
//        );
        return array(
            'postOnly + delete',
            array('application.components.CheckAuthFilter - error'),
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {

        return array(
//			array('allow',  // allow all users to perform 'index' and 'view' actions
//				'actions'=>array(),
//				'users'=>array('*'),
//			),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('Simpandatabase', 'TambahKoneksi'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'index', 'view', 'create', 'update', 'Daftardatabase','Setting'),
                'users' => array('admin'),
            ),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
        );
    }
    /*Menu : Add Host Profile
     * Pengguna : user dengan hak akses role admin     
     * Action : actionTambahKoneksi
     * Fungsi : Untuk menambahkan server untuk pengakses database
     * Parameter : tidak ada 
     * Algortma : 1. Pengguna memilih menu Add Host Profile
     *            2. Kemudian aplikasi akan menampilkan form untuk menambahkan host profile yang dapat dikoneksikan nantinya
     *            3. Setelah mengisi form dan menekan tombol simpan
     *            4. Aplikasi akan mencek server yang dapat dikoneksikan 
     *            5a. Jika koneksi dapat dilakukan maka akan dilakukan pengecekkan hostname profile yang ditambahkan pada tabel t_server
     *            5a.a. Jika hostname sudah ada maka aplikasi akan manampilkan pop up berisi "Host Profile already exist" alertServer pada view site dan kembali ke halaman form penambahan hostname profile baru 
     *            5a.b. Jika hostname belum ada maka aplikasi akan menyimpan data yang dimasukan ke tabel t_server dan menampilkan halaman untuk koneksi ke server 
     *            5b. Jika koneksi tidak terjadi maka akan menampilkan pop up yang berisi "Tidak bisa simpan hostname karena gagal koneksi", dan aplikasi akan menampilkan halaman form untuk menambahkan hostname profile kembali
     */

    public function actionTambahKoneksi() {
        $model = new TblServer();

        if (isset($_POST['TblServer'])) {
            $model->attributes = $_POST['TblServer'];
            $cek = TblServer::model()->findByAttributes(array('hostname' => $model->hostname));
            $hostname = $model->host;
            $username = $model->username;
            $password = $model->password;
            $link =  @mysql_connect( $hostname, $username, $password );
            if ($link)
            {
            if (!$cek) {
                $model->attributes = $_POST['TblServer'];
                if ($model->save()) {

                    $this->redirect('index.php?r=tblServer/create', array(
                        'model' => $model
                    ));
                }
            } else {
                $this->redirect(array('site/alertServer'));
            }
        }else {
            ?>
                <script>
                alert('Tidak bisa simpan hostname karena gagal koneksi');
                window.location = 'index.php?r=tblServer/TambahKoneksi';
            </script>
            <?php
        }} else {
            $this->render('TambahKoneksi', array(
                'model' => $model,
            ));
        }
    }
    
    /*Menu : Tidak ada karena page akan di-render secara automatis jika terjadi koneksi
     * Action : actionDaftardatabase
     * Pengguna : pengguna dengan hak akses role admin atau user
     * Fungsi : Untuk melakukan pengecekan koneksi dengan hostname server yang dipilih oleh pengguna
     * Parameter : $id yang berisi id dari hostname profile yang dipilih pada saat akan melakukan koneksi 
     * Algortma : 1. Pengguna memilih hostname profile server yang akan koneksi 
     *            2. Aplikasi akan mengecek apakah server yang dipilih dapat koneksi atau tidak 
     *            3a. Jika dapat koneksi aplikasi akan menampilkan selurh database yang ada pada server. Jika pengguna memilih salah satu database dan menekan tombol simpan maka aplikasi akan melakukan pengecekkan kembali.
     *            3a.a. Jika database yang dipilih sudah di-back up maka aplikasi akan menampilkan poop up berisi "Database already exist" dan kembali ke halaman sebelumnya untuk memilih hostname profile untuk koneksi kembali.
     *            3a.b. Jika database belum ada maka aplikasi akan menyimpan database yang dipilih dengan menyimpan nama database pada tabel tbl_database dan menyimpan nama database dan id server asal database yang di-back up, pada lokal dengan nama "dwh_'nama database'"
     *                  Setelah database disimpan aplikasi akan menampilkan halam yang berisi database yang sudah diback-up dengan bentuk tree   
     *            3b. Jika tidak dapat koneksi aplikasi akan menampilkan pop up berisi "Koneksi Gagal" kemudian akan kembali ke halaman untuk memilih hostname profile server kembali.
     */    
    public function actionDaftardatabase($id) {
        if (isset($_POST['database'])) {
            $database = $_POST['database'];
            //echo $database;
            $server = TblServer::model()->findByAttributes(array('id' => $id));
            $db = TblDatabase::model()->findByAttributes(array('database_name' => $database));
            //var_dump($db);
            if (!$db) {
                $table = new TblDatabase();

                $table->database_name = $database;
                $table->id_server = $id;
                $table->database_local = "dwh_" . $database;

                if ($table->save()) {
                    //echo "saved";
                    $host = "127.0.0.1";
                    $userid = "root";
                    $passwd = "";
                    $port = "3306";
                    $link = mysql_connect($host . ':' . $port, $userid, $passwd);
                    $sql = "CREATE DATABASE dwh_" . $database; //test_db seharusnya $_POST['database'], karena ini msh koneksi ke lokalhost, oleh dbuat nama database test_db supaya tidak terjadi perulangan nama databse

                    $cek = 0;
                    if (mysql_query($sql, $link)) {
                        $host2 = $server->host;
                        $userid2 = $server->username;
                        $passwd2 = $server->password;
                        $port2 = $server->port;
                        $link2 = mysql_connect($host2 . ':' . $port2, $userid2, $passwd2);
                        $resultTable = mysql_query("SHOW TABLES FROM " . $database, $link2);

                        while ($row = mysql_fetch_row($resultTable)) {
                            $tbl = "{$row[0]}\n";
                            mysql_connect("127.0.0.1", "root", "");
                            $sql = "CREATE TABLE dwh_$database.$tbl SELECT * FROM $database.$tbl";
                            if (mysql_query($sql, $link)) {
                                $cek = 1;
                            }
                        }
                        if ($cek == 1) {
//                        $dbs = TblOutput::model()->findByAttributes(array('database_name' => $database));
//                        $srv = Server::model()->findByAttributes(array('Id' => $id));

                            $this->render('Simpandatabase', array(
                                'model' => $this->loadModel($id),
                            ));
                        } else {
                            //echo "2";
                            $model = new TblServer();
                            $this->render('create', array(
                                'model' => $model,
                            ));
                        }
                    }
                }
            } else {
                //echo "4";
                $this->redirect(array('site/alertDatabase'));
            }
        } else {
            //echo "3";
            $this->render('Daftardatabase', array(
                'model' => $this->loadModel($id),
            ));
        }
    }
    
    
    /* Menu : Add Table Relation
     * Action : actionSimpandatabase
     * Pengguna : pengguna dengan hak akses role admin atau user
     * Fungsi : Untuk menampilkan database yang sudah diback up dalam bentuk tree view
     * Parameter : Tidak ada 
     * Algortma : 1. Pengguna menu Add Table Relation
     *            2. Aplikasi akan menampilkan halaman yang berisi database yang sudah di back up dengan bentuk tree view
     *            3. Pengguna akan men-drag dan drop tabel dari database yang di back up 
     *            4. Pengguna kemudian akan mengisi kolom nama tabel output yang mewakili tabel yang sudah di-drag dan drop 
     *            5. Setelah menekan enter, aplikasi akan menyimpan nama tabel output pada tabel tbl_output dan nama tabel yang dipilih pada tabel tbl_take 
     */
    public function actionSimpandatabase() {
        if (isset($_POST['output'])) {
            $tbl = $_POST['output'];
            
            $chars = array_merge(range(0, 9));
            shuffle($chars);
            $code = implode(array_slice($chars, 0, 4));

            $tbl_output = new TblOutput();
            $tbl_output->code_table = $code;
            $tbl_output->tbl_output_name = $tbl;
            if ($tbl_output->save()) {
                //$model = TblServer::model()->findByAttributes(array('hostname' => 'localhost'));
                $this->redirect(array('TblOutput/admin'));
               
        }}
        else 
        {
           $model = TblServer::model()->findByAttributes(array('hostname' => 'localhost'));
         $this->render('Simpandatabase', array(
            'model' => $model,
        )); 
        }
    }
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    
    /*Menu : Create Connection 
     * Action : actionCreate
     * Pengguna : penguna aplikasi dengan hak akses role admin dan user
     * Fungsi : Untuk melakukan koneksi dengan server sesuai hostname profile yang tersedia pada tabel t_server
     * Parameter : tidak ada 
     * Algortma : 1. Pengguna memilih menu Create Connection
     *            2. Kemudian aplikasi akan menampilkan drop down list untuk melakukan koneksi dengan server sesuai dengan hostname profile yang telah disimpan pada tabel t_server
     *            3. Setelah pengguna memilih hostname server, aplikasi akan mencek server yang dipilih dapat koneksi atau tidak
     *            4a. Jika koneksi dapat dilakukan maka aplikasi menampilkan seluruh database yang ada pada server yang sudah koneksi pada halaman daftarDatabase melalui tblServerController  
     *            4b. Jika koneksi tidak dapat dilakukan, aplikasi akan menampilkan pop up berisi "Koneksi Gagal", lalu aplikasi akan menampilkan halaman untuk memilih hostname profile untuk koneksi kembali
     */
    public function actionCreate() {
        $model = new TblServer;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['TblServer'])) {
            $server = TblServer::model()->findByAttributes(array('id' => $model->id));
            $model->attributes = $_POST['TblServer'];
            $server = TblServer::model()->findByAttributes(array('id' => $model->id));

            //echo $model->id;
            $model->attributes = $_POST['TblServer'];
            $server = TblServer::model()->findByAttributes(array('id' => $model->id));

            //echo $model->id;

            if ($server) {
//                echo 'HEY';
                $this->redirect(array('Daftardatabase', 'id' => $model->id));
            } else {
                //echo "Server tidak ditemukan";
                $this->redirect(array('Daftardatabase', 'id' => $model->id));
     //                       $this->render('create',array(
//                            'model'=>$model,
//                            ));
            }
        } else {
            //$model=new TblServer;
            $this->render('create', array(
                'model' => $model,
            ));
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['TblServer'])) {
            $model->attributes = $_POST['TblServer'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('TblServer');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new TblServer('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['TblServer']))
            $model->attributes = $_GET['TblServer'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return TblServer the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = TblServer::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param TblServer $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tbl-server-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
     public function actionSetting(){
        $model = new TSetting();
        if (isset($_POST['TSetting'])) {
            $model->attributes = $_POST['TSetting'];        }
        $this->render('setting', array(
            'model' => $model,
        ));
     }
}
