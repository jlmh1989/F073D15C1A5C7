<?php

/**
 * This is the model class for table "tbl_e24_groups".
 *
 * The followings are the available columns in table 'tbl_e24_groups':
 * @property string $pk_group
 * @property string $desc_group
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Courses[] $courses
 * @property StudentsGroup[] $studentsGroups
 */
class Groups extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('desc_group, status', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('desc_group', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_group, desc_group, status', 'safe', 'on'=>'search'),
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
			'courses' => array(self::HAS_MANY, 'Courses', 'fk_group'),
			'studentsGroups' => array(self::HAS_MANY, 'StudentsGroup', 'fk_group'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_group' => 'Id',
			'desc_group' => 'Descripci&oacute;n',
			'status' => 'Estatus',
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

		$criteria->compare('pk_group',$this->pk_group,true);
		$criteria->compare('desc_group',$this->desc_group,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Groups the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getGroups()
        {
            $criteria=new CDbCriteria;
            $criteria-> select='pk_group,desc_group';
           		            
            return CHtml::listData(Groups::model()->findAll($criteria),'pk_group','desc_group');
        } 
}
