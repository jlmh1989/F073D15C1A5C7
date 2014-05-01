<?php

/**
 * This is the model class for table "tbl_e24_classroom_address".
 *
 * The followings are the available columns in table 'tbl_e24_classroom_address':
 * @property string $pk_classroom_direction
 * @property string $fk_client
 * @property string $street
 * @property integer $street_number
 * @property string $street_number_int
 * @property string $neighborhood
 * @property string $county
 * @property integer $fk_state_dir
 * @property string $country
 * @property string $zipcode
 * @property integer $status
 * @property string $phone
 *
 * The followings are the available model relations:
 * @property Clients $fkClient
 * @property CatDetail $fkStateDir
 */
class ClassroomAddress extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_classroom_address';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('street, street_number, neighborhood, county, fk_state_dir, country, zipcode, phone', 'required'),
			array('street_number, fk_state_dir, status', 'numerical', 'integerOnly'=>true),
			array('fk_client', 'length', 'max'=>10),
			array('street, neighborhood, county, country', 'length', 'max'=>100),
			array('street_number_int, zipcode', 'length', 'max'=>5),
			array('phone', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_classroom_direction, fk_client, street, street_number, street_number_int, neighborhood, county, fk_state_dir, country, zipcode, status, phone', 'safe', 'on'=>'search'),
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
			'fkStateDir' => array(self::BELONGS_TO, 'CatDetail', 'fk_state_dir'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_classroom_direction' => 'Pk Classroom Direction',
			'fk_client' => 'Fk Client',
			'street' => 'Calle',
			'street_number' => 'N&uacute;mero',
			'street_number_int' => 'N&uacute;mero Interior',
			'neighborhood' => 'Colonia',
			'county' => 'Municipio',
			'fk_state_dir' => 'Estado',
			'country' => 'Pa&iacute;s',
			'zipcode' => 'C&oacute;digo Postal',
			'status' => 'Status',
			'phone' => 'Tel&eacute;fono',
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

		$criteria->compare('pk_classroom_direction',$this->pk_classroom_direction,true);
		$criteria->compare('fk_client',$this->fk_client,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('street_number',$this->street_number);
		$criteria->compare('street_number_int',$this->street_number_int,true);
		$criteria->compare('neighborhood',$this->neighborhood,true);
		$criteria->compare('county',$this->county,true);
		$criteria->compare('fk_state_dir',$this->fk_state_dir);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('phone',$this->phone,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ClassroomAddress the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getClassroomAddress($fkCliente = 0){
            $criteria=new CDbCriteria;
            $criteria->select = 'street,street_number,street_number_int,neighborhood,county,fk_state_dir,country,zipcode,phone';
            $criteria->addCondition('fk_client='.$fkCliente);
            return ClassroomAddress::model()->find($criteria);
        }
}
