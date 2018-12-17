<?php

namespace Discord\Webhooks;

/**
 * Embed is an embed object to be included in a webhook message
 */
class Embed
{
    protected $title;
    protected $type = "rich";
    protected $description;
    protected $url;
    protected $timestamp;
    protected $color;
    protected $footer;
    protected $image;
    protected $thumbnail;
    protected $video;
    protected $provider;
    protected $author;
    protected $fields;

    /**
     * @param string $title
     * @param string $url
     * @return Embed
     */
    public function setTitle(string $title, string $url = ''): self
    {
        $this->title = $title;
        $this->url = $url;

        return $this;
    }

    /**
     * @param string $description
     * @return Embed
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param $timestamp
     * @return Embed
     */
    public function setTimestamp($timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * @param int|string $color
     * @return Embed
     */
    public function setColor($color): self
    {
        $this->color = is_int($color) ? $color : hexdec($color);

        return $this;
    }

    /**
     * @param string $url
     * @return Embed
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param $text
     * @param string $icon_url
     * @return $this
     */
    public function setFooter(string $text, string $icon_url = ''): self
    {
        $this->footer = [
            'text' => $text,
            'icon_url' => $icon_url,
        ];
        return $this;
    }

    /**
     * @param string $url
     * @return Embed
     */
    public function setImage(string $url): self
    {
        $this->image = [
            'url' => $url,
        ];
        return $this;
    }

    /**
     * @param string $url
     * @return Embed
     */
    public function setThumbnail(string $url): self
    {
        $this->thumbnail = [
            'url' => $url,
        ];
        return $this;
    }

    /**
     * @param string $name
     * @param string $url
     * @param string $icon_url
     * @return Embed
     */
    public function setAuthor(string $name, string $url = '', string $icon_url = ''): self
    {
        $this->author = [
            'name' => $name,
            'url' => $url,
            'icon_url' => $icon_url,
        ];
        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     * @param bool $inline
     * @return $this
     */
    public function addField(string $name, string $value, bool $inline = false): self
    {
        $this->fields[] = [
            'name' => $name,
            'value' => $value,
            'inline' => boolval($inline),
        ];
        return $this;
    }

    public function toArray()
    {
        return [
            'title' => $this->title,
            'type' => $this->type,
            'description' => $this->description,
            'url' => $this->url,
            'color' => $this->color,
            'footer' => $this->footer,
            'image' => $this->image,
            'thumbnail' => $this->thumbnail,
            'timestamp' => $this->timestamp,
            'author' => $this->author,
            'fields' => $this->fields,
        ];
    }
}
