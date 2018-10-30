<?php

return [
    'driver' =>'smtp',
    'host' => 'smtp.gmail.com',
    'port' => 587,
    'from' => [
        'address' =>'fatecpgmentoring@gmail.com',
        'name' => 'Equipe Mentoring',
    ],
    
    'encryption' => 'tls',
    'username' => 'fatecpgmentoring@gmail.com',
    'password' => 'Mentoring123',
    'sendmail' => '/usr/sbin/sendmail -bs',

    /*
    |--------------------------------------------------------------------------
    | Markdown Mail Settings
    |--------------------------------------------------------------------------
    |
    | If you are using Markdown based email rendering, you may configure your
    | theme and component paths here, allowing you to customize the design
    | of the emails. Or, you may simply stick with the Laravel defaults!
    |
    */

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

];
