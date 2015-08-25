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
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
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
                'actions' => array('Simpan_database', 'Tambah'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'index', 'view', 'ExistDatabase', 'create', 'update', 'Daftar_database', 'ExistServer'),
                'users' => array('admin'),
            ),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
        );
    }

    public function actionTambah() {
        $model = new TblServer();

        if (isset($_POST['TblServer'])) {
            $model->attributes = $_POST['TblServer'];
            $cek = TblServer::model()->findByAttributes(array('hostname' => $model->hostname));

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
        } else {
            $this->render('tambah', array(
                'model' => $model,
            ));
        }
    }

    public function actionExistServer() {
        if (Yii::app()->request->isAjaxRequest) {

            $this->render('ExistServer', array('model' => $server, 'asDialog' => !empty($_GET['asDialog'])), false, true);
            Yii::app()->end();
        }
    }

    public function actionDaftar_database($id) {
        if (isset($_POST['database'])) {
            $database = $_POST['database'];
            echo $database;
            $server = TblServer::model()->findByAttributes(array('id' => $id));
            $db = TblDatabase::model()->findByAttributes(array('database_name' => $database));
            //var_dump($db);
            if (!$db) {
//                $server = TblServer::model()->findByAttributes(array('id' => $id));
                $table = new TblDatabase();


//                $table->code_table = $code;
//                $table->database_name = "dwh_".$database;
//                $table->database_server = $database;
//                $table->id_server = $server->Id;
                echo "coba";

                $table->database_name = $database;
                $table->id_server = $id;
                $table->database_local = "dwh_" . $database;

                if ($table->save()) {
                    echo "saved";
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

                            $this->render('simpan_database', array(
                                'model' => $this->loadModel($id),
                            ));
                        } else {
                            echo "2";
                            $model = new TblServer();
                            $this->render('create', array(
                                'model' => $model,
                            ));
                        }
                    }
                }
            } else {
                echo "4";
                $this->redirect(array('site/alertDatabase'));
            }
        } else {
            echo "3";
            $this->render('daftar_database', array(
                'model' => $this->loadModel($id),
            ));
        }
    }

    public function actionSimpan_database($id) {
        if (isset($_POST['output']))
        {
        $tbl = $_POST['output'];
        
         $chars = array_merge(range(0, 9));
        shuffle($chars);
        $code = implode(array_slice($chars, 0, 4));
        
        $tbl_output = new TblOutput();
        $tbl_output->code_table = $code;
        $tbl_output->tbl_output_name = $tbl;
        if ($tbl_output->save())
        {
        $model = TblServer::model()->findByAttributes(array('id' => $id));
        $this->render('Simpan_database', array(
            'model' => $model,
        ));
        }
        }else 
        {
           $model = TblServer::model()->findByAttributes(array('id' => $id));
        $this->render('Simpan_database', array(
            'model' => $model,
        )); 
        }
        
    }

    public function actionExistDatabase() {
        if (Yii::app()->request->isAjaxRequest) {

            $this->render('ExistDatabase', array('model' => $server, 'asDialog' => !empty($_GET['asDialog'])), false, true);
            Yii::app()->end();
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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new TblServer;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['TblServer'])) {
            $server = TblServer::model()->findByAttributes(array('id' => $model->id));
            $model->attributes = $_POST['TblServer'];
            $server = TblServer::model()->findByAttributes(array('id' => $model->id));

            echo $model->id;
            $model->attributes = $_POST['TblServer'];
            $server = TblServer::model()->findByAttributes(array('id' => $model->id));

            echo $model->id;

            if ($server) {

                $this->redirect(array('daftar_database', 'id' => $model->id));
            } else {
                echo "Server tidak ditemukan";
                $this->redirect(array('daftar_database', 'id' => $model->id));
//                            $this->render('create',array(
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

}
