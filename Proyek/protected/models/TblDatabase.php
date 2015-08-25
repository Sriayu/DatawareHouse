<?php

/**
 * This is the model class for table "tbl_database".
 *
 * The followings are the available columns in table 'tbl_database':
 * @property integer $id
 * @property string $database_name
 * @property integer $id_server
 * @property string $database_local
 *
 * The followings are the available model relations:
 * @property TblServer $idServer
 */
class TblDatabase extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblDatabase the static model class
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
		return 'tbl_database';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('', 'required'),
			array('id_server', 'numerical', 'integerOnly'=>true),
			array('database_name, database_local', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, database_name, id_server, database_local', 'safe', 'on'=>'search'),
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
			'idServer' => array(self::BELONGS_TO, 'TblServer', 'id_server'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'database_name' => 'Database Name',
			'id_server' => 'Id Server',
                        'database_local' => 'Database Local',
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
		$criteria->compare('database_name',$this->database_name,true);
		$criteria->compare('id_server',$this->id_server);
                $criteria->compare('database_name',$this->database_local,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}