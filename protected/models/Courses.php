<?php

/**
 * This is the model class for table "tbl_e24_courses".
 *
 * The followings are the available columns in table 'tbl_e24_courses':
 * @property string $pk_course
 * @property integer $fk_level
 * @property string $fk_client
 * @property integer $fk_teacher
 * @property integer $fk_type_course
 * @property string $fk_group
 * @property string $initial_date
 * @property string $desc_curse
 * @property string $other_level
 * @property string $latitud
 * @property string $longitud
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property AssistanceRecord[] $assistanceRecords
 * @property AssistanceRecord[] $assistanceRecords1
 * @property CourseSchedule[] $courseSchedules
 * @property CatLevels $fkLevel
 * @property Clients $fkClient
 * @property Groups $fkGroup
 * @property Teachers $fkTeacher
 * @property CatDetail $fkTypeCourse
 * @property UnavailableDates[] $unavailableDates
 */
class Courses extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_courses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_level, fk_client, fk_teacher, fk_type_course, initial_date, desc_curse, latitud, longitud', 'required'),
			array('fk_level, fk_teacher, fk_type_course', 'numerical', 'integerOnly'=>true),
			array('fk_client, fk_group', 'length', 'max'=>10),
			array('desc_curse, other_level', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_course, fk_level, fk_client, fk_teacher, fk_type_course, fk_group, initial_date, desc_curse, other_level', 'safe', 'on'=>'search'),
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
			'assistanceRecords' => array(self::HAS_MANY, 'AssistanceRecord', 'fk_course'),
			'assistanceRecords1' => array(self::HAS_MANY, 'AssistanceRecord', 'fk_client'),
			'courseSchedules' => array(self::HAS_MANY, 'CourseSchedule', 'fk_course'),
			'fkLevel' => array(self::BELONGS_TO, 'CatLevels', 'fk_level'),
			'fkClient' => array(self::BELONGS_TO, 'Clients', 'fk_client'),
			'fkGroup' => array(self::BELONGS_TO, 'Groups', 'fk_group'),
			'fkTeacher' => array(self::BELONGS_TO, 'Teachers', 'fk_teacher'),
			'fkTypeCourse' => array(self::BELONGS_TO, 'CatDetail', 'fk_type_course'),
			'unavailableDates' => array(self::HAS_MANY, 'UnavailableDates', 'fk_course'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_course' => 'Pk Course',
			'fk_level' => 'Nivel',
			'fk_client' => 'Cliente',
			'fk_teacher' => 'Maestro',
			'fk_type_course' => 'Tipo de Curso',
			'fk_group' => 'Grupo',
			'initial_date' => 'Fecha de Inicio',
			'desc_curse' => 'Descripci&oacute;n Curso',
			'other_level' => 'Otro Nivel',
                        'latitud' => 'Latitud',
                        'longitud' => 'Longitud',
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

		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Courses the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
