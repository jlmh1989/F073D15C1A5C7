<?php

/**
 * This is the model class for table "tbl_e24_cat_status_class".
 *
 * The followings are the available columns in table 'tbl_e24_cat_status_class':
 * @property integer $pk_status_class
 * @property string $desc_status_class
 * @property string $long_desc
 * @property integer $is_reschedule_motive
 * @property integer $fk_type_class
 * @property integer $fk_role_class
 *
 * The followings are the available model relations:
 * @property AssistanceRecord[] $assistanceRecords
 * @property CatDetail $fkRoleClass
 * @property CatDetail $fkTypeClass
 */
class CatStatusClass extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_cat_status_class';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('desc_status_class, long_desc, is_reschedule_motive, fk_type_class, fk_role_class', 'required'),
			array('is_reschedule_motive, fk_type_class, fk_role_class', 'numerical', 'integerOnly'=>true),
			array('desc_status_class', 'length', 'max'=>25),
			array('long_desc', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_status_class, desc_status_class, long_desc, is_reschedule_motive, fk_type_class, fk_role_class', 'safe', 'on'=>'search'),
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
			'assistanceRecords' => array(self::HAS_MANY, 'AssistanceRecord', 'fk_status_class'),
			'fkRoleClass' => array(self::BELONGS_TO, 'CatDetail', 'fk_role_class'),
			'fkTypeClass' => array(self::BELONGS_TO, 'CatDetail', 'fk_type_class'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_status_class' => 'Pk Status Class',
			'desc_status_class' => 'Desc Status Class',
			'long_desc' => 'Long Desc',
			'is_reschedule_motive' => 'Is Reschedule Motive',
			'fk_type_class' => 'Fk Type Class',
			'fk_role_class' => 'Fk Role Class',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('pk_status_class',$this->pk_status_class);
		$criteria->compare('desc_status_class',$this->desc_status_class,true);
		$criteria->compare('long_desc',$this->long_desc,true);
		$criteria->compare('is_reschedule_motive',$this->is_reschedule_motive);
		$criteria->compare('fk_type_class',$this->fk_type_class);
		$criteria->compare('fk_role_class',$this->fk_role_class);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CatStatusClass the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
