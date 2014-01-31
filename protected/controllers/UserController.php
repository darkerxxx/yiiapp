<?php
/**
 * UserController
 *
 * Контроллер для наших пользователей. Содержит в себе следующие функции:
 * - авторизация
 * - регистрация
 * - выход
 * - редактирование профиля [в будущем]
 *
 * @version 1.0
 *
 */
class UserController extends CController
{
	/*public function actions()
	{
		return array(
				// Создаем экшинс captcha.
				// Он понадобиться нам для формы регистрации (да и авторизации)
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
	 * Метод входа на сайт
	 *
	 * Метод в котором мы выводим форму авторизации
	 * и обрабатываем её на правильность.
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
		// Проверяем является ли пользователь гостем
		// ведь если он уже зарегистрирован - формы он не должен увидеть.
		if (!Yii::app()->user->isGuest) {
			throw new CException('You are already registered!');
		} else {
			//if (!empty($_POST['User'])) {
			if (isset($_POST['User'])) {
				$form->attributes = $_POST['User'];
				//$form->verifyCode = $_POST['User']['verifyCode'];
		
				// Проверяем правильность данных
				if($form->validate('login')) {
				//if($form->validate() && $form->login()) {
					// если всё ок - кидаем на главную страницу
					//$this->redirect(Yii::app()->homeUrl);
					$this->redirect(Yii::app()->user->returnUrl);
				}
			}
			$this->render('login', array('form' => $form));
		}
	}

	/**
	 * Метод выхода с сайта
	 *
	 * Данный метод описывает в себе выход пользователя с сайта
	 * Т.е. кнопочка "выход"
	 */
	public function actionLogout()
	{
		// Выходим
		Yii::app()->user->logout();
		// Перезагружаем страницу
		$this->redirect(Yii::app()->user->returnUrl);
	}

	/**
	 * Метод регистрации
	 *
	 * Выводим форму для регистрации пользователя и проверяем
	 * данные которые придут от неё.
	 */
	public function actionRegistration()
	{
		// тут думаю все понятно
		$form = new User();
		
		// Проверяем являеться ли пользователь гостем
		// ведь если он уже зарегистрирован - формы он не должен увидеть.
		if (!Yii::app()->user->isGuest) {
			throw new CException('You are already registered!');
		} else {
			// Если $_POST['User'] не пустой массив - значит была отправлена форма
			// следовательно нам надо заполнить $form этими данными
			// и провести валидацию. Если валидация пройдет успешно - пользователь
			// будет зарегистрирован, не успешно - покажем ошибку на экран
			if (!empty($_POST['User'])) {
		
				// Заполняем $form данными которые пришли с формы
				$form->attributes = $_POST['User'];
		
				// Запоминаем данные которые пользователь ввёл в капче
				//$form->verifyCode = $_POST['User']['verifyCode'];
		
				// В validate мы передаем название сценария. Оно нам может понадобиться
				// когда будем заниматься созданием правил валидации [читайте дальше]
				if($form->validate('registration')) {
					// Если валидация прошла успешно...
					// Тогда проверяем свободен ли указанный логин..
		
					if ($form->model()->count("login = :login", array(':login' => $form->login))) {
						// Указанный логин уже занят. Создаем ошибку и передаем в форму
						$form->addError('login', 'This login is already taken.');
						$this->render("registration", array('form' => $form));
					} else {
						// Выводим страницу что "все окей"
						$form->save();
						$this->render("registration_ok");
					}
					 
				} else {
					// Если введенные данные противоречат
					// правилам валидации (указаны в rules) тогда
					// выводим форму и ошибки.
					// [Внимание!] Нам ненадо передавать ошибку в отображение,
					// Она автоматически после валидации цепляеться за
					// $form и будет [автоматически] показана на странице с
					// формой! Так что мы тут делаем простой рэндер.
		
					$this->render("registration", array('form' => $form));
				}
			} else {
				// Если $_POST['User'] пустой массив - значит форму некто не отправлял.
				// Это значит что пользователь просто вошел на страницу регистрации
				// и ему мы должны просто показать форму.
				 
				$this->render("registration", array('form' => $form));
			}
		}
	}

}