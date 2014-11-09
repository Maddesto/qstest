<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $repeat_password
 * @property string $email
 * @property string $first_name
 * @property string $surname
 * @property string $gender
 * @property string $about
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}
	
	public $passwordChanged = false;
	
	public $repeat_password;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email, first_name, surname', 'length', 'max'=>30),
			array('email', 'email', 'message' => 'Email address is incorrect'),
			array('first_name, surname, username', 'required','message'=>'You don\'t enter {attribute}'),
			array('password, repeat_password', 'required', 'message' => 'Please enter {attribute}', 'on' => 'insert'),
			array('email', 'required', 'message'=>'Please enter email'),
			array('username, email, first_name, surname, gender', 'required', 'on' => 'update'),
			array('password, repeat_password', 'length', 'max'=>12, 'min'=>6),
			array('password', 'compare', 'compareAttribute'=>'repeat_password', 'message'=> 'Passwords doesn\'t match'),
			array('gender', 'length', 'max'=>1),
			array('username', 'unique', 'message' => 'A profile with this username already exists'),
			array('about', 'safe'),
			array('gender', 'required', 'message' => 'Choose your gender'),
			array('email', 'unique', 'message' => 'A profile with this email address already exists'),
			array('password', 'passwordRule'),
			array('id, username, password, email, first_name, surname, gender, about', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'password' => 'Password',
			'repeat_password' => 'Repeat password',
			'email' => 'Email',
			'first_name' => 'First Name',
			'surname' => 'Surname',
			'gender' => 'Gender',
			'about' => 'About',
			'date_added' => 'Date Added'
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

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('about',$this->about,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function authenticate($attribute, $params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity = new UserIdentity($this->email, $this->password, $this->username);

			if(!$this->_identity->authenticate()) {
                Yii::app()->user->setFlash('error', 'Вы ввели неверный логин или пароль.');
            }
		}
	}
	
	public function beforeSave() {
        if ($this->getIsNewRecord() || $this->passwordChanged) {
            $this->password = md5($this->password);
        }
        if($this->getIsNewRecord()){
        	$this->date_added = time();
        }
        return parent::beforeSave();
    }
    
    public function passwordRule($attribute, $params)
    {
    	$pattern = '/(?=^.{6,12}$)((?=.*\d))(?=.*\W+)(?![.\n])(?=.*[A-Z]).*$/';
    	if(!empty($this->$attribute) && !preg_match($pattern, $this->$attribute))
    		$this->addError($attribute, 'Password is too simple');
    }
    public function afterSave(){
    	if($this->getIsNewRecord()){
    		$this->sendUserGreating();
    	}
    	parent::afterSave();
    }
    
    public function sendUserGreating(){
    	$username = $this->first_name.' '.$this->surname;
    	$subject = "Site registration";
    	$name='=?UTF-8?B?'.base64_encode($username).'?=';
    	$subject='=?UTF-8?B?'.base64_encode($subject).'?=';
    	$headers="From: Administration\r\n".
    			"Reply-To: {$name}\r\n".
    			"MIME-Version: 1.0\r\n".
    			"Content-Type: text/plain; charset=UTF-8";
    	$body = "Thank you for registration!!";
    	mail($this->email,$subject,$body,$headers);
    }
}
