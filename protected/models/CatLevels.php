<?php

/**
 * This is the model class for table "tbl_e24_cat_levels".
 *
 * The followings are the available columns in table 'tbl_e24_cat_levels':
 * @property integer $pk_level
 * @property string $desc_level
 * @property integer $fk_associated_book
 * @property integer $total_hours
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property CatLevelDetail[] $catLevelDetails
 * @property Courses[] $courses
 * @property CatMaterial[] $tblE24CatMaterials
 */
class CatLevels extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_cat_levels';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('desc_level, fk_associated_book, total_hours, status', 'required'),
			array('fk_associated_book, total_hours, status', 'numerical', 'integerOnly'=>true),
			array('desc_level', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_level, desc_level, fk_associated_book, total_hours, status', 'safe', 'on'=>'search'),
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
			'catLevelDetails' => array(self::HAS_MANY, 'CatLevelDetail', 'fk_level'),
			'courses' => array(self::HAS_MANY, 'Courses', 'fk_level'),
			'tblE24CatMaterials' => array(self::MANY_MANY, 'CatMaterial', 'tbl_e24_material_level(fk_level, fk_material)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_level' => 'Id',
			'desc_level' => 'Descripci&oacute;n',
			'fk_associated_book' => 'Fk Associated Book',
			'total_hours' => 'Total Horas',
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

		$criteria->compare('pk_level',$this->pk_level);
		$criteria->compare('desc_level',$this->desc_level,true);
		$criteria->compare('fk_associated_book',$this->fk_associated_book);
		$criteria->compare('total_hours',$this->total_hours);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CatLevels the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getCatLevels()
        {
            $criteria=new CDbCriteria;
            $criteria-> select='pk_level,desc_level';
            return CHtml::listData(CatLevels::model()->findAll($criteria),'pk_level','desc_level');
        } 
}
