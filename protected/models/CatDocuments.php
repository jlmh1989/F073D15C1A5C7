<?php

/**
 * This is the model class for table "tbl_e24_cat_documents".
 *
 * The followings are the available columns in table 'tbl_e24_cat_documents':
 * @property integer $pk_document
 * @property string $desc_document
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Teachers[] $tblE24Teachers
 */
class CatDocuments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_cat_documents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('desc_document, status', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('desc_document', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_document, desc_document, status', 'safe', 'on'=>'search'),
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
			'tblE24Teachers' => array(self::MANY_MANY, 'Teachers', 'tbl_e24_documents_teachers(fk_document, fk_teacher)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_document' => 'Id',
			'desc_document' => 'Descripci&oacute;n',
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

		$criteria->compare('pk_document',$this->pk_document);
		$criteria->compare('desc_document',$this->desc_document,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CatDocuments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getCatDocuments()
        {
            $criteria=new CDbCriteria;
            $criteria-> select='pk_document,desc_document';
            return CHtml::listData(CatDocuments::model()->findAll($criteria),'pk_document','desc_document');
        }
        
        public function getCatDocumentsActivo()
        {
            $criteria=new CDbCriteria;
            $criteria-> select='pk_document,desc_document';
            $criteria->addCondition('status=1');
            return CHtml::listData(CatDocuments::model()->findAll($criteria),'pk_document','desc_document');
        }
}
