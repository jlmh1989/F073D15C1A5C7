<?php

/**
 * This is the model class for table "tbl_e24_cat_bss_day".
 *
 * The followings are the available columns in table 'tbl_e24_cat_bss_day':
 * @property integer $pk_bss_day
 * @property string $desc_day
 * @property string $initial_hour
 * @property string $final_hour
 * @property string $range_time
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property CourseSchedule[] $courseSchedules
 * @property UnavailableSchedule[] $unavailableSchedules
 */
class CatBssDay extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_cat_bss_day';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('desc_day, initial_hour, final_hour, range_time, status', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('desc_day', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_bss_day, desc_day, initial_hour, final_hour, range_time, status', 'safe', 'on'=>'search'),
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
			'courseSchedules' => array(self::HAS_MANY, 'CourseSchedule', 'fk_bss_day'),
			'unavailableSchedules' => array(self::HAS_MANY, 'UnavailableSchedule', 'fk_bss_day'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_bss_day' => 'Pk Bss Day',
			'desc_day' => 'Desc Day',
			'initial_hour' => 'Initial Hour',
			'final_hour' => 'Final Hour',
			'range_time' => 'Range Time',
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

		$criteria->compare('pk_bss_day',$this->pk_bss_day);
		$criteria->compare('desc_day',$this->desc_day,true);
		$criteria->compare('initial_hour',$this->initial_hour,true);
		$criteria->compare('final_hour',$this->final_hour,true);
		$criteria->compare('range_time',$this->range_time,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CatBssDay the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getCatBssDay($status = constantes::INACTIVO)
        {
            $criteria=new CDbCriteria;
            $criteria-> select='pk_bss_day,desc_day';
            $criteria->addCondition('status='.$status);
            return CatBssDay::model()->findAll($criteria);
        }
        
        public function getCatBssDayListData($status = constantes::INACTIVO)
        {
            $criteria=new CDbCriteria;
            $criteria-> select='pk_bss_day,desc_day';
            $criteria->addCondition('status='.$status);
            return CHtml::listData(CatBssDay::model()->findAll($criteria),'pk_bss_day','desc_day');
        } 
}
