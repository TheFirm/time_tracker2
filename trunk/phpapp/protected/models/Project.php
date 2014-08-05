<?php

/**
 * This is the model class for table "projects".
 *
 * The followings are the available columns in table 'projects':
 * @property string $id
 * @property string $name
 * @property integer $active
 * @property string $lft
 * @property string $rgt
 * @property integer $level
 *
 * The followings are the available model relations:
 * @property Report[] $reports
 */
class Project extends CActiveRecord
{
    public function behaviors()
    {
        return array(
            'nestedSetBehavior' => array(
                'class' => 'nestedSetBehavior.NestedSetBehavior',
                'leftAttribute' => 'lft',
                'rightAttribute' => 'rgt',
                'levelAttribute' => 'level',
                'hasManyRoots ' => true,
            ),
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created_at',
                'updateAttribute' => 'updated_at',
            )
        );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'projects';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('lft, rgt, level', 'required'),
            array('active, level', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 50),
            array('lft, rgt', 'length', 'max' => 10),
            // The following rule is used by search().
            array('id, name, active, lft, rgt, level', 'safe', 'on' => 'search'),
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
            'reports' => array(self::HAS_MANY, 'Report', 'project_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'active' => 'Active',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'level' => 'Level',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('active', $this->active);
        $criteria->compare('lft', $this->lft, true);
        $criteria->compare('rgt', $this->rgt, true);
        $criteria->compare('level', $this->level);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Project the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function bindUser($project_id, $user_id){
        $userProject = new UserProject();
        $userProject->user_id = $user_id;
        $userProject->project_id = $project_id;
        if(!$userProject->save()){
            throw new CHttpException(500, CJSON::encode($userProject->getErrors()));
        }
    }

    public static function isUserBounded($project_id, $user_id){
        return UserProject::model()->exists('user_id = :user_id AND project_id = :project_id', [
            ':user_id' => $user_id,
            ':project_id' => $project_id,
        ]);
    }
}
