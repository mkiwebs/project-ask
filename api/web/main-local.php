<?php
return [
    'timeZone' => 'Africa/Nairobi',
    'components' => [
        'formatter' => [
            'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => ' KES',
       ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=db_lyfey_v1',
            'username' => 'ovicko_admin',
            'password' => '2103@Theadmin',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
              'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'n1plcpnl0035.prod.ams1.secureserver.net',
                'username' => 'noreply@homestra.com',
                'password' => '@thenoreplyhomestra2016',
                'port' => '587',
                'encryption' => 'tls',
                            ],
                            // 'transport' => [
                            //   'class' => 'Swift_SmtpTransport',
                            //   'host' => 'smtp-mail.outlook.com',
                            //   'username' => 'amwollo@hotmail.com',
                            //   'password' => 'mydob1994',
                            //   'port' => '587',
                            //   'encryption' => 'tls',
                            //               ],
        ],
    ],
];
