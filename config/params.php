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
    ]
];
