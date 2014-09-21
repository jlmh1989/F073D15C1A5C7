<?php

/**
 * This is the model class for table "tbl_e24_employees".
 *
 * The followings are the available columns in table 'tbl_e24_employees':
 * @property string $pk_employee
 * @property string $fk_user
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
 * @property string $entrance_date
 *
 * The followings are the available model relations:
 * @property CatDetail $fkStateDir
 * @property Users $fkUser
 */
class Employees extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_employees';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' name, neigborhod, county, phone, zipcode, birthdate, street, street_number, fk_state_dir, entrance_date', 'required'),
			array('street_number, fk_state_dir', 'numerical', 'integerOnly'=>true),
			array('fk_user', 'length', 'max'=>10),
			array('name, email, neigborhod, county, street', 'length', 'max'=>100),
			array('phone', 'length', 'max'=>15),
			array('zipcode, street_number_int', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_employee, fk_user, name, email, neigborhod, county, phone, zipcode, birthdate, street, street_number, street_number_int, fk_state_dir, entrance_date', 'safe', 'on'=>'search'),
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
			'fkStateDir' => array(self::BELONGS_TO, 'CatDetail', 'fk_state_dir'),
			'fkUser' => array(self::BELONGS_TO, 'Users', 'fk_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_employee' => 'Empleado',
			'fk_user' => 'Usuario',
			'name' => 'Nombre',
			'email' => 'Email',
			'neigborhod' => 'Colonia',
			'county' => 'Municipio',
			'phone' => 'Telefono',
			'zipcode' => 'Codigo Postal',
			'birthdate' => 'Fecha Nacimiento',
			'street' => 'Calle',
			'street_number' => 'Numero',
			'street_number_int' => 'Numero Int',
			'fk_state_dir' => 'Estado',
			'entrance_date' => 'Fecha Entrada',
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

		$criteria->compare('pk_employee',$this->pk_employee,true);
		$criteria->compare('fk_user',$this->fk_user,true);
		$criteria->compare('name',$this->name,true);
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
		$criteria->compare('entrance_date',$this->entrance_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Employees the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
