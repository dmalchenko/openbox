<?php
/**
 * Created by PhpStorm.
 * User: dmalchenko
 * Date: 02.11.17
 * Time: 20:09
 */

namespace app\models;


use yii\helpers\ArrayHelper;

class VKontakteOAuth2Service extends \nodge\eauth\services\extended\VKontakteOAuth2Service {
    protected function fetchAttributes() {
        $tokenData = $this->getAccessTokenData();
        $info = $this->makeSignedRequest('users.get.json', [
            'query' => [
                'uids' => $tokenData['params']['user_id'],
                //'fields' => '', // uid, first_name and last_name is always available
                'fields' => 'nickname, sex, bdate, city, country, timezone, photo, photo_medium, photo_big, photo_rec, photo_100, photo_200',
                'v' => self::API_VERSION,
            ],
        ]);

        $info = $info['response'][0];

        $this->attributes = $info;
        $this->attributes['id'] = $info['id'];
        $this->attributes['name'] = $info['first_name'] . ' ' . $info['last_name'];
        $this->attributes['url'] = 'http://vk.com/id' . $info['id'];

        if (!empty($info['nickname'])) {
            $this->attributes['username'] = $info['nickname'];
        } else {
            $this->attributes['username'] = 'id' . $info['id'];
        }

        $this->attributes['gender'] = $info['sex'] == 1 ? 'F' : 'M';

        if (!empty($info['timezone'])) {
            $this->attributes['timezone'] = timezone_name_from_abbr('', $info['timezone'] * 3600, date('I'));
        }

        return true;
    }

    /**
     * @param string $groupId
     * @param $user_id
     * @return mixed
     * @throws \nodge\eauth\ErrorException
     */
    public function isGroupMember($groupId, $user_id) {

        $response = $this->makeSignedRequest('groups.isMember', [
            'query' => [
                'group_id' => $groupId,
                'user_id' => $user_id,
            ],
        ]);

        if (isset($response['response']) && $response['response'] == 1) {
            return true;
        }

        return false;
    }

    /**
     * @param $groupId
     * @param $postId
     * @param $userId
     * @return mixed
     * @throws \nodge\eauth\ErrorException
     */
    public function haveRepost($groupId, $postId, $userId) {

        $response = $this->makeSignedRequest('wall.getReposts', [
            'query' => [
                'owner_id' => '-' . $groupId,
                'post_id' => $postId,
            ],
        ]);

        $data = ArrayHelper::getValue($response, 'response.profiles');
        if (!is_array($data)) {
            return false;
        }

        $data = ArrayHelper::getColumn($data, 'uid');
        if (!is_array($data)) {
            return false;
        }

        return in_array($userId, $data);
    }
}