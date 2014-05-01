<?php

/**
 * This is the model class for table "tbl_e24_course_schedule".
 *
 * The followings are the available columns in table 'tbl_e24_course_schedule':
 * @property string $pk_course_schedule
 * @property string $fk_course
 * @property integer $fk_bss_day
 * @property string $initial_hour
 * @property string $final_hour
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property CatBssDay $fkBssDay
 * @property Courses $fkCourse
 */
class CourseSchedule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_course_schedule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_course, fk_bss_day, initial_hour, final_hour, status', 'required'),
			array('fk_bss_day, status', 'numerical', 'integerOnly'=>true),
			array('fk_course', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_course_schedule, fk_course, fk_bss_day, initial_hour, final_hour, status', 'safe', 'on'=>'search'),
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
			'fkBssDay' => array(self::BELONGS_TO, 'CatBssDay', 'fk_bss_day'),
			'fkCourse' => array(self::BELONGS_TO, 'Courses', 'fk_course'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_course_schedule' => 'Pk Course Schedule',
			'fk_course' => 'Fk Course',
			'fk_bss_day' => 'Fk Bss Day',
			'initial_hour' => 'Initial Hour',
			'final_hour' => 'Final Hour',
			'status' => 'Status',
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

		$criteria->compare('pk_course_schedule',$this->pk_course_schedule,true);
		$criteria->compare('fk_course',$this->fk_course,true);
		$criteria->compare('fk_bss_day',$this->fk_bss_day);
		$criteria->compare('initial_hour',$this->initial_hour,true);
		$criteria->compare('final_hour',$this->final_hour,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CourseSchedule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
