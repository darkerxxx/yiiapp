<?php
class UserTest extends CDbTestCase
{
	public function testUser ()
	{
		$user = new User('registration');
		$user->setAttributes(array(
		'username' => 'test',
		'password' => 'test',
		'password2' => 'test',
		));
		$tihs->assertTrue($user->save());
	}
}