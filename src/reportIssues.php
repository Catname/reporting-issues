<?php
/**
 * @author: ZhangHQ
 * @email : tomcath@foxmail.com
 */

namespace Catname\ReportingIssues;



class reportIssues
{
    /**
     * 上报工单
     * @param string $message
     * @param array $data
     * @return string
     * @author: ZhangHQ
     * @email : tomcath@foxmail.com
     */
    public static function report(string $message, array $data)
    {
        $content = $message . ' ；相关错误信息：[' . json_encode($data) . ']';
        $url = config('reportissue.report_host') . 'api/admin/reports';
        $accessToken = authorizations::getAccessToken();

        $signHandler = new SignHandler();
        $timeStamp = now()->getTimestamp();

        $contentData = [
            'issue_content' => $content,
            'test_mode' => config('reportissue.test_mode'),
            //'media' => $data['media'], // Json
        ];

        try {
            $response = \Http::withToken($accessToken)->withHeaders([
                'sign' => $signHandler->getASign('POST', $timeStamp, $contentData),
                'timestamp' => $timeStamp,
            ])->post($url, $contentData);
        } catch (\Exception $e) {
            // TODO 错误处理
            return $e->getMessage();
        }

        return $response->body();
    }
}