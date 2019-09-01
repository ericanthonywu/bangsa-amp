<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
            {
                if($this->_identity->errorCode == 1)
					$this->addError('password','Password atau Username salah.');
                elseif($this->_identity->errorCode == 2)
					$this->addError('password','Password atau Username salah.');
                elseif($this->_identity->errorCode == 4)
					$this->addError('password','Username belum aktif, cek email anda untuk melakukan aktifasi.');
                elseif($this->_identity->errorCode == 5)
					$this->addError('password','Maaf, username anda telah dibanned.');
                elseif($this->_identity->errorCode == 7){
					$url = Yii::app()->getBaseUrl(true).'/user/login';
					$this->addError('password',"Anda tidak diperbolehkan untuk login melalui form ini, silakan login <a href=$url>disini</a>.");
				}
                else
                    $this->addError('username','Maaf, telah terjadi error.');
            }
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*1 : 0; // 1 hari
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
