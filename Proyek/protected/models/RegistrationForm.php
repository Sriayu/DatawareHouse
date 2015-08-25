<?php

class RegistrationForm extends CFormModel {

// attributes
// for bio
    public $f_name;
//    public $last_name;
//    public $e_mail;
//    public $address;
// for credential
    public $username;
    public $password;
    public $repassword;
    public $id_role;

// applied rules for validation
    public function rules() {
        return array(
// safe attributes are assigned-able in all scenario types
//            array('first_name','required'),
            array('f_name','length','max'=>16),
//            array('last_name','length','max'=>16),
//            array('address','length','max'=>64),
//            array('e_mail', 'email'),
//            array('e_mail', 'required'),
            array('username','required'),
            array('password','required'),
            array('id_role','required'),
            array('repassword','required','on'=>'register'),
            array('id_role', 'safe', 'on'=>'search'),
            array('password', 'compare', 'compareAttribute'=>'repassword', 'on'=>'register'),
            
        );
    }
    
// sets attribute labels for view labeling
    public function attributeLabels() {
        return array(
            'f_name' => 'Name',
//            'last_name' => 'Last name',
//            'address' => 'Address',
//            'e_mail' => 'Email',
            'username' => 'Username',
            'id_role' => 'Role',
            'password' => 'Password',
            'repassword' => 'Retype password',
        );
    }

}

?>