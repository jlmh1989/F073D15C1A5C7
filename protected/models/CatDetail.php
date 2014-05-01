<?php

/**
 * This is the model class for table "tbl_e24_cat_detail".
 *
 * The followings are the available columns in table 'tbl_e24_cat_detail':
 * @property integer $pk_cat_detail
 * @property string $desc_cat_detail_es
 * @property string $desc_cat_detail_en
 * @property integer $status
 * @property integer $fk_cat_master
 *
 * The followings are the available model relations:
 * @property CatMaster $fkCatMaster
 * @property CatMaterial[] $catMaterials
 * @property CatStatusClass[] $catStatusClasses
 * @property CatStatusClass[] $catStatusClasses1
 * @property ClassroomDirection[] $classroomDirections
 * @property Clients[] $clients
 * @property Courses[] $courses
 * @property Teachers[] $teachers
 * @property Teachers[] $teachers1
 * @property Teachers[] $teachers2
 * @property Teachers[] $teachers3
 * @property UnavailableDates[] $unavailableDates
 */
class CatDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_cat_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('desc_cat_detail_es, desc_cat_detail_en, status, fk_cat_master', 'required'),
			array('status, fk_cat_master', 'numerical', 'integerOnly'=>true),
			array('desc_cat_detail_es, desc_cat_detail_en', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_cat_detail, desc_cat_detail_es, desc_cat_detail_en, status, fk_cat_master', 'safe', 'on'=>'search'),
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
			'fkCatMaster' => array(self::BELONGS_TO, 'CatMaster', 'fk_cat_master'),
			'catMaterials' => array(self::HAS_MANY, 'CatMaterial', 'fk_type_material'),
			'catStatusClasses' => array(self::HAS_MANY, 'CatStatusClass', 'fk_role_class'),
			'catStatusClasses1' => array(self::HAS_MANY, 'CatStatusClass', 'fk_type_class'),
			'classroomDirections' => array(self::HAS_MANY, 'ClassroomDirection', 'fk_state_dir'),
			'clients' => array(self::HAS_MANY, 'Clients', 'fk_type_client'),
			'courses' => array(self::HAS_MANY, 'Courses', 'fk_type_course'),
			'teachers' => array(self::HAS_MANY, 'Teachers', 'fk_nationality'),
			'teachers1' => array(self::HAS_MANY, 'Teachers', 'fk_state_birth'),
			'teachers2' => array(self::HAS_MANY, 'Teachers', 'fk_state_dir'),
			'teachers3' => array(self::HAS_MANY, 'Teachers', 'fk_status_document'),
			'unavailableDates' => array(self::HAS_MANY, 'UnavailableDates', 'fk_unavailability_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_cat_detail' => 'Pk Cat Detail',
			'desc_cat_detail_es' => 'Desc Cat Detail Es',
			'desc_cat_detail_en' => 'Desc Cat Detail En',
			'status' => 'Status',
			'fk_cat_master' => 'Fk Cat Master',
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

		$criteria->compare('pk_cat_detail',$this->pk_cat_detail);
		$criteria->compare('desc_cat_detail_es',$this->desc_cat_detail_es,true);
		$criteria->compare('desc_cat_detail_en',$this->desc_cat_detail_en,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('fk_cat_master',$this->fk_cat_master);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CatDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /**
         * Consultar un catalogo
         * @param type $id
         * @param type $lang
         * @return type
         */
        public function getCatDetailsOptions($id=0,$lang='')
        {
            $criteria=new CDbCriteria;
            $criteria-> select='pk_cat_detail,desc_cat_detail_'.$lang;
            if($id>0) {
                $criteria->addCondition('fk_cat_master='.$id);
                $criteria->addCondition('status=1');
            } 
            return CHtml::listData(CatDetail::model()->findAll($criteria),'pk_cat_detail','desc_cat_detail_'.$lang);
        } 
}
