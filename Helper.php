<?php
class Helper {
    public static function sendFiles($url, $files)
    {
        if ($curl = curl_init()) {
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type:multipart/form-data'
            ]);
            curl_setopt($curl, CURLOPT_POSTFIELDS, self::buildArray($files));
            $out = curl_exec($curl);
            $rs = json_decode($out);
            curl_close($curl);
            return $rs;
        }
        return false;
    }
    private static function buildArray($files)
    {
        $result = [];
        foreach ($files as $index => $value) {
            $result['file'.($index+1)] = new \CURLFile($value);
        }
        return $result;
    }
}