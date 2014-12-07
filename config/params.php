<?php

return [
    'rssimport' => [
        'user' => 'SOLCITY_RSS_CRAWLER',
        'password' => '',
    ],
    'text' => [
        'gridview' => [
            'summary' => "Angezeigte Einträge: <b>{begin}</b> - <b>{end}</b> von <b>{totalCount}</b>",
        ]
    ],
    'standard' => [
        'pagination' => [
            'pageSize' => 10,
        ],
    ],
    'mail' => [
        'fromAddress' => 'solcityactivate@gmail.com',
        'fromName' => 'Solcity',
        'subject' => 'Aktivieren Sie Ihren Account bei Solcity',
        'message' => [
            'Klicken Sie auf den folgenden Link oder kopieren Sie ihn in die Adresszeile Ihres Browsers',
            'http://localhost/webprog/web/index.php?r=user/activate&user={username}&activationkey={activationkey}',
        ],
        'resetSubject' => 'Setzen Sie Ihr Password bei Solcity zurück',
        'resetMessage' => [
            'Klicken Sie auf den folgenden Link oder kopieren Sie ihn in die Adresszeile Ihres Browsers',
            'http://localhost/webprog/web/index.php?r=user/reset&user={username}&passwordResetKey={passwordResetKey}',
        ],
    ],
    'resources' => [
        'path' => [
            'temp-upload' => 'temp_upload/',
            'article-header-images' => 'images/upload/articles/',
            'user-avatar-images' => 'images/upload/avatars/',
        ],
        'default' => [
            'user' => [
                'avatar' => 'images/upload/avatars/0.jpg',
            ],
            'article' => [
                'teaser_image' => 'images/upload/articles/0/teaser.jpg',
            ],
        ],
    ],
    'article' => [
        'teaserImage' => [
            'aspectRatio' => '4',
        ],
    ],
    'user' => [
        'avatarImage' => [
            'aspectRatio' => '1',
        ],
    ],
];
