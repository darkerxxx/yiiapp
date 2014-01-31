<?php
class User extends CActiveRecord
{
	// ��� �����
	//public $verifyCode;
	// ��� ���� "������ ������"
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
	 * ������� ���������
	 */
	public function rules()
	{
		return array(
				// �����, ������ �� ������ ���� ������ 128-� ��������, � ������ ���
				array('login', 'length', 'max'=>24, 'min' => 4),
				array('password', 'length', 'max'=>32, 'min' => 4),
				// �����, ������ �� ������ ���� �������
				array('login, password', 'required'),
				// ��� �������� registration ���� passwd ������ ��������� � ����� passwd2
				array('password', 'compare', 'compareAttribute'=>'password2', 'on'=>'registration'),
				array('password', 'authenticate', 'on' => 'login'),
				// ������� ��� �������� ����� ��� ����� ��������� � ��� ��� ���� ������������
				//array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
				//array('login', 'match', 'pattern' => '/^[A-Za-z0-9�-��-�\s,]+$/u','message' => '����� �������� ������������ �������.'),
				//array('login', 'match', 'pattern' => '/^[A-Za-z0-9�-��-�\s,]+$/u','message' => 'Login contains invalid symbols.'),
		);
	}
	
	/**
	 * ������ ��������� ������� ����� ���� ������� ���������
	 * � ����� �� ����� ���������
	 *
	 * @return unknown
	 */
	public function safeAttributes()
	{
		//return array('login', 'passwd', 'passwd2', 'verifyCode');
		return array('login', 'password', 'password2');
	}
	
	/**
	 * ������ ���������
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
		// ��������� ���� �� ������ � ������ �������� ���������.
		// ���� ���� - ��� ������ ��������� ��������
		if(!$this->hasErrors())
		{
			// ������� ��������� ������ UserIdentity
			// � �������� � ��� ����������� ��������� ������������� ����� � ������ (� �����)
			$identity= new UserIdentity($this->login, $this->password);
			// ��������� ����� authenticate (� ������� �� � ���� �������� ���� ������� �����)
			// �� � ��� ��������� ���������� �� ����� ������������ � ���������� ������ (���� ��� ����)
			// � $identity->errorCode
			$identity->authenticate();
	
			// ������ �� ��������� ���� �� ������..
			switch($identity->errorCode)
			{
				// ���� ������ ����...
				case UserIdentity::ERROR_NONE: {
					// ������ ������� ������� ��� ���� ������ ������������
					// ��������������� ���� � ��� ��� �� ���������������, ���� ��������
					// � ������� ������ ������ ����������.
					Yii::app()->user->login($identity, 0);
					break;
				}
				case UserIdentity::ERROR_USERNAME_INVALID: {
					// ���� ����� ��� ������ ������� - ������� ������
					$this->addError('login','User does not exist!');
					break;
				}
				case UserIdentity::ERROR_PASSWORD_INVALID: {
					// ���� ������ ��� ������ ������� - ������� ������
					$this->addError('password','Invalid password!');
					break;
				}
			}
		}
	}
}