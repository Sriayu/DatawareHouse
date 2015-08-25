<?php

/**
 * This is the model class for table "tbl_take".
 *
 * The followings are the available columns in table 'tbl_take':
 * @property string $code_table
 * @property string $tbl_name
 * @property string $attribute
 * @property string $id_database
 * @property string $id_tbl_output
 */
class TblTake extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblTake the static model class
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
		return 'tbl_take';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code_table, tbl_name', 'required'),
			array('code_table, tbl_name, attribute, id_database, id_tbl_output', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('code_table, tbl_name, attribute, id_database, id_tbl_output', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'code_table' => 'Code Table',
			'tbl_name' => 'Tbl Name',
			'attribute' => 'Attribute',
			'id_database' => 'Id Database',
			'id_tbl_output' => 'Id Tbl Output',
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

		$criteria->compare('code_table',$this->code_table,true);
		$criteria->compare('tbl_name',$this->tbl_name,true);
		$criteria->compare('attribute',$this->attribute,true);
		$criteria->compare('id_database',$this->id_database,true);
		$criteria->compare('id_tbl_output',$this->id_tbl_output,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}