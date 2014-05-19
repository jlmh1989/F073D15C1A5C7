<?php

/**
 * This is the model class for table "tbl_e24_clients".
 *
 * The followings are the available columns in table 'tbl_e24_clients':
 * @property string $pk_client
 * @property integer $fk_type_client
 * @property integer $fk_user
 * @property string $client_name
 * @property string $client_photo
 * @property string $contact_name
 * @property string $contact_mail
 * @property string $contact_phone
 * @property string $contact_phone_ext
 * @property string $client_web
 * @property integer $status
 * @property integer $billing_data
 * @property string $contact_cellphone
 *
 * The followings are the available model relations:
 * @property BillingData[] $billingDatas
 * @property ClassroomDirection[] $classroomDirections
 * @property CatDetail $fkTypeClient
 * @property Courses[] $courses
 * @property StudentsGroup[] $studentsGroups
 * @property Users $fkUser
 */
class Clients extends CActiveRecord
{
    public $image;
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_clients';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_type_client, client_name, contact_name, contact_mail, contact_phone, billing_data, contact_cellphone','required'),
			array('fk_type_client, status, billing_data', 'numerical', 'integerOnly'=>true),
			array('client_name, contact_name, contact_mail, client_web', 'length', 'max'=>100),
			array('contact_phone, contact_phone_ext, contact_cellphone', 'length', 'max'=>15),
                        array('contact_mail','email'),
                        array('client_photo', 'file', 'allowEmpty'=>true, 'types'=>'jpg, gif, png'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fk_type_client, client_name', 'safe', 'on'=>'search'),
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
			'billingDatas' => array(self::HAS_MANY, 'BillingData', 'fk_client'),
			'classroomDirections' => array(self::HAS_MANY, 'ClassroomDirection', 'fk_client'),
			'fkTypeClient' => array(self::BELONGS_TO, 'CatDetail', 'fk_type_client'),
			'courses' => array(self::HAS_MANY, 'Courses', 'fk_client'),
			'studentsGroups' => array(self::HAS_MANY, 'StudentsGroup', 'fk_client'),
                        'fkUser'=> array(self::BELONGS_TO, 'Users', 'fk_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_client' => 'Pk Client',
			'fk_type_client' => 'Tipo de Cliente',
			'client_name' => 'Nombre del Cliente',
			'contact_name' => 'Nombre',
			'contact_mail' => 'Correo',
			'contact_phone' => 'Tel&eacute;fono',
			'contact_phone_ext' => 'Extensi&oacute;n',
			'client_web' => 'P&aacute;gina Web',
			'status' => 'Status',
			'billing_data' => 'Datos de Faturaci&oacute;n',
			'contact_cellphone' => 'Celular',
                        'client_photo' => 'Seleccionar foto',
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
                $criteria->compare('fk_type_client',$this->fk_type_client);
		$criteria->compare('status', $this->status);
                $criteria->compare('client_name', $this->client_name, true);
                $sort = new CSort();
                $sort->attributes = array(
                    'client_name'=>array(
                        'asc'=>'client_name',
                        'desc'=>'client_name desc',
                    ),
                    'contact_name'=>array(
                        'asc'=>'contact_name',
                        'desc'=>'contact_name desc',
                    ),
                );
                
                $_SESSION['reporte_clientes'] = new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'sort'=>$sort,
                    'pagination'=>false,
		));
                if($this->fkTypeClient !== NULL){
                    $_SESSION['reporte_clientes_tipo'] = $this->fkTypeClient->desc_cat_detail_es;
                }else{
                    $_SESSION['reporte_clientes_tipo'] = 'Todos';
                }
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>$sort,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Clients the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getClients()
        {
            $criteria=new CDbCriteria;
            $criteria-> select='pk_client,client_name';
           		            
            return CHtml::listData(Clients::model()->findAll($criteria),'pk_client','client_name');
        } 
        
        public function getClientsActivos()
        {
            $criteria=new CDbCriteria;
            $criteria->select='pk_client,client_name';
            $criteria->addCondition('status='.constantes::ACTIVO);
            return CHtml::listData(Clients::model()->findAll($criteria),'pk_client','client_name');
        }
}
