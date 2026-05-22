<?php

namespace Lume\Http;

/**
 * Repuesta del cliente
 */
class Response
{
    /**
     * Summary of status
     * @var int
     */
    protected int $status = 200;
    /**
     * Summary of headers
     * @var array<string, string>
     */
    protected array $headers = [];
    /**
     * Summary of content
     * @var string|null
     */
    protected ?string $content = null;



    /**
     * Get the value of status
     */
    public function status()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of headers
     */
    public function headers(): array
    {
        return $this->headers;
    }

    /**
     * Set the value of headers
     *
     * @return  self
     */
    public function setHeader(string $header, string $value): self
    {
        $this->headers[strtolower($header)] = $value;

        return $this;
    }

    /**
     * Set the value of headers
     *
     * @return  self
     */
    public function removeHeader(string $header): self
    {
        unset($this->headers[strtolower($header)]);

        return $this;
    }
    /**
     * Summary of content
     * @return string|null
     */
    public function content(): ?string
    {
        return $this->content;
    }
    /**
     * Summary of setContent
     * @param string $content
     * @return Response
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }
    /**
     * Summary of setContentType
     * @param string $value
     * @return Response
     */
    public function setContentType(string $value): self
    {
        $this->setHeader("Content-Type", $value);
        return $this;
    }
    /**
     * Summary of prepare
     * @return void
     */
    public function prepare()
    {
        if (is_null($this->content)) {
            $this->removeHeader("Content-Type");
            $this->removeHeader("Content-Length");
        } else {
            $this->setHeader("Content-Length", strlen($this->content));
        }
    }
    /**
     * Summary of json
     * @param array $data
     * @return Response
     */
    public static function json(array $data)
    {
        return (new self())
            ->setContentType("application/json")
            ->setContent(json_encode($data));
    }

    /**
     * Summary of text
     * @param string $texto
     * @return Response
     */
    public static function text(string $texto)
    {
        return (new self())
            ->setContentType("text/plain")
            ->setContent($texto);
    }

    /**
     * Summary of redirect
     * @param string $uri
     * @return Response
     */
    public static function redirect(string $uri): self
    {
        return (new self())
            ->setStatus(302)
            ->setHeader("Location", $uri);
    }
}
