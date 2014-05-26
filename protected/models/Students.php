<?php

/**
 * This is the model class for table "tbl_e24_students".
 *
 * The followings are the available columns in table 'tbl_e24_students':
 * @property integer $pk_student
 * @property integer $fk_client
 * @property integer $fk_user
 * @property string $name
 * @property string $email
 * @property string $neigborhod
 * @property string $county
 * @property string $phone
 * @property string $zipcode
 * @property string $birthdate
 * @property string $street
 * @property integer $street_number
 * @property string $street_number_int
 * @property integer $fk_state_dir
 *
 * The followings are the available model relations:
 * @property AssistanceRecord[] $assistanceRecords
 * @property StudentsGroup[] $studentsGroups
 * @property Users $fkUser
 * @property Clients $fkClient
 * @property CatDetail $fkStateDir
 */
class Students extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_students';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_client, name, neigborhod, county, phone, zipcode, birthdate, street, street_number, fk_state_dir', 'required'),
			array('street_number, fk_state_dir', 'numerical', 'integerOnly'=>true),
			array('fk_client', 'length', 'max'=>10),
			array('name, email, neigborhod, county, street', 'length', 'max'=>100),
			array('phone', 'length', 'max'=>15),
			array('zipcode, street_number_int', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_student, fk_client, name, email, neigborhod, county, phone, zipcode, birthdate, street, street_number, street_number_int, fk_state_dir', 'safe', 'on'=>'search'),
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
			'assistanceRecords' => array(self::HAS_MANY, 'AssistanceRecord', 'fk_student'),
			'studentsGroups' => array(self::HAS_MANY, 'StudentsGroup', 'fk_student'),
                        'fkUser'=> array(self::BELONGS_TO, 'Users', 'fk_user'),
                        'fkClient'=> array(self::BELONGS_TO, 'Clients', 'fk_client'),
                        'fkStateDir' => array(self::BELONGS_TO, 'CatDetail', 'fk_state_dir'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_student' => 'Id',
			'fk_client' => 'Cliente',
			'name' => 'Nombre',
			'email' => 'Email',
			'neigborhod' => 'Colonia',
			'county' => 'Municipio',
			'phone' => 'Tel&eacute;fono',
			'zipcode' => 'C&oacute;digo Postal',
			'birthdate' => 'Fecha Nacimiento',
			'street' => 'Calle',
			'street_number' => 'N&uacute;mero',
			'street_number_int' => 'N&uacute;mero Interior',
			'fk_state_dir' => 'Estado',
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

		$criteria->compare('pk_student',$this->pk_student,true);
		$criteria->compare('fk_client',$this->fk_client,true);
		$criteria->compare('name',$this->name,true);
                /*
		$criteria->compare('email',$this->email,true);
		$criteria->compare('neigborhod',$this->neigborhod,true);
		$criteria->compare('county',$this->county,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('street_number',$this->street_number);
		$criteria->compare('street_number_int',$this->street_number_int,true);
		$criteria->compare('fk_state_dir',$this->fk_state_dir);
                 * 
                 */
                $sort = new CSort();
                $sort->attributes = array(
                    'name'=>array(
                        'asc'=>'name',
                        'desc'=>'name desc',
                    ),
                );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>$sort,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Students the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
