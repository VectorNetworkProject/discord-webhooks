<?php

namespace Discord\Webhooks;

/**
 * Client generates the payload and sends the webhook payload to Discord
 */
class Client
{
    protected $url;
    protected $username;
    protected $avatar;
    protected $message;
    protected $embeds;
    protected $tts;

    /**
     * Client constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @param bool $tts
     * @return Client
     */
    public function setTTS(bool $tts = false): self
    {
        $this->tts = $tts;
        return $this;
    }

    /**
     * @param string $username
     * @return Client
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param string $new_avatar
     * @return Client
     */
    public function setAvatar(string $new_avatar): self
    {
        $this->avatar = $new_avatar;
        return $this;
    }

    /**
     * @param string $new_message
     * @return Client
     */
    public function setMessage(string $new_message): self
    {
        $this->message = $new_message;
        return $this;
    }

    /**
     * @param Embed $embed
     * @return $this
     */
    public function setEmbed(Embed $embed): self
    {
        $this->embeds[] = $embed->toArray();
        return $this;
    }

    public function sendContent(): void
    {
        $payload = json_encode(array(
            'username' => $this->username,
            'avatar_url' => $this->avatar,
            'content' => $this->message,
            'embeds' => $this->embeds,
            'tts' => $this->tts,
        ));
        $thread = new Thread($this->url, $payload);
        $thread->start();
    }
}
