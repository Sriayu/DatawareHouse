<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
     private $_id;
     private $level;

// override the CBaseUserIdentity::getId()
// why should the method be overridden?
// in CBaseUserIdentity, this method returns username,
// in our case it shouldn't so we need to override it.
    public function getId() {
        return($this->_id);
    }

// override the CBaseUserIdentity::authenticate
    public function authenticate() {
// find the account by its username
        $account = TUser::model()->findByAttributes(array(  'username' => $this->username,));
        $username='';
        $pass='';
        
        if ($account && $account->comparePassword($this->password)) {
            $username=$account->username;
	    $pass=$account->password;
            $this->_id = $account->id;
            $this->errorCode = self::ERROR_NONE;
            return (TRUE);
        }
//        $users=array(// username => password
//			$username=>$pass,
//		);
        $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
        return (FALSE);
    }
}