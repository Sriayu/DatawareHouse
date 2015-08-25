<?php

class TblOutputController extends Controller
{
/**
 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
 * using two-column layout. See 'protected/views/layouts/column2.php'.
 */
public $layout = '//layouts/column2';

/**
 * @return array action filters
 /*Menu : Add User/Admin
* Pengguna : user dengan hak akses role admin
* Fungsi : Untuk menambahkan pengguna yang dapat mengakses aplikasi
* Parameter : tidak ada
* Algortma : 1. Pengguna memilih menu Add User/Admin
* 2. Kemudian aplikasi akan menampilkan form untuk menambah pengguna yang mengakses aplikasi
* 3. Setelah mengisi form dan menekan tombol register
* 4. Aplikasi akan mencek apakah username yang dimasukkan sudah ada atau belum pada tabel t_user
* 5a. Jika belum ada aplikasi akan menyimpan data ke dalam table t_user, lalu aplikasi render ke halaman admin dari tabel t_output
* 5b. Jika sudah ada aplikasi akan render ke halaman ke halaman untuk register pengguna baru
*/

public function filters()
{
//		return array(
//			'accessControl', // perform access control for CRUD operations
//			'postOnly + delete', // we only allow deletion via POST request
//		);

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
public function accessRules()
{
return array(
array('allow', // allow all users to perform 'index' and 'view' actions
'actions' => array(),
 'users' => array('*'),
 ),
 array('allow', // allow authenticated user to perform 'create' and 'update' actions
'actions' => array('admin'),
 'users' => array('@'),
 ),
 array('allow', // allow admin user to perform 'admin' and 'delete' actions
'actions' => array('delete', 'index', 'view', 'create', 'update'),
 'users' => array('admin'),
 ),
 array('deny', // deny all users
'users' => array('*'),
 ),
);
}

/**
 * Displays a particular model.
 * @param integer $id the ID of the model to be displayed
 */
public function actionView($id)
{
$this->render('view', array(
'model' => $this->loadModel($id),
));
}

/**
 * Creates a new model.
 * If creation is successful, the browser will be redirected to the 'view' page.
 */
public function actionCreate()
{
$model = new TblOutput;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['TblOutput']))
{
$model->attributes = $_POST['TblOutput'];
if($model->save())
$this->redirect(array('view', 'id' => $model->code_table));
}

$this->render('create', array(
'model' => $model,
));
}

/**
 * Updates a particular model.
 * If update is successful, the browser will be redirected to the 'view' page.
 * @param integer $id the ID of the model to be updated
 */
public function actionUpdate($id)
{
$model = $this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['TblOutput']))
{
$model->attributes = $_POST['TblOutput'];
if($model->save())
$this->redirect(array('view', 'id' => $model->code_table));
}

$this->render('update', array(
'model' => $model,
));

/* Menu : Add User/Admin
 * Pengguna : user dengan hak akses role admin
 * Fungsi : Untuk menambahkan pengguna yang dapat mengakses aplikasi
 * Parameter : tidak ada 
 * Algortma : 1. Pengguna memilih menu Add User/Admin
 *            2. Kemudian aplikasi akan menampilkan form untuk menambah pengguna yang mengakses aplikasi 
 *            3. Setelah mengisi form dan menekan tombol register 
 *            4. Aplikasi akan mencek apakah username yang dimasukkan sudah ada atau belum pada tabel t_user
 *            5a. Jika belum ada aplikasi akan menyimpan data ke dalam table t_user, lalu aplikasi render ke halaman admin dari tabel t_output
 *            5b. Jika sudah ada aplikasi akan render ke halaman ke halaman untuk register pengguna baru
 */

}

/**
 * Deletes a particular model.
 * If deletion is successful, the browser will be redirected to the 'admin' page.
 * @param integer $id the ID of the model to be deleted
 */
public function actionDelete($id)
{
$this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
if(!isset($_GET['ajax']))
$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
}

/**
 * Lists all models.
 */
public function actionIndex()
{
$dataProvider = new CActiveDataProvider('TblOutput');
$this->render('index', array(
'dataProvider' => $dataProvider,
));
}

/**
 * Manages all models.
 */
/* Menu : List Table
 * Pengguna  : user dengan hak akses role admin
 * Fungsi    : untuk menampilkan semua nama tabel yang direlasikan
 * Parameter : tidak ada 
 * Algortma  : 1. Pengguna memilih menu List Table
 *             2. Aplikasi akan menampilkan daftar tabel output yang terdapat di dalam database
 */
public function actionAdmin()
{
$model = new TblOutput('search');
$model->unsetAttributes();  // clear any default values
if(isset($_GET['TblOutput']))
$model->attributes = $_GET['TblOutput'];
$this->render('admin', array(
'model' => $model,
));
}

/**
 * Returns the data model based on the primary key given in the GET variable.
 * If the data model is not found, an HTTP exception will be raised.
 * @param integer $id the ID of the model to be loaded
 * @return TblOutput the loaded model
 * @throws CHttpException
 */
public function loadModel($id)
{
$model = TblOutput::model()->findByPk($id);
if($model===null)
throw new CHttpException(404, 'The requested page does not exist.');
return $model;
}

/**
 * Performs the AJAX validation.
 * @param TblOutput $model the model to be validated
 */
protected function performAjaxValidation($model)
{
if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-output-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
}
