<?php

/**
 * This is the model class for table "t_menu_privileges".
 *
 * The followings are the available columns in table 't_menu_privileges':
 * @property integer $id
 * @property integer $user_id
 * @property integer $menu_id
 * @property integer $allow_view
 * @property integer $allow_add
 * @property integer $allow_edit
 * @property integer $allow_delete
 * @property integer $allow_admin
 * @property integer $allow_TambahKoneksi
 * @property integer $allow_Simpandatabase
 * @property integer $allow_Daftardatabase
 * @property integer $allow_Setting
 * @property integer $allow_Register
 *
 * The followings are the available model relations:
 * @property TMenu $menu
 * @property TUser $user
 */
class TMenuPrivileges extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TMenuPrivileges the static model class
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
		return 't_menu_privileges';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('user_id, menu_id, allow_view, allow_add, allow_edit, allow_delete, allow_admin, allow_TambahKoneksi, allow_Simpandatabase, allow_register, allow_Daftardatabase, allow_Setting', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, menu_id, allow_view, allow_add, allow_edit, allow_delete, allow_admin, allow_TambahKoneksi, allow_register, allow_Simpandatabase, allow_Daftardatabase, allow_Setting', 'safe', 'on'=>'search'),
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
			'menu' => array(self::BELONGS_TO, 'TMenu', 'menu_id'),
			'user' => array(self::BELONGS_TO, 'TUser', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'menu_id' => 'Menu',
			'allow_view' => 'Allow View',
			'allow_add' => 'Allow Add',
			'allow_edit' => 'Allow Edit',
			'allow_delete' => 'Allow Delete',
			'allow_admin' => 'Allow Admin',
			'allow_TambahKoneksi' => 'Allow Tambah Koneksi',
			'allow_Simpandatabase' => 'Allow Simpan Database',
			'allow_Daftardatabase' => 'Allow Daftar Database',
                        'allow_Setting' => 'Allow Setting',
                        'allow_register'  => 'Allow Register',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('menu_id',$this->menu_id);
		$criteria->compare('allow_view',$this->allow_view);
		$criteria->compare('allow_add',$this->allow_add);
		$criteria->compare('allow_edit',$this->allow_edit);
		$criteria->compare('allow_delete',$this->allow_delete);
		$criteria->compare('allow_admin',$this->allow_admin);
		$criteria->compare('allow_TambahKoneksi',$this->allow_TambahKoneksi);
		$criteria->compare('allow_Simpandatabase',$this->allow_Simpandatabase);
		$criteria->compare('allow_Daftardatabase',$this->allow_Daftardatabase);
                $criteria->compare('allow_Setting',$this->allow_Setting);
                $criteria->compare('allow_register',$this->allow_register);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}