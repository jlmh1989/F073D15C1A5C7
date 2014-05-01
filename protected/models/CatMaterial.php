<?php

/**
 * This is the model class for table "tbl_e24_cat_material".
 *
 * The followings are the available columns in table 'tbl_e24_cat_material':
 * @property integer $pk_material
 * @property string $desc_material
 * @property integer $fk_type_material
 *
 * The followings are the available model relations:
 * @property CatDetail $fkTypeMaterial
 * @property CatLevels[] $tblE24CatLevels
 */
class CatMaterial extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_cat_material';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('desc_material, fk_type_material', 'required'),
			array('fk_type_material', 'numerical', 'integerOnly'=>true),
			array('desc_material', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_material, desc_material, fk_type_material', 'safe', 'on'=>'search'),
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
			'fkTypeMaterial' => array(self::BELONGS_TO, 'CatDetail', 'fk_type_material'),
			'tblE24CatLevels' => array(self::MANY_MANY, 'CatLevels', 'tbl_e24_material_level(fk_material, fk_level)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_material' => 'Pk Material',
			'desc_material' => 'Desc Material',
			'fk_type_material' => 'Fk Type Material',
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

		$criteria->compare('pk_material',$this->pk_material);
		$criteria->compare('desc_material',$this->desc_material,true);
		$criteria->compare('fk_type_material',$this->fk_type_material);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CatMaterial the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
