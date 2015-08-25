<?php

/**
 * This is the model class for table "t_menu".
 *
 * The followings are the available columns in table 't_menu':
 * @property integer $id
 * @property integer $parent_id
 * @property string $menu_name
 * @property string $menu_controller
 *
 * The followings are the available model relations:
 * @property TMenuPrivileges[] $tMenuPrivileges
 */
class TMenu extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TMenu the static model class
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
		return 't_menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, menu_name, menu_controller', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('menu_name, menu_controller', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, menu_name, menu_controller', 'safe', 'on'=>'search'),
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
			'tMenuPrivileges' => array(self::HAS_MANY, 'TMenuPrivileges', 'menu_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Parent',
			'menu_name' => 'Menu Name',
			'menu_controller' => 'Menu Controller',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('menu_name',$this->menu_name,true);
		$criteria->compare('menu_controller',$this->menu_controller,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function conidx($str)
        {
            $hasil = $this->findBySql("SELECT id FROM t_menu WHERE menu_controller='$str'", array());
            return $hasil->id;
        }

        public function checkAuth($str)
        {
            $out = "";
            if($str=="create"){
                $out = "allow_add";
            }else if($str=="index"){
                $out = "allow_view";
            }else if($str=="update"){
                $out = "allow_edit";
            }else if($str=="delete"){
                $out = "allow_delete";
            }else if($str=="view"){
                $out = "allow_view";
            }else if($str=="admin"){
                $out = "allow_admin";
            }else if($str=="TambahKoneksi"){
                $out = "allow_TambahKoneksi";
            }else if($str=="Simpandatabase"){
                $out = "allow_Simpandatabase";
            }else if($str=="Daftardatabase"){
                $out = "allow_Daftardatabase";
            }else if($str=="Setting"){
                $out = "allow_Setting";
            }else if($str=="register"){
                $out = "allow_register";
            }
            return $out;
        }
        
}