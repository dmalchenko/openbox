<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'J1izyWe8zZQ_CZEMWkEUeGA0Cbzc4JL4',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
				'/admin/<rule:.*>' => '/opencase/<rule>',
				'<action>' => 'site/<action>',
            	'<action>/<id>' => 'site/<action>/<id>',
            	'<controller>/<action>/<id>' => '<controller>/<action>/<id>',
            ],
        ],
		'i18n' => [
			'translations' => [
				'eauth' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@eauth/messages',
				],
			],
		],
		'eauth' => [
			'class' => 'nodge\eauth\EAuth',
			'popup' => true, // Use the popup window instead of redirecting.
			'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache' on production environments.
			'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
			'httpClient' => [
				// uncomment this to use streams in safe_mode
				//'useStreamsFallback' => true,
			],
			'services' => [ // You can change the providers and their classes.
				'facebook' => [
					// register your app here: https://developers.facebook.com/apps/
					'class' => 'nodge\eauth\services\extended\FacebookOAuth2Service',
					'clientId' => '119154928777377',
					'clientSecret' => '445967cd1a21ee3bbe8a4bee71e70e58',
				],
				'vkontakte' => [
					// register your app here: https://vk.com/editapp?act=create&site=1
					'class' => 'app\models\VKontakteOAuth2Service',
					'clientId' => '6212174',
					'clientSecret' => 'BTwwa8XUUbB0GcK6hbVd',
				],
				'odnoklassniki' => [
					// register your app here: http://dev.odnoklassniki.ru/wiki/pages/viewpage.action?pageId=13992188
					// ... or here: http://www.odnoklassniki.ru/dk?st.cmd=appsInfoMyDevList&st._aid=Apps_Info_MyDev
					'class' => 'app\models\OdnoklassnikiOAuth2Service',
					'clientId' => '1256372992',
					'clientSecret' => '604897FC9A639389E116520A',
					'clientPublic' => 'CBAMLDOLEBABABABA',
					'title' => 'Odnoklas.',
				],
			],
		],
	],
	'modules' => [
		'freekassa' => [
			'class' => 'app\modules\freekassa\Module',
		],
		'opencase' => [
			'class' => 'app\modules\opencase\Module',
		],

	],
	'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];
}

return $config;
