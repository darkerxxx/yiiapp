<?php
/**
 * UserController
 *
 * ���������� ��� ����� �������������. �������� � ���� ��������� �������:
 * - �����������
 * - �����������
 * - �����
 * - �������������� ������� [� �������]
 *
 * @version 1.0
 *
 */
class UserController extends CController
{
	/*public function actions()
	{
		return array(
				// ������� ������ captcha.
				// �� ������������ ��� ��� ����� ����������� (�� � �����������)
				'captcha'=>array(
						'class'=>'CCaptchaAction',
						'backColor'=> 0x003300,
						'maxLength'=> 3,
						'minLength'=> 3,
						'foreColor'=> 0x66FF66,
				),
		);
	}*/

	/**
	 * ����� ����� �� ����
	 *
	 * ����� � ������� �� ������� ����� �����������
	 * � ������������ � �� ������������.
	 */
	public function actionLogin()
	{
		$form = new User();
		 
		//
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-login')
		{
			echo CActiveForm::validate($form);
			Yii::app()->end();
		}
		//
		// ��������� �������� �� ������������ ������
		// ���� ���� �� ��� ��������������� - ����� �� �� ������ �������.
		if (!Yii::app()->user->isGuest) {
			throw new CException('You are already registered!');
		} else {
			//if (!empty($_POST['User'])) {
			if (isset($_POST['User'])) {
				$form->attributes = $_POST['User'];
				//$form->verifyCode = $_POST['User']['verifyCode'];
		
				// ��������� ������������ ������
				if($form->validate('login')) {
				//if($form->validate() && $form->login()) {
					// ���� �� �� - ������ �� ������� ��������
					//$this->redirect(Yii::app()->homeUrl);
					$this->redirect(Yii::app()->user->returnUrl);
				}
			}
			$this->render('login', array('form' => $form));
		}
	}

	/**
	 * ����� ������ � �����
	 *
	 * ������ ����� ��������� � ���� ����� ������������ � �����
	 * �.�. �������� "�����"
	 */
	public function actionLogout()
	{
		// �������
		Yii::app()->user->logout();
		// ������������� ��������
		$this->redirect(Yii::app()->user->returnUrl);
	}

	/**
	 * ����� �����������
	 *
	 * ������� ����� ��� ����������� ������������ � ���������
	 * ������ ������� ������ �� ��.
	 */
	public function actionRegistration()
	{
		// ��� ����� ��� �������
		$form = new User();
		
		// ��������� ��������� �� ������������ ������
		// ���� ���� �� ��� ��������������� - ����� �� �� ������ �������.
		if (!Yii::app()->user->isGuest) {
			throw new CException('You are already registered!');
		} else {
			// ���� $_POST['User'] �� ������ ������ - ������ ���� ���������� �����
			// ������������� ��� ���� ��������� $form ����� �������
			// � �������� ���������. ���� ��������� ������� ������� - ������������
			// ����� ���������������, �� ������� - ������� ������ �� �����
			if (!empty($_POST['User'])) {
		
				// ��������� $form ������� ������� ������ � �����
				$form->attributes = $_POST['User'];
		
				// ���������� ������ ������� ������������ ��� � �����
				//$form->verifyCode = $_POST['User']['verifyCode'];
		
				// � validate �� �������� �������� ��������. ��� ��� ����� ������������
				// ����� ����� ���������� ��������� ������ ��������� [������� ������]
				if($form->validate('registration')) {
					// ���� ��������� ������ �������...
					// ����� ��������� �������� �� ��������� �����..
		
					if ($form->model()->count("login = :login", array(':login' => $form->login))) {
						// ��������� ����� ��� �����. ������� ������ � �������� � �����
						$form->addError('login', 'This login is already taken.');
						$this->render("registration", array('form' => $form));
					} else {
						// ������� �������� ��� "��� ����"
						$form->save();
						$this->render("registration_ok");
					}
					 
				} else {
					// ���� ��������� ������ ������������
					// �������� ��������� (������� � rules) �����
					// ������� ����� � ������.
					// [��������!] ��� ������ ���������� ������ � �����������,
					// ��� ������������� ����� ��������� ���������� ��
					// $form � ����� [�������������] �������� �� �������� �
					// ������! ��� ��� �� ��� ������ ������� ������.
		
					$this->render("registration", array('form' => $form));
				}
			} else {
				// ���� $_POST['User'] ������ ������ - ������ ����� ����� �� ���������.
				// ��� ������ ��� ������������ ������ ����� �� �������� �����������
				// � ��� �� ������ ������ �������� �����.
				 
				$this->render("registration", array('form' => $form));
			}
		}
	}

}