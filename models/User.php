<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\modules\freekassa\models\Freekassable;
use ErrorException;


/**
 * This is the model class for table "user_tokens".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $service
 * @property string $avatar
 * @property string $token
 * @property integer $token_index
 * @property integer $money
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends ActiveRecord implements IdentityInterface, Freekassable {
	public $username;
	public $password;
	public $authKey;
	public $accessToken;
	/**
	 * @var array EAuth attributes
	 */
	public $profile;


	public function behaviors() {
		return [
			TimestampBehavior::className(),
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'user';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['user_id', 'token_index', 'money', 'created_at', 'updated_at'], 'integer'],
			[['name', 'token', 'service', 'avatar'], 'string', 'max' => 255],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'user_id' => 'User ID',
			'name' => 'Name',
			'service' => 'Service',
			'avatar' => 'Avatar',
			'token' => 'Token',
			'token_index' => 'Token Index',
			'money' => 'Money',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

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
	 * @return User
	 */
	public function getUserToken($attributes) {
		$userToken = self::findOne(['token' => $attributes['id']]);
		if (!$userToken) {
			$userToken = new self();
			$userToken->token = $attributes['id'];
			$userToken->token_index = crc32($attributes['id']);
			$userToken->money = 0;
			$userToken->name = $attributes['username'];
			$userToken->service = $attributes['profile']['service'];
			if (isset($attributes['profile']['photo_url'])) {
				$userToken->avatar = $attributes['profile']['photo_url'];
			} elseif (isset($attributes['profile']['photo_200'])) {
				$userToken->avatar = $attributes['profile']['photo_200'];
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
	 * @return User
	 */
	public static function setMoney($user_id, $money) {
		$user = User::findOne(['token_index' => crc32($user_id)]);
		if ($user) {
			$user->money = $money;
			$user->save();
		}
		return $user;
	}

	/**
	 * @param $user_id
	 * @param $money
	 * @return User
	 */
	public static function addMoney($user_id, $money) {
		$user = User::findOne(['token_index' => $user_id]);
		if ($user) {
			$user->money += $money;
			$user->save();
		}
		return $user;
	}

	/**
	 * @return string
	 */
	public function getAvatar() {
		return $this->avatar;
	}

	/**
	 * @return null|static
	 */
	public static function getCurrentUser() {
		if ($identity = Yii::$app->getUser()->getIdentity()) {
			$id = $identity->getId();
			$user = self::findOne(['token' => $id]);
		} else {
			$user = null;
		}
		return $user;
	}
}
