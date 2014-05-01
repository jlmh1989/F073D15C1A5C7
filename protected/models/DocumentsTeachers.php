<?php

/**
 * This is the model class for table "tbl_e24_documents_teachers".
 *
 * The followings are the available columns in table 'tbl_e24_documents_teachers':
 * @property integer $fk_document
 * @property integer $fk_teacher
 * @property integer $status
 * @property string $pk_docs_teacher
 *
 * The followings are the available model relations:
 * @property CatDocuments $fkDocument
 * @property Teachers $fkTeacher
 */
class DocumentsTeachers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_documents_teachers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_document, fk_teacher, status', 'required'),
			array('fk_document, fk_teacher, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fk_document, fk_teacher, status, pk_docs_teacher', 'safe', 'on'=>'search'),
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
			'fkDocument' => array(self::BELONGS_TO, 'CatDocuments', 'fk_document'),
			'fkTeacher' => array(self::BELONGS_TO, 'Teachers', 'fk_teacher'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fk_document' => 'Fk Document',
			'fk_teacher' => 'Fk Teacher',
			'status' => 'Status',
			'pk_docs_teacher' => 'Pk Docs Teacher',
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

		$criteria->compare('fk_document',$this->fk_document);
		$criteria->compare('fk_teacher',$this->fk_teacher);
		$criteria->compare('status',$this->status);
		$criteria->compare('pk_docs_teacher',$this->pk_docs_teacher,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DocumentsTeachers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
     
}
