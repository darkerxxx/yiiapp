<?php
class User extends CActiveRecord
{
	// для капчи
	//public $verifyCode;
	// для поля "повтор пароля"
	public $password2;
	 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function tableName()
	{
		return 'users';
	}
	
	/**
	 * Правила валидации
	 */
	public function rules()
	{
		return array(
				// логин, пароль не должны быть больше 128-и символов, и меньше трёх
				array('login', 'length', 'max'=>24, 'min' => 4),
				array('password', 'length', 'max'=>32, 'min' => 4),
				// логин, пароль не должны быть пустыми
				array('login, password', 'required'),
				// для сценария registration поле passwd должно совпадать с полем passwd2
				array('password', 'compare', 'compareAttribute'=>'password2', 'on'=>'registration'),
				array('password', 'authenticate', 'on' => 'login'),
				// правило для проверки капчи что капча совпадает с тем что ввел пользователь
				//array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
				//array('login', 'match', 'pattern' => '/^[A-Za-z0-9А-Яа-я\s,]+$/u','message' => 'Логин содержит недопустимые символы.'),
				//array('login', 'match', 'pattern' => '/^[A-Za-z0-9А-Яа-я\s,]+$/u','message' => 'Login contains invalid symbols.'),
		);
	}
	
	/**
	 * Список атрибутов которые могут быть массово присвоены
	 * в любом из наших сценариев
	 *
	 * @return unknown
	 */
	public function safeAttributes()
	{
		//return array('login', 'passwd', 'passwd2', 'verifyCode');
		return array('login', 'password', 'password2');
	}
	
	/**
	 * Список синонимов
	 */
	public function attributeLabels()
	{
		return array(
				'login'     => 'Login',
				'password'  => 'Password',
				'password2' => 'Repeat password',
		);
	}
	
	public function authenticate($attribute,$params)
	{
		// Проверяем были ли ошибки в других правилах валидации.
		// если были - нет смысла выполнять проверку
		if(!$this->hasErrors())
		{
			// Создаем экземпляр класса UserIdentity
			// и передаем в его конструктор введенный пользователем логин и пароль (с формы)
			$identity= new UserIdentity($this->login, $this->password);
			// Выполняем метод authenticate (о котором мы с вами говорили пару абзацев назад)
			// Он у нас проверяет существует ли такой пользователь и возвращает ошибку (если она есть)
			// в $identity->errorCode
			$identity->authenticate();
	
			// Теперь мы проверяем есть ли ошибка..
			switch($identity->errorCode)
			{
				// Если ошибки нету...
				case UserIdentity::ERROR_NONE: {
					// Данная строчка говорит что надо выдать пользователю
					// соответствующие куки о том что он зарегистрирован, срок действий
					// у которых указан вторым параметром.
					Yii::app()->user->login($identity, 0);
					break;
				}
				case UserIdentity::ERROR_USERNAME_INVALID: {
					// Если логин был указан наверно - создаем ошибку
					$this->addError('login','User does not exist!');
					break;
				}
				case UserIdentity::ERROR_PASSWORD_INVALID: {
					// Если пароль был указан наверно - создаем ошибку
					$this->addError('password','Invalid password!');
					break;
				}
			}
		}
	}
}