<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $Id
 * @property string $user_name
 * @property string $password
 * @property string $email
 * @property string $role
 * @property string $join_date
 */
class User extends CActiveRecord
{
	public $salt;
	public $password_repeat;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('password', 'required'),
			array('username, email', 'required', 'on'=>'register, user-update'),
			array('username, email', 'length', 'max'=>100, 'on'=>'register, user-update'),
			array('email', 'email','checkMX'=>true),
			array('username, email', 'unique'),
			array('password', 'length', 'max'=>255),
			array('password', 'compare'),
			array('password_repeat', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, role, join_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'User Name',
			'password' => 'Password',
			'password_repeat' => 'Password again',
			'email' => 'Email',
			'role' => 'Role',
			'join_date' => 'Join Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('role',$this->role);
		$criteria->compare('join_date',$this->join_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function validatePassword($password)
    {
        return $this->hashPassword($password)===$this->password;
    }
 
    public function hashPassword($password)
    {
        return md5($password);
    }

    public function beforeSave(){
    	$this->password = $this->hashPassword($this->password);
    	return parent::beforeSave();
    	
    }

}