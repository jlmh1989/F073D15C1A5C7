<?php

/**
 * This is the model class for table "tbl_e24_cat_material_detail".
 *
 * The followings are the available columns in table 'tbl_e24_cat_material_detail':
 * @property string $pk_material_detail
 * @property string $material_code
 * @property string $comment
 * @property integer $availability
 * @property integer $fk_cat_material
 *
 * The followings are the available model relations:
 * @property CatMaterial $fkCatMaterial
 */
class CatMaterialDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_cat_material_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pk_material_detail, fk_cat_material', 'required'),
			array('availability, fk_cat_material', 'numerical', 'integerOnly'=>true),
			array('pk_material_detail', 'length', 'max'=>10),
			array('material_code', 'length', 'max'=>45),
			array('comment', 'length', 'max'=>300),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_material_detail, material_code, comment, availability, fk_cat_material', 'safe', 'on'=>'search'),
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
			'fkCatMaterial' => array(self::BELONGS_TO, 'CatMaterial', 'fk_cat_material'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_material_detail' => 'ID',
			'material_code' => 'Material Code',
			'comment' => 'Comment',
			'availability' => 'Availability',
			'fk_cat_material' => 'Fk Cat Material',
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

		$criteria->compare('pk_material_detail',$this->pk_material_detail,true);
		$criteria->compare('material_code',$this->material_code,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('availability',$this->availability);
		$criteria->compare('fk_cat_material',$this->fk_cat_material);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CatMaterialDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getListMaterialDetail($pkLevel, $pkMaterialDetalle){
            $criteria = new CDbCriteria;
            $criteria->with = array("fkCatMaterial");
            $criteria->select = 't.pk_material_detail, t.material_code';
            //concat(t.material_code, \' - \' ,tbl_e24_cat_material.desc_material) as descripcion
            $criteria->join = 'inner join tbl_e24_cat_material on
                               t.fk_cat_material = tbl_e24_cat_material.pk_material inner join tbl_e24_material_level on
                               tbl_e24_cat_material.pk_material = tbl_e24_material_level.fk_material';
            $criteria->addCondition('tbl_e24_material_level.fk_level = '.$pkLevel);
            $criteria->addCondition('t.availability = '.constantes::ACTIVO);
            if($pkMaterialDetalle != NULL && $pkMaterialDetalle != ''){
                $criteria->addCondition('t.pk_material_detail = '.$pkMaterialDetalle, 'OR');
            }
            //return CatMaterialDetail::model()->findAll($criteria);
            $models = CatMaterialDetail::model()->findAll($criteria);
            $data = array();
            foreach ($models as $model) {
                $data[$model->pk_material_detail] = '['.$model->material_code.']  '.$model->fkCatMaterial->desc_material;
            }
            return $data;
        }
}
