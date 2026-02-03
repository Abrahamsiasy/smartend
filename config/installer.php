<?php
$SERVER_NAME = (@$_SERVER['SERVER_NAME'] != "") ? @$_SERVER['SERVER_NAME'] : "localhost";
if (!checkdnsrr($SERVER_NAME, 'NS')) {
    $permissions = [
        'storage/framework/' => '',
        'storage/logs/' => '',
        'storage/app/' => '',
        'storage/app/public/' => '',
        'bootstrap/cache/' => '',
    ];
} else {
    $permissions = [
        'storage/framework/' => '755',
        'storage/logs/' => '755',
        'storage/app/' => '755',
        'storage/app/public/' => '755',
        'storage/app/public/uploads/' => '755',
        'bootstrap/cache/' => '755',
    ];
}

return [

    /*
    |--------------------------------------------------------------------------
    | Server Requirements
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel server requirements, you can add as many
    | as your application require, we check if the extension is enabled
    | by looping through the array and run "extension_loaded" on it.
    |
    */
    'core' => [
        'minPhpVersion' => '8.1.2',
    ],

    'requirements' => [
        'openssl',
        'pdo',
        'mbstring',
        'tokenizer',
        'JSON',
        'cURL',
        'bcmath',
        'ctype',
        'xml',
        'fileinfo',
    ],

    /*
    |--------------------------------------------------------------------------
    | Folders Permissions
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel folders permissions, if your application
    | requires more permissions just add them to the array list bellow.
    |
    */
    'permissions' => $permissions
];
