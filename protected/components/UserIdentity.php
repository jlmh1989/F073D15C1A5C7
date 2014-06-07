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
                $this->setState("pk_user", $user->pk_user);
                if($user->fk_role === constantes::ROL_CLIENTE){
                    $modelC = Clients::model()->find('fk_user='.$user->pk_user);
                    $this->setState("foto", $modelC->client_photo === null || $modelC->client_photo === ''? '':'images/client_photo/'.$modelC->client_photo);
                    $this->setState("nombre", $modelC->client_name);
                }else if($user->fk_role === constantes::ROL_ESTUDIANTE){
                    $modelS = Students::model()->find('fk_user='.$user->pk_user);
                    $this->setState("foto", '');
                    $this->setState("nombre", $modelS->name);
                }else if($user->fk_role === constantes::ROL_MAESTRO){
                    $modelT = Teachers::model()->find('fk_user='.$user->pk_user);
                    $this->setState("foto", '');
                    $this->setState("nombre", $modelT->name);
                }else{
                    $this->setState("foto", '');
                    $this->setState("nombre", '');
                }
            }
            return !$this->errorCode;
	}
}