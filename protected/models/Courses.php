<?php

/**
 * This is the model class for table "tbl_e24_courses".
 *
 * The followings are the available columns in table 'tbl_e24_courses':
 * @property integer $pk_course
 * @property integer $fk_level
 * @property integer $fk_client
 * @property integer $fk_teacher
 * @property integer $fk_type_course
 * @property integer $fk_group
 * @property integer $fk_classrom_address
 * @property string $initial_date
 * @property string $desc_curse
 * @property string $other_level
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property AssistanceRecord[] $assistanceRecords
 * @property AssistanceRecord[] $assistanceRecords1
 * @property CourseSchedule[] $courseSchedules
 * @property CatLevels $fkLevel
 * @property Clients $fkClient
 * @property ClassroomAddress $fkClassromAddress
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
			array('fk_level, fk_client, fk_teacher, fk_type_course, initial_date, desc_curse', 'required'),
			array('fk_level, fk_teacher, fk_classrom_address, fk_type_course', 'numerical', 'integerOnly'=>true),
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
                        'fkClassromAddress' => array(self::BELONGS_TO, 'ClassroomAddress', 'fk_classrom_address'),
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
                        'fk_classrom_address' => 'Direcci&oacute;n'
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
        
        public static function getEstudiantes($pkCurso, $pkType){
            $criteria = new CDbCriteria;
            $criteria->distinct=true;
            $criteria->select = 't.*';
            if($pkType === constantes::CURSO_GRUPAL){
                $criteria->join ='INNER JOIN TBL_E24_STUDENTS_GROUP ON t.PK_STUDENT = TBL_E24_STUDENTS_GROUP.FK_STUDENT '
                            .'INNER JOIN TBL_E24_COURSES ON TBL_E24_STUDENTS_GROUP.FK_GROUP = TBL_E24_COURSES.FK_GROUP';
                $criteria->addCondition('TBL_E24_STUDENTS_GROUP.FK_CLIENT = TBL_E24_COURSES.FK_CLIENT');
                $criteria->addCondition('TBL_E24_STUDENTS_GROUP.STATUS = '.constantes::ACTIVO);
            }else{
                $criteria->join = 'INNER JOIN TBL_E24_COURSES ON t.FK_CLIENT = TBL_E24_COURSES.FK_CLIENT';
                $criteria->addCondition('t.FK_USER = (SELECT TBL_E24_CLIENTS.FK_USER FROM TBL_E24_CLIENTS WHERE TBL_E24_CLIENTS.PK_CLIENT = TBL_E24_COURSES.FK_CLIENT)');
            }
            $criteria->addCondition('TBL_E24_COURSES.PK_COURSE = :value');
            $criteria->params = array(":value" => $pkCurso);    
            return Students::model()->findAll($criteria);
        }
        
        public static function getFechaFInPorcentaje($pkCurso){
            $comand = Yii::app()->db->createCommand('CALL stp_courses_cursor(:pkCurso, :pkClient, :pkTeacher, :pkStudent, @status, @statusMsg)');
            $comand->bindParam('pkCurso', $pkCurso);
            $comand->bindValue('pkClient', NULL);
            $comand->bindValue('pkTeacher', NULL);
            $comand->bindValue('pkStudent', NULL);

            $result = $comand->query();
            foreach ($result as $row){
                return $row;
            }
        }
}
