<?php

/**
 * This is the model class for table "tbl_e24_students_group".
 *
 * The followings are the available columns in table 'tbl_e24_students_group':
 * @property string $fk_group
 * @property string $fk_student
 * @property integer $status
 * @property string $fk_client
 *
 * The followings are the available model relations:
 * @property Clients $fkClient
 * @property Groups $fkGroup
 * @property Students $fkStudent
 */
class StudentsGroup extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_students_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_group, fk_student, status, fk_client', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('fk_group, fk_student, fk_client', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fk_group, fk_student, status, fk_client', 'safe', 'on'=>'search'),
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
			'fkClient' => array(self::BELONGS_TO, 'Clients', 'fk_client'),
			'fkGroup' => array(self::BELONGS_TO, 'Groups', 'fk_group'),
			'fkStudent' => array(self::BELONGS_TO, 'Students', 'fk_student'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fk_group' => 'Fk Group',
			'fk_student' => 'Fk Student',
			'status' => 'Status',
			'fk_client' => 'Fk Client',
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

		$criteria->compare('fk_group',$this->fk_group,true);
		$criteria->compare('fk_student',$this->fk_student,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('fk_client',$this->fk_client,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StudentsGroup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
