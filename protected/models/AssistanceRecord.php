<?php

/**
 * This is the model class for table "tbl_e24_assistance_record".
 *
 * The followings are the available columns in table 'tbl_e24_assistance_record':
 * @property string $pk_assistance
 * @property string $class_date
 * @property string $fk_course
 * @property string $fk_client
 * @property string $fk_student
 * @property integer $fk_status_class
 * @property string $reschedule_date
 * @property string $reschedule_time
 * @property string $cancellation_reason
 * @property integer $fk_level_detail
 *
 * The followings are the available model relations:
 * @property Courses $fkCourse
 * @property Clients $fkClient
 * @property CatStatusClass $fkStatusClass
 * @property Students $fkStudent
 * @property CatLevelDetail $fkLevelDetail
 */
class AssistanceRecord extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_assistance_record';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('class_date, fk_course, fk_client, fk_status_class', 'required'),
			array('fk_status_class', 'numerical', 'integerOnly'=>true),
			array('fk_course, fk_client, fk_student', 'length', 'max'=>10),
			array('cancellation_reason', 'length', 'max'=>100),
			array('reschedule_date, reschedule_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_assistance, class_date, fk_course, fk_client, fk_student, fk_status_class, reschedule_date, reschedule_time, cancellation_reason', 'safe', 'on'=>'search'),
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
			'fkClient' => array(self::BELONGS_TO, 'Clients', 'fk_client'),
			'fkStatusClass' => array(self::BELONGS_TO, 'CatStatusClass', 'fk_status_class'),
			'fkStudent' => array(self::BELONGS_TO, 'Students', 'fk_student'),
                        'fkLevelDetail' => array(self::BELONGS_TO, 'CatLevelDetail', 'fk_level_detail'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_assistance' => 'Pk Assistance',
			'class_date' => 'Class Date',
			'fk_course' => 'Fk Course',
			'fk_client' => 'Fk Client',
			'fk_student' => 'Fk Student',
			'fk_status_class' => 'Fk Status Class',
			'reschedule_date' => 'Reschedule Date',
			'reschedule_time' => 'Reschedule Time',
			'cancellation_reason' => 'Cancellation Reason',
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

		$criteria->compare('pk_assistance',$this->pk_assistance,true);
		$criteria->compare('class_date',$this->class_date,true);
		$criteria->compare('fk_course',$this->fk_course,true);
		$criteria->compare('fk_client',$this->fk_client,true);
		$criteria->compare('fk_student',$this->fk_student,true);
		$criteria->compare('fk_status_class',$this->fk_status_class);
		$criteria->compare('reschedule_date',$this->reschedule_date,true);
		$criteria->compare('reschedule_time',$this->reschedule_time,true);
		$criteria->compare('cancellation_reason',$this->cancellation_reason,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AssistanceRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
