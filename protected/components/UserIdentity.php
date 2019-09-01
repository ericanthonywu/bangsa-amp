<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	
	const ERROR_INNACTIVE = 4;
	const ERROR_BANNED = 5;
	const ERROR_IS_NOT_ADMIN = 6;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
		private $_id;
		private $_username;
	
		public function getName(){
			return $this->_username;
		}	
		
		public function getId(){
			return $this->_id;
		}
		
		public function authenticate(){
			$user= Users::model()->findByAttributes(array('username'=>$this->username));
			if($user === null){
				$this->errorCode= self::ERROR_USERNAME_INVALID;
			}
			elseif($user->password !== md5($this->password)){
				$this->errorCode= self::ERROR_PASSWORD_INVALID;
			}
			elseif($user->status == 0){
				$this->errorCode= self::ERROR_INNACTIVE;
			}
			elseif($user->status == -1){
				$this->errorCode= self::ERROR_BANNED;
			}
			elseif($user->superuser == 0){
				$this->errorCode= self::ERROR_IS_NOT_ADMIN;
			}
			else{
				$this->_id = $user->id;
				$this->_username = $user->username;
				$this->errorCode= self::ERROR_NONE;
			}
			return $this->errorCode;
		}
}