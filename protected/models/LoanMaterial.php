<?php

/**
 * This is the model class for table "tbl_e24_loan_material".
 *
 * The followings are the available columns in table 'tbl_e24_loan_material':
 * @property string $pk_loan_material
 * @property string $fk_course
 * @property integer $fk_teacher
 * @property string $fk_material_detail
 * @property string $pick_date
 * @property string $drop_date
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property Courses $fkCourse
 * @property Teachers $fkTeacher
 */
class LoanMaterial extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_e24_loan_material';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_teacher, fk_material_detail, pick_date', 'required'),
			array('fk_teacher', 'numerical', 'integerOnly'=>true),
			array('fk_course, fk_material_detail', 'length', 'max'=>10),
			array('comment', 'length', 'max'=>300),
			array('drop_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk_loan_material, fk_course, fk_teacher, fk_material_detail, pick_date, drop_date, comment', 'safe', 'on'=>'search'),
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
			'fkTeacher' => array(self::BELONGS_TO, 'Teachers', 'fk_teacher'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_loan_material' => 'Pk Loan Material',
			'fk_course' => 'Fk Course',
			'fk_teacher' => 'Fk Teacher',
			'fk_material_detail' => 'Material',
			'pick_date' => 'Fecha préstamo',
			'drop_date' => 'Fecha entrega',
			'comment' => 'Comentario del préstamo',
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

		$criteria->compare('pk_loan_material',$this->pk_loan_material,true);
		$criteria->compare('fk_course',$this->fk_course,true);
		$criteria->compare('fk_teacher',$this->fk_teacher);
		$criteria->compare('fk_material_detail',$this->fk_material_detail,true);
		$criteria->compare('pick_date',$this->pick_date,true);
		$criteria->compare('drop_date',$this->drop_date,true);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LoanMaterial the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}   
        
        public function getFechaPrestamo($pkMaestro, $pkMaterialDetalle){
            $criteria = new CDbCriteria;
            $criteria->select = 't.pick_date';
            $criteria->addCondition('t.fk_teacher='.$pkMaestro);
            $criteria->addCondition('t.fk_material_detail='.$pkMaterialDetalle);
            $model = LoanMaterial::model()->find($criteria);
            return $model != NULL ? $model->pick_date : '';
        }
}
