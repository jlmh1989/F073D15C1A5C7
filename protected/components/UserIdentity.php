<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
            $user = Users::model()->find("username=?", array($this->username));
            if($user === null){
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            }elseif(crypt($this->password, constantes::PATRON_PASS) !== $user->password){
		$this->errorCode=self::ERROR_PASSWORD_INVALID;
            }else if($user->status === "0"){
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            }else{
		$this->errorCode=self::ERROR_NONE;
                $this->setState("rol", $user->fk_role);
            }
            return !$this->errorCode;
	}
}