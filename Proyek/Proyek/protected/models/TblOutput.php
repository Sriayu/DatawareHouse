<?php

/**
 * This is the model class for table "tbl_output".
 *
 * The followings are the available columns in table 'tbl_output':
 * @property integer $id
 * @property string $code_table
 * @property string $tbl_output_name
 * @property string $deskripsi
 * @property string $list_fields
 */
class TblOutput extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblOutput the static model class
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
		return 'tbl_output';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code_table, tbl_output_name', 'required'),
			array('code_table, tbl_output_name', 'length', 'max'=>32),
			array('deskripsi', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, code_table, tbl_output_name, deskripsi', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'code_table' => 'Code Table',
			'tbl_output_name' => 'Tbl Output Name',
			'deskripsi' => 'Deskripsi',
                        'list_fields' => 'List Fields',
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
		$criteria->compare('code_table',$this->code_table,true);
		$criteria->compare('tbl_output_name',$this->tbl_output_name,true);
		$criteria->compare('deskripsi',$this->deskripsi,true);
                $criteria->compare('list_fields',$this->list_fields,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}