<?php

/**
 * This is the model class for table "tbl_e24_unavailable_schedule".
 *
 * The followings are the available columns in table 'tbl_e24_unavailable_schedule':
 * @property string $pk_unavailable_schedule
 * @property integer $fk_bss_day
 * @property integer $fk_teacher
 * @property string $initial_hour
 * @property string $final_hour
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property CatBssDay $fkBssDay
 * @property Teachers $fkTeacher
 */
class UnavailableSchedule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_unavailable_schedule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_bss_day, fk_teacher, initial_hour, final_hour, status', 'required'),
			array('fk_bss_day, fk_teacher, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_unavailable_schedule, fk_bss_day, fk_teacher, initial_hour, final_hour, status', 'safe', 'on'=>'search'),
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
			'fkTeacher' => array(self::BELONGS_TO, 'Teachers', 'fk_teacher'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_unavailable_schedule' => 'Pk Unavailable Schedule',
			'fk_bss_day' => 'Fk Bss Day',
			'fk_teacher' => 'Fk Teacher',
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

		$criteria->compare('pk_unavailable_schedule',$this->pk_unavailable_schedule,true);
		$criteria->compare('fk_bss_day',$this->fk_bss_day);
		$criteria->compare('fk_teacher',$this->fk_teacher);
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
	 * @return UnavailableSchedule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getUnavailableSchedule($status = constantes::INACTIVO, $fkTeacher = 0){
            $criteria=new CDbCriteria;
            $criteria-> select='pk_unavailable_schedule,fk_teacher,fk_bss_day,initial_hour,final_hour';
            $criteria->addCondition('status='.$status);
            $criteria->addCondition('fk_teacher='.$fkTeacher);
            return UnavailableSchedule::model()->findAll($criteria);
        }
}
