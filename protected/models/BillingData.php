<?php

/**
 * This is the model class for table "tbl_e24_billing_data".
 *
 * The followings are the available columns in table 'tbl_e24_billing_data':
 * @property string $pk_billing_data
 * @property string $fk_client
 * @property string $street
 * @property integer $street_number
 * @property string $street_number_int
 * @property string $bussiness_name
 * @property string $county
 * @property string $neighborhood
 * @property string $state
 * @property string $country
 * @property string $zipcode
 * @property string $rfc
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Clients $fkClient
 */
class BillingData extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_billing_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('street, street_number, bussiness_name, county, neighborhood, state, country, zipcode, rfc', 'required'),
			array('street_number, status', 'numerical', 'integerOnly'=>true),
			array('fk_client', 'length', 'max'=>10),
			array('street, bussiness_name, county, neighborhood, state, country', 'length', 'max'=>100),
			array('street_number_int, zipcode', 'length', 'max'=>5),
			array('rfc', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_billing_data, fk_client, street, street_number, street_number_int, bussiness_name, county, neighborhood, state, country, zipcode, rfc, status', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_billing_data' => 'Pk Billing Data',
			'fk_client' => 'Fk Client',
			'street' => 'Calle',
			'street_number' => 'N&uacute;mero',
			'street_number_int' => 'N&uacute;mero Interior',
			'bussiness_name' => 'Raz&oacute;n Social',
			'county' => 'Municipio',
			'neighborhood' => 'Colonia',
			'state' => 'Estado',
			'country' => 'Pa&iacute;s',
			'zipcode' => 'C&oacute;digo Postal',
			'rfc' => 'RFC',
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

		$criteria->compare('pk_billing_data',$this->pk_billing_data,true);
		$criteria->compare('fk_client',$this->fk_client,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('street_number',$this->street_number);
		$criteria->compare('street_number_int',$this->street_number_int,true);
		$criteria->compare('bussiness_name',$this->bussiness_name,true);
		$criteria->compare('county',$this->county,true);
		$criteria->compare('neighborhood',$this->neighborhood,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('rfc',$this->rfc,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BillingData the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
