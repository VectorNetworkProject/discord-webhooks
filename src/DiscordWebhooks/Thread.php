<?php
/**
 * Created by PhpStorm.
 * User: InkoHX
 * Date: 2018/12/17
 * Time: 14:08
 */

namespace DiscordWebhooks;


class Thread extends \Thread
{
    /** @var string $url */
    private $url;
    /** @var string $json */
    private $json;

    /**
     * Thread constructor.
     * @param string $url
     * @param string $json
     */
    public function __construct(string $url, string $json)
    {
        $this->url = $url;
        $this->json = $json;
    }

    /**
     * @throws \Exception
     */
    public function run()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->json);

        $result = curl_exec($ch);
        if ($errno = curl_errno($ch)) {
            $error_message = curl_strerror($errno);
            throw new \Exception("cURL error ({$errno}):\n {$error_message}");
        }

        if (($httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE)) != 204) {
            throw new \Exception($httpcode . ':' . $result);
        }

        curl_close($ch);
    }
}