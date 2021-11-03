<?php
/**
 * @author: ZhangHQ
 * @email : tomcath@foxmail.com
 */

namespace Catname\ReportingIssues;


use Illuminate\Support\Facades\Http;


class authorizations
{
    protected static $cacheKey =  'Issue_AccessToken';

    public static function getAccessToken()
    {
        // 首先判断缓存中还有没有 有效的 token
        $accessToken = \Cache::get(self::$cacheKey);
        if (!$accessToken) {
            // 没有则重新获取新的 token
            $accessToken = self::login();
        }

        // 返回有效 token
        return $accessToken;
    }

    public static function login()
    {
        $url = config('reportissue.report_host') . 'api/admin/projects/authorizations';
        $loginInfo = [
            'client_id' => config('reportissue.client_id'),
            'client_secret' => config('reportissue.client_secret')
        ];
        //\Log::channel('errors')->info('登录方法中的loginInfo', $loginInfo);  //debug
        $signHandler = new SignHandler();
        $timeStamp = now()->getTimestamp();

        $response = Http::withHeaders([
            'sign' => $signHandler->getASign('POST', $timeStamp, $loginInfo),
            'timestamp' => $timeStamp,
        ])->asForm()->post($url, $loginInfo);

        if ($response['code'] == 201) {
            // 登录成功
            // 存缓存
            \Cache::put(self::$cacheKey, $response['access_token'], $response['expires_in']);

            return $response['access_token'];
        }
        \Log::warning('登录工单系统失败:'.$response->body());
        return false;
    }

    public static function refresh()
    {
        // TODO 可能不会用
        // 旧换新 token
    }

    public static function logout()
    {
        // 主动注销 token
    }
}