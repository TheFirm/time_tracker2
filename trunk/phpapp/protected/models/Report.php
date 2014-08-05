<?php

/**
 * This is the model class for table "reports".
 *
 * The followings are the available columns in table 'reports':
 * @property string $id
 * @property string $user_id
 * @property string $project_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by_id
 * @property string $reported_at
 * @property string $time_started_at
 * @property string $time_ended_at
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Project $project
 */
class Report extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reports';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, project_id, updated_by_id', 'length', 'max'=>10),
			array('created_at, updated_at, reported_at, time_started_at, time_ended_at, comment', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, project_id, created_at, updated_at, updated_by_id, reported_at, time_started_at, time_ended_at, comment', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'project_id' => 'Project',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'updated_by_id' => 'Updated By',
			'reported_at' => 'Reported At',
			'time_started_at' => 'Time Started At',
			'time_ended_at' => 'Time Ended At',
			'comment' => 'Comment',
		);
	}

    public function behaviors(){
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created_at',
                'updateAttribute' => 'updated_at',
            )
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
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('updated_by_id',$this->updated_by_id,true);
		$criteria->compare('reported_at',$this->reported_at,true);
		$criteria->compare('time_started_at',$this->time_started_at,true);
		$criteria->compare('time_ended_at',$this->time_ended_at,true);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Report the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
