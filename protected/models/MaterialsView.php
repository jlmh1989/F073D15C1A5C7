<?php

/**
 * This is the model class for table "tbl_e24_materials_view".
 *
 * The followings are the available columns in table 'tbl_e24_materials_view':
 * @property integer $pk_material
 * @property string $desc_material
 * @property integer $fk_type_material
 * @property string $desc_cat_detail_es
 * @property string $total_stock
 * @property string $actual_stock
 */
class MaterialsView extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_materials_view';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('desc_material, fk_type_material, desc_cat_detail_es', 'required'),
			array('pk_material, fk_type_material', 'numerical', 'integerOnly'=>true),
			array('desc_material', 'length', 'max'=>50),
			array('desc_cat_detail_es', 'length', 'max'=>20),
			array('total_stock, actual_stock', 'length', 'max'=>21),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_material, desc_material, fk_type_material, desc_cat_detail_es, total_stock, actual_stock', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_material' => 'ID',
			'desc_material' => 'Material',
			'fk_type_material' => 'Fk Type Material',
			'desc_cat_detail_es' => 'Tipo',
			'total_stock' => 'Existencia',
			'actual_stock' => 'Disponible',
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
		$criteria->compare('desc_cat_detail_es',$this->desc_cat_detail_es,true);
		$criteria->compare('total_stock',$this->total_stock,true);
		$criteria->compare('actual_stock',$this->actual_stock,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MaterialsView the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        
        
        public function primaryKey(){
            return 'pk_material';
        }        
        
}
