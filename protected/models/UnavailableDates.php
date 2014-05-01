<?php

/**
 * This is the model class for table "tbl_e24_unavailable_dates".
 *
 * The followings are the available columns in table 'tbl_e24_unavailable_dates':
 * @property string $pk_unavailable_dates
 * @property string $initial_date
 * @property string $final_date
 * @property string $fk_course
 * @property integer $status
 * @property integer $fk_unavailability_type
 *
 * The followings are the available model relations:
 * @property Courses $fkCourse
 * @property CatDetail $fkUnavailabilityType
 */
class UnavailableDates extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_unavailable_dates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('initial_date, final_date, fk_course, status, fk_unavailability_type', 'required'),
			array('status, fk_unavailability_type', 'numerical', 'integerOnly'=>true),
			array('fk_course', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_unavailable_dates, initial_date, final_date, fk_course, status, fk_unavailability_type', 'safe', 'on'=>'search'),
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
			'fkCourse' => array(self::BELONGS_TO, 'Courses', 'fk_course'),
			'fkUnavailabilityType' => array(self::BELONGS_TO, 'CatDetail', 'fk_unavailability_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_unavailable_dates' => 'Pk Unavailable Dates',
			'initial_date' => 'Initial Date',
			'final_date' => 'Final Date',
			'fk_course' => 'Fk Course',
			'status' => 'Status',
			'fk_unavailability_type' => 'Fk Unavailability Type',
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

		$criteria->compare('pk_unavailable_dates',$this->pk_unavailable_dates,true);
		$criteria->compare('initial_date',$this->initial_date,true);
		$criteria->compare('final_date',$this->final_date,true);
		$criteria->compare('fk_course',$this->fk_course,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('fk_unavailability_type',$this->fk_unavailability_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UnavailableDates the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
