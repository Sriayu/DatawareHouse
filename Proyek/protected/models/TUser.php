<?php

/**
 * This is the model class for table "t_user".
 *
 * The followings are the available columns in table 't_user':
 * @property integer $id
 * @property string $f_name
 * @property string $username
 * @property string $password
 * @property integer $id_role
 *
 * The followings are the available model relations:
 * @property TMenuPrivileges[] $tMenuPrivileges
 * @property TRole $idRole
 */
class TUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('f_name, username, password', 'required'),
			array('id_role', 'numerical', 'integerOnly'=>true),
			array('f_name, username, password', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, f_name, username, password, id_role', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'tMenuPrivileges' => array(self::HAS_MANY, 'TMenuPrivileges', 'user_id'),
			'idRole' => array(self::BELONGS_TO, 'TRole', 'id_role'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'f_name' => 'F Name',
			'username' => 'Username',
			'password' => 'Password',
			'id_role' => 'Id Role',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('f_name',$this->f_name,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('id_role',$this->id_role);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        // a password hashing method
    public static function hashPassword($_password) {
        return (MD5($_password));
    }

// to compare this model's password wirh a given password
    public function comparePassword($_password) {
        return($this->password === $this->hashPassword($_password));
    }

    public function beforeSave() {
        $this->password = self::hashPassword($this->password);
        return (parent::beforeSave());
    }
}