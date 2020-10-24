<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegistrationForm extends Model
{
	public $username;
	public $email;
	public $password;
	public $password_repeat;

	public function rules()
	{
		return [
			[['username', 'email', 'password', 'password_repeat'], 'required'],
			[['username', 'email'], 'string', 'min' => 4, 'max' => 16],
			[['password'], 'string', 'min' => 4],
			['password_repeat', 'compare', 'compareAttribute' => 'password'],
		];
	}

	/**
	 * @return bool
	 */
	public function register()
	{
		$user = new User();

		$user->username = $this->username;
		$user->email = $this->email;
		$user->password = Yii::$app->security->generatePasswordHash($this->password);
		$user->access_token = Yii::$app->security->generateRandomString();
		$user->auth_key = Yii::$app->security->generateRandomString();

		if (!$user->save()){
			Yii::error('The user was not saved.' . VarDumper::dumpAsString($user->errors));
		}
		return true;
	}
}
