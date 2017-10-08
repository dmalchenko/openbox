<?php

namespace app\models;

use app\modules\freekassa\models\Freekassable;
use ErrorException;
use Yii;

class User extends \yii\base\Object implements \yii\web\IdentityInterface, Freekassable {
	public $id;
	public $username;
	public $password;
	public $authKey;
	public $accessToken;
	public $money;
	/**
	 * @var array EAuth attributes
	 */
	public $profile;

	private static $users = [
		'100' => [
			'id' => '100',
			'username' => 'admin',
			'password' => 'admin',
			'authKey' => 'test100key',
			'accessToken' => '100-token',
		],
		'101' => [
			'id' => '101',
			'username' => 'demo',
			'password' => 'demo',
			'authKey' => 'test101key',
			'accessToken' => '101-token',
		],
	];

	public static function findIdentity($id) {
		if (Yii::$app->getSession()->has('user-'.$id)) {
			return new self(Yii::$app->getSession()->get('user-'.$id));
		}
		else {
			return isset(self::$users[$id]) ? new self(self::$users[$id]) : null;
		}
	}

	/**
	 * @param \nodge\eauth\ServiceBase $service
	 * @return User
	 * @throws ErrorException
	 */
	public static function findByEAuth($service) {
		if (!$service->getIsAuthenticated()) {
			throw new ErrorException('EAuth user should be authenticated before creating identity.');
		}

		$id = $service->getServiceName().'-'.$service->getId();
		$attributes = [
			'id' => $id,
			'username' => $service->getAttribute('name'),
			'authKey' => md5($id),
			'profile' => $service->getAttributes(),
		];
		$attributes['profile']['service'] = $service->getServiceName();
		$attributes['money'] = self::getUserMoney($attributes);

		Yii::$app->getSession()->set('user-'.$id, $attributes);
		return new self($attributes);
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentityByAccessToken($token, $type = null) {
		foreach (self::$users as $user) {
			if ($user['accessToken'] === $token) {
				return new static($user);
			}
		}

		return null;
	}

	/**
	 * Finds user by username
	 *
	 * @param string $username
	 * @return static|null
	 */
	public static function findByUsername($username) {
		foreach (self::$users as $user) {
			if (strcasecmp($user['username'], $username) === 0) {
				return new static($user);
			}
		}

		return null;
	}

	private static function getUserMoney($attributes) {
		return self::getUserToken($attributes)->money;
	}

	/**
	 * @param $attributes
	 * @return UserTokens
	 */
	public function getUserToken($attributes) {
		$userToken = UserTokens::findOne(['token' => $attributes['id']]);
		if (!$userToken) {
			$userToken = new UserTokens();
			$userToken->token = $attributes['id'];
			$userToken->token_index = crc32($attributes['id']);
			$userToken->money = 0;
			$userToken->name = $attributes['username'];
			$userToken->service = $attributes['profile']['service'];
			if (isset($attributes['profile']['photo_url'])) {
				$userToken->avatar = $attributes['profile']['photo_url'];
			} elseif (isset($attributes['profile']['photo_big'])) {
				$userToken->avatar = $attributes['profile']['photo_big'];
			}
			$userToken->save();
		}

		return $userToken;
	}

	/**
	 * @inheritdoc
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @inheritdoc
	 */
	public function getAuthKey() {
		return $this->authKey;
	}

	/**
	 * @inheritdoc
	 */
	public function validateAuthKey($authKey) {
		return $this->authKey === $authKey;
	}

	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword($password) {
		return $this->password === $password;
	}

	/**
	 * @param $user_id
	 * @param $money
	 * @return UserTokens
	 */
	public static function setMoney($user_id, $money) {
		$user = UserTokens::findOne(['token_index' => crc32($user_id)]);
		if ($user) {
			$user->money = $money;
			$user->save();
		}
		return $user;
	}

	/**
	 * @param $user_id
	 * @param $money
	 * @return UserTokens
	 */
	public static function addMoney($user_id, $money) {
		$user = UserTokens::findOne(['token_index' => crc32($user_id)]);
		if ($user) {
			$user->money += $money;
			$user->save();
		}
		return $user;
	}
}
