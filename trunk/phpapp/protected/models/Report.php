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
 * @property string $reported_for_date
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
			array('created_at, updated_at, reported_for_date, time_started_at, time_ended_at, comment', 'safe'),
			array('user_id, project_id, reported_for_date, time_started_at', 'required'),

			array('project_id', 'validateUserProjectBinding', 'user_id' => 'user_id'),
			array('time_started_at', 'validateTimeOverlap', 'with' => 'time_ended_at'),
			array('reported_for_date', 'validatePastReportDateLimit'),
			array('reported_for_date', 'validateFutureReports'),

			array('time_started_at, time_ended_at', 'match', 'pattern' => '/([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]/', 'message' => 'Invalid time format'),
            array('reported_for_date', 'date', 'format'=>'yyyy-M-d'),
			// The following rule is used by search().
			array('id, user_id, project_id, created_at, updated_at, updated_by_id, reported_for_date, time_started_at, time_ended_at, comment', 'safe', 'on'=>'search'),
		);
	}

    protected function beforeDelete()
    {
        if(parent::beforeDelete()){
            if(!$this->checkPastReportDateLimit()){
                throw new CHttpException(400, 'Sorry, to late :)');
            }

            if($this->user_id != Yii::app()->user->id){
                throw new CHttpException(403, 'Forbidden');
            }
            return true;
        }
        return false;
    }


    public function validateUserProjectBinding($attribute, $params){

        if(!Project::isUserBounded($this->project_id, $this->user_id)){
            $this->addError('project_id', 'Not bounded to project');
        }
    }

    public function validatePastReportDateLimit(){
        if(!$this->checkPastReportDateLimit()){
            $this->addError('reported_for_date', 'Sorry, to late :)');
        }
    }

    public function validateFutureReports(){
        if(
            date('d') < date('d', strtotime($this->reported_for_date)) or
            date('m') < date('m', strtotime($this->reported_for_date)) or
            date('y') < date('y', strtotime($this->reported_for_date))
        ){
            $this->addError('reported_for_date', 'You cant see future :)');
        }
    }

    public function validateTimeOverlap($attribute, $params){

        $hasStartTimeIntersection = Report::model()->count(":started_at BETWEEN t.time_started_at AND t.time_ended_at AND t.user_id = :mine_id AND t.reported_for_date = :reported_for_date", [
            'started_at' => $this->time_started_at,
            'mine_id' => Yii::app()->user->id,
            'reported_for_date' => $this->reported_for_date,
        ]);
        $hasEndTimeIntersection = Report::model()->count("t.time_started_at BETWEEN :started_at AND :ended_at AND t.user_id = :mine_id AND t.reported_for_date = :reported_for_date", [
            'started_at' => $this->time_started_at,
            'ended_at' => $this->time_ended_at,
            'mine_id' => Yii::app()->user->id,
            'reported_for_date' => $this->reported_for_date,
        ]);

        if($hasStartTimeIntersection){
            $this->addError('time_started_at', 'Start time intersection range found');
        }
        if($hasEndTimeIntersection){
            $this->addError('time_ended_at', 'End time intersection range found');
        }
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
			'reported_for_date' => 'Reported At',
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
		$criteria->compare('reported_for_date',$this->reported_for_date,true);
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

    protected function beforeValidate()
    {
        if(!$this->time_started_at){
            $this->time_started_at = date('H:i:s', time());
        }
        if(!$this->reported_for_date){
            $this->reported_for_date = date('Y-m-d', time());;
        }
        return parent::beforeValidate();
    }

    public function checkPastReportDateLimit(){
        $lastReportDateLimitInSec = $this->getPastReportDateLimit();
        return time() - strtotime($this->reported_for_date) < $lastReportDateLimitInSec;
    }

    public static function getPastReportDateLimit(){
        //3 days in sec
        return 259200;
    }

}
