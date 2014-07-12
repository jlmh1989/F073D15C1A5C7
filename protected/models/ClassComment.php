<?php

/**
 * This is the model class for table "tbl_e24_class_comment".
 *
 * The followings are the available columns in table 'tbl_e24_class_comment':
 * @property integer $pk_class_comment
 * @property string $fk_course
 * @property string $date
 * @property string $initial_hour
 * @property string $final_hour
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property Courses $fkCourse
 */
class ClassComment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_class_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_course, date, initial_hour, final_hour', 'required'),
			array('fk_course', 'length', 'max'=>10),
			array('comment', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_class_comment, fk_course, date, initial_hour, final_hour, comment', 'safe', 'on'=>'search'),
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
			'fkCourse' => array(self::BELONGS_TO, 'Courses', 'fk_course'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_class_comment' => 'Pk Class Comment',
			'fk_course' => 'Fk Course',
			'date' => 'Date',
			'initial_hour' => 'Initial Hour',
			'final_hour' => 'Final Hour',
			'comment' => 'Comment',
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

		$criteria->compare('pk_class_comment',$this->pk_class_comment);
		$criteria->compare('fk_course',$this->fk_course,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('initial_hour',$this->initial_hour,true);
		$criteria->compare('final_hour',$this->final_hour,true);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ClassComment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
