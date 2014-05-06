<?php

/**
 * This is the model class for table "tbl_e24_teachers".
 *
 * The followings are the available columns in table 'tbl_e24_teachers':
 * @property integer $pk_teacher
 * @property integer $fk_user
 * @property string $name
 * @property string $street
 * @property integer $street_numer
 * @property string $street_number_int
 * @property string $neighborhood
 * @property integer $fk_nationality
 * @property integer $fk_state_dir
 * @property string $county
 * @property string $zipcode
 * @property string $birthdate
 * @property integer $fk_state_birth
 * @property integer $fk_education
 * @property string $nationality_other
 * @property integer $fk_status_document
 * @property string $phone
 * @property string $cellphone
 * @property string $email
 * @property integer $entrance_score
 * @property double $rate
 * @property string $spesification
 * @property string $comments
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Courses[] $courses
 * @property CatDocuments[] $tblE24CatDocuments
 * @property CatDetail $fkNationality
 * @property CatDetail $fkStateBirth
 * @property CatDetail $fkStateDir
 * @property CatDetail $fkStatusDocument
 * @property UnavailableSchedule[] $unavailableSchedules
 * @property Users $fkUser
 */
class Teachers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_teachers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rate, name, street, street_numer, neighborhood, fk_nationality, fk_state_dir, county, zipcode, birthdate, fk_education, fk_status_document, phone, cellphone, entrance_score', 'required'),
			array('street_numer, fk_nationality, fk_state_dir, fk_state_birth, fk_education, fk_status_document, entrance_score, status', 'numerical', 'integerOnly'=>true),
			array('name, street, neighborhood, county, nationality_other, email, spesification', 'length', 'max'=>100),
			array('street_number_int, zipcode', 'length', 'max'=>5),
			array('phone, cellphone', 'length', 'max'=>15),
			array('comments', 'length', 'max'=>300),
                        array('rate', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('status', 'safe', 'on'=>'search'),
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
			'courses' => array(self::HAS_MANY, 'Courses', 'fk_teacher'),
			'tblE24CatDocuments' => array(self::MANY_MANY, 'CatDocuments', 'tbl_e24_documents_teachers(fk_teacher, fk_document)'),
			'fkNationality' => array(self::BELONGS_TO, 'CatDetail', 'fk_nationality'),
			'fkStateBirth' => array(self::BELONGS_TO, 'CatDetail', 'fk_state_birth'),
			'fkStateDir' => array(self::BELONGS_TO, 'CatDetail', 'fk_state_dir'),
			'fkStatusDocument' => array(self::BELONGS_TO, 'CatDetail', 'fk_status_document'),
			'unavailableSchedules' => array(self::HAS_MANY, 'UnavailableSchedule', 'fk_teacher'),
                        'fkUser'=> array(self::BELONGS_TO, 'Users', 'fk_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_teacher' => 'Pk Teacher',
			'name' => 'Nombre',
			'street' => 'Calle',
			'street_numer' => 'N&uacute;mero',
			'street_number_int' => 'N&uacute;mero Interior',
			'neighborhood' => 'Colonia',
			'fk_nationality' => 'Nacionalidad',
			'fk_state_dir' => 'Estado',
			'county' => 'Municipio',
			'zipcode' => 'C&oacute;digo Postal',
			'birthdate' => 'Fecha Nacimiento',
			'fk_state_birth' => 'Estado de Nacimiento',
			'fk_education' => 'Educaci&oacute;n',
			'nationality_other' => 'Otra Nacionalidad',
			'fk_status_document' => 'Estatus Documento',
			'phone' => 'Tel&eacute;fono',
			'cellphone' => 'Celular',
			'email' => 'Correo',
			'entrance_score' => 'Calificaci&oacute;n en Examen de Ingreso',
                        'rate' => 'Tarifa',
			'spesification' => 'Especificaciones',
			'comments' => 'Comentarios',
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
                $sort = new CSort();
                $sort->attributes = array(
                    'name'=>array(
                        'asc'=>'name',
                        'desc'=>'name desc',
                    ),
                    'birthdate'=>array(
                        'asc'=>'birthdate',
                        'desc'=>'birthdate desc',
                    ),
                );
		$criteria->compare('status',$this->status);
                $_SESSION['reporte_teachers'] = new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'sort'=>$sort,
                    'pagination'=>false,
		));
		return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'sort'=>$sort,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Teachers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getTeachers()
        {
            $criteria=new CDbCriteria;
            $criteria-> select='pk_teacher,name';
           		            
            return CHtml::listData(Teachers::model()->findAll($criteria),'pk_teacher','name');
        } 
}
