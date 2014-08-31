<?php

/**
 * This is the model class for table "tbl_e24_cat_level_detail".
 *
 * The followings are the available columns in table 'tbl_e24_cat_level_detail':
 * @property string $pk_level_detail
 * @property integer $fk_level
 * @property string $topics
 * @property string $duration
 * @property string $unit
 * @property string $pages
 * @property integer $is_exam
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property CatLevels $fkLevel
 */
class CatLevelDetail extends CActiveRecord
{
    private $estatusValidacion;

    public function setEstatusValidacion($estatusValidacion){
        $this->estatusValidacion = $estatusValidacion;
    }
    
    public function getEstatusValidacion(){
        return $this->estatusValidacion;
    }


    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_cat_level_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_level, topics, duration, status', 'required'),
			array('fk_level, is_exam, status', 'numerical', 'integerOnly'=>true),
			array('topics, unit, pages', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_level_detail, fk_level, topics, duration, unit, pages, is_exam, status', 'safe', 'on'=>'search'),
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
			'fkLevel' => array(self::BELONGS_TO, 'CatLevels', 'fk_level'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_level_detail' => 'Id',
			'fk_level' => 'Nivel',
			'topics' => 'Tema',
			'duration' => 'Duraci&oacute;n',
			'unit' => 'Unidad',
			'pages' => 'P&aacute;ginas',
			'is_exam' => 'Es examen',
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

		$criteria->compare('pk_level_detail',$this->pk_level_detail,true);
		$criteria->compare('fk_level',$this->fk_level);
		$criteria->compare('topics',$this->topics,true);
		$criteria->compare('duration',$this->duration,true);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('pages',$this->pages,true);
		$criteria->compare('is_exam',$this->is_exam);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getCatLevelDetailsListData($pkLevel)
        {
            $criteria=new CDbCriteria;
            $criteria-> select='pk_level_detail,topics';
            if($pkLevel != NULL){
                $criteria->addCondition('fk_level='.$pkLevel);
            }
            return CHtml::listData(CatLevelDetail::model()->findAll($criteria),'pk_level_detail','topics');
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CatLevelDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
