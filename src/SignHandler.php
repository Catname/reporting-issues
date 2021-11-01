<?php
/**
 * @author: ZhangHQ
 * @email : tomcath@foxmail.com
 */

namespace Catname\ReportingIssues;


class SignHandler
{
    public function getASign($request_method, $timestamp, $data)
    {
        try {
            if (empty($timestamp)) {
                throw new \Exception('timestamp不能为空');
            }
            #服务端生成签名
            $data['timestamp'] = $timestamp;
            $data['request_method'] = $request_method;
            $php_sign = self::getSign($data);
            return $php_sign;
        } catch (\Exception $e) {
            $this->returnJson($e->getMessage());
        }
    }

    private function getSign($data)
    {

        $str = self::toBeSignedStr($data);
        #利用待签名字符串生成签名
        return strtoupper(MD5($str));
    }

    /*
     *生成待签名字符串
     */
    private function toBeSignedStr($data)
    {
        $str = self::formatBizQueryParaMap($data, true);
        #得到待签名字符串
        $str = $str . "&key=nice123456@@";
        return $str;
    }

    /**
     * 排序数组和对参数名及参数值进行URL编码
     */
    private function formatBizQueryParaMap($param, $bool)
    {
        $buff = '';
        ksort($param);
        if (isset($param['longitude'])) {
            unset($param['longitude']);
        }
        if (isset($param['latitude'])) {
            unset($param['latitude']);
        }
        foreach ($param as $k => $v) {
            $buff .= $k . '=' . $v . '&';
        }

        $reqPar = '';
        if (strlen($buff) > 0) {
            $reqPar = substr($buff, 0, strlen($buff) - 1);
        }
        if ($bool) {
            $reqPar = urlencode(md5($reqPar));
        }
        return $reqPar;
    }

    private function returnJson($message)
    {
        echo json_encode(['code' => 407, 'message' => 'error', 'errors' => ['tips' => $message]]);
        die;
    }

}