<?php

/**
 *
 * @property integer $fk_level
 * @property string $fk_client
 * @property integer $fk_type_course
 * @property string $fk_group
 * @property string $initial_date
 * @property string $desc_curse
 * @property string $other_level
 *
 * @property CatLevels $fkLevel
 * @property Clients $fkClient
 * @property Groups $fkGroup
 * @property CatDetail $fkTypeCourse
 */
class CursoDatos extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_e24_courses';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fk_level, fk_client, fk_type_course, initial_date, desc_curse', 'required'),
            array('fk_level, fk_type_course', 'numerical', 'integerOnly' => true),
            array('fk_client, fk_group', 'length', 'max' => 10),
            array('desc_curse, other_level', 'length', 'max' => 50),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'fkLevel' => array(self::BELONGS_TO, 'CatLevels', 'fk_level'),
            'fkClient' => array(self::BELONGS_TO, 'Clients', 'fk_client'),
            'fkGroup' => array(self::BELONGS_TO, 'Groups', 'fk_group'),
            'fkTypeCourse' => array(self::BELONGS_TO, 'CatDetail', 'fk_type_course'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'fk_level' => 'Nivel',
            'fk_client' => 'Cliente',
            'fk_type_course' => 'Tipo de Curso',
            'fk_group' => 'Grupo',
            'initial_date' => 'Fecha de Inicio',
            'desc_curse' => 'Descripci&oacute;n Curso',
            'other_level' => 'Otro Nivel',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Courses the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
