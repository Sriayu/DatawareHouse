<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }
    /*Menu : Add User/Admin
     * Action : actionRegister
     * Pengguna : user dengan hak akses role admin
     * Fungsi : Untuk menambahkan pengguna yang dapat mengakses aplikasi
     * Parameter : tidak ada 
     * Algortma : 1. Pengguna memilih menu Add User/Admin
     *            2. Kemudian aplikasi akan menampilkan form untuk menambah pengguna yang mengakses aplikasi 
     *            3. Setelah mengisi form dan menekan tombol register 
     *            4. Aplikasi akan mencek apakah username yang dimasukkan sudah ada atau belum pada tabel t_user
     *            5a. Jika belum ada aplikasi akan menyimpan data dengan password yang dihash ke dalam table t_user, lalu aplikasi render ke halaman admin dari tabel t_output
     *            5b. Jika sudah ada aplikasi akan render ke halaman ke halaman untuk register pengguna baru
     */
    
    public function actionRegister() {
        $registration = new RegistrationForm();
        if (Yii::app()->user->id) {
//            $registration = new RegistrationForm;
            if (isset($_POST['RegistrationForm'])) {
                
                
                if (isset($_POST['RegistrationForm'])) {
                    $registration->attributes = $_POST['RegistrationForm'];
                    $cek = TUser::model()->findByAttributes(array('username' => $registration->username));
                    if ($cek){
                    $account = new TUser;
                    $account->username = $registration->username;
                    $account->password = $registration->password;
                    $account->f_name = $registration->f_name;
                    $account->id_role = $registration->id_role;
                    if ($account->save()) {
                        $cek = TUser::model()->findByAttributes(array('id' => $account->id));
                        
                        if ($cek->id_role == 1)
                        {
                            $model = new TMenuPrivileges();
                            $model->user_id = $account->id;
                            $model->menu_id = 1 ;
                            $model->allow_view = 1;
                            $model->allow_admin = 1;
                            if ($model->save())
                            {
                                $model = new TMenuPrivileges();
                                $model->user_id = $account->id;
                                $model->menu_id = 5 ;
                                $model->allow_view = 1;
                                $model->allow_admin = 1;
                                if ($model->save())
                                {
                                    $model = new TMenuPrivileges();
                                    $model->user_id = $account->id;
                                    $model->menu_id = 6 ;
                                    $model->allow_view = 1;
                                    $model->allow_admin = 1;
                                    $model->allow_add = 1;
                                    if ($model->save())
                                    {
                                        $model = new TMenuPrivileges();
                                        $model->user_id = $account->id;
                                        $model->menu_id = 7 ;
                                        $model->allow_view = 1;
                                        $model->allow_admin = 1;
                                        if($model->save())
                                        {
                                            $model = new TMenuPrivileges();
                                            $model->user_id = $account->id;
                                            $model->menu_id = 8 ;
                                            $model->allow_view = 1;
                                            $model->allow_admin = 1;
                                            $model->allow_add = 1;
                                            $model->allow_delete = 1;
                                            $model->allow_edit = 1;
                                            if ($model->save())
                                            {
                                                $model = new TMenuPrivileges();
                                                $model->user_id = $account->id;
                                                $model->menu_id = 9 ;
                                                $model->allow_view = 1;
                                                $model->allow_admin = 1;
                                                $model->allow_add = 1;
                                                $model->allow_delete = 1;
                                                $model->allow_edit = 1;
                                                $model->allow_Daftardatabase = 1;
                                                $model->allow_Simpandatabase = 1;
                                                $model->allow_TambahKoneksi = 1;
                                                $model->allow_Setting = 1;
                                                if($model->save())
                                                {
                                                    $model = new TMenuPrivileges();
                                                    $model->user_id = $account->id;
                                                    $model->menu_id = 10 ;
                                                    $model->allow_view = 1;
                                                    $model->allow_admin = 1;
                                                    $model->allow_add = 1;
                                                    $model->allow_delete = 1;
                                                    if ($model->save())
                                                    {
                                                        $this->redirect(array('tblOutput/admin'));
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }else {
                            $model = new TMenuPrivileges();
                            $model->user_id = $account->id;
                            $model->menu_id = 1 ;
                            $model->allow_view = 1;
                            $model->allow_admin = 1;
                            if ($model->save())
                            {
                                $model = new TMenuPrivileges();
                                $model->user_id = $account->id;
                                $model->menu_id = 5 ;
                                $model->allow_view = 1;
                                $model->allow_admin = 1;
                                if ($model->save())
                                {
                                    $model = new TMenuPrivileges();
                                    $model->user_id = $account->id;
                                    $model->menu_id = 6 ;
                                    $model->allow_view = 1;
                                    if ($model->save())
                                    {
                                        $model = new TMenuPrivileges();
                                        $model->user_id = $account->id;
                                        $model->menu_id = 7 ;
                                        $model->allow_view = 1;
                                        if($model->save())
                                        {
                                            $model = new TMenuPrivileges();
                                            $model->user_id = $account->id;
                                            $model->menu_id = 8 ;
                                            $model->allow_view = 1;
                                            $model->allow_admin = 1;
                                            if ($model->save())
                                            {
                                                $model = new TMenuPrivileges();
                                                $model->user_id = $account->id;
                                                $model->menu_id = 9 ;
                                                $model->allow_view = 1;
                                                $model->allow_admin = 1;
                                                $model->allow_add = 1;
                                                $model->allow_Daftardatabase = 1;
                                                $model->allow_Simpandatabase = 1;
                                                if($model->save())
                                                {
                                                    $model = new TMenuPrivileges();
                                                    $model->user_id = $account->id;
                                                    $model->menu_id = 10 ;
                                                    $model->allow_view = 1;
                                                    $model->allow_admin = 1;
                                                    if ($model->save())
                                                    {
                                                        $this->redirect(array('tblOutput/admin'));
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        
                    } else {
                        echo "1";
                        $this->render('register', array('model' => $registration));
                    }}else {
                        echo "1";
                        $this->render('register', array('model' => $registration));
                    }
                }
            }
// display the registration form
            echo "2";
            $this->render('register', array('model' => $registration));
        } else {
            echo "3";
            $this->render('login');
        }
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('site/login'));
        }
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->redirect(array('tblOutput/admin'));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
    
    
    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    
    /*Menu : Login
     * Action : actionLogin
     * Pengguna : pengguna dengan hak akses role admin atau user
     * Fungsi : untuk mengakses aplikasi sesuasi hak akses role yang digunakan
     * Parameter : tidak ada 
     * Algortma : 1. Pengguna mengisi username dan password pada halaman login 
     *            2. Kemudian aplikasi akan mengecek apakah username dan password yang dimasukan ada pada tabel t_user
     *            3a. Jika username dan password yang sudah di-hash sesuai, pengguna sudah dapat mengakses aplikasi dengan ditampilkannya halaman admin dari tblOutputController
     *            3b. Jika username dan password yang sudah di-hash tidak sesuai, aplikasi akan menampilkan kembali halaman login 
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    
    /*Menu : Logout
     * Action : actionLogout
     * Pengguna : pengguna dengan hak akses role admin atau user
     * Fungsi : untuk keluar dari aplikasi 
     * Parameter : tidak ada 
     * Algortma : 1. Pengguna memilih mnu logout 
     *            2. Kemudian aplikasi akan menjalankan fungsi logout dan pengguna akan keluar dari aplikasi 
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionalertDatabase() {

        $this->render('alertDatabase');
    }
    
    public function actionalertServer(){
        $this->render('alertServer');
    }

}
