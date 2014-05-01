<?php

/**
 * This is the model class for table "tbl_e24_cat_rates".
 *
 * The followings are the available columns in table 'tbl_e24_cat_rates':
 * @property integer $pk_rate
 * @property string $desc_tarifa
 * @property double $rate
 *
 * The followings are the available model relations:
 * @property Teachers[] $teachers
 */
class CatRates extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_cat_rates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('desc_tarifa, rate', 'required'),
			array('rate', 'numerical'),
			array('desc_tarifa', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_rate, desc_tarifa, rate', 'safe', 'on'=>'search'),
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
			'teachers' => array(self::HAS_MANY, 'Teachers', 'fk_rate'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_rate' => 'Pk Rate',
			'desc_tarifa' => 'Desc Tarifa',
			'rate' => 'Rate',
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

		$criteria->compare('pk_rate',$this->pk_rate);
		$criteria->compare('desc_tarifa',$this->desc_tarifa,true);
		$criteria->compare('rate',$this->rate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CatRates the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getCatRates()
        {
            $criteria=new CDbCriteria;
            $criteria-> select='pk_rate,desc_tarifa';
           		            
            return CHtml::listData(CatRates::model()->findAll($criteria),'pk_rate','desc_tarifa');
        } 
}
