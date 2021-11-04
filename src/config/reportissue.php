<?php
/**
 * @author: ZhangHQ
 * @email : tomcath@foxmail.com
 */

return [
    'report_host' => env('REPORT_HOST', 'http://issue.test/'),
    'client_id' => env('REPORT_ID'),
    'client_secret' => env('REPORT_SECRET'),
    'sign_salt' => env('REPORT_SIGN_SALT'),
];