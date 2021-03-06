<?php

/**
 * @author      Mohammed Moussaoui
 * @copyright   Copyright (c) Mohammed Moussaoui. All rights reserved.
 * @license     MIT License. For full license information see LICENSE file in the project root.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Core\Http;

use DevNet\System\IO\Stream;

class Response extends HttpMessage
{
    private int $StatusCode;
    private string $ReasonPhrase;
    private array $Messages = [
        // Informational 1xx
        100 => "Continue",
        101 => "Switching Protocols",
        102 => "Processing",
        103 => "Early Hints",

        // Successful 2xx
        200 => "OK",
        201 => "Created",
        202 => "Accepted",
        203 => "Non-Authoritative Information",
        204 => "No Content",
        205 => "Reset Content",
        206 => "Partial Content",
        207 => "Multi-Status",
        208 => "Already Reported",
        210 => "Content Different",
        226 => "IM Used",

        // Redirection 3xx
        300 => "Multiple Choices",
        301 => "Moved Permanently",
        302 => "Found",
        303 => "See Other",
        304 => "Not Modified",
        305 => "Use Proxy",
        306 => "(Unused)",
        307 => "Temporary Redirect",
        308 => "Permanent Redirect",
        310 => "Too many Redirects",

        // Client Error 4xx
        400 => "Bad Request",
        401 => "Unauthorized",
        402 => "Payment Required",
        403 => "Forbidden",
        404 => "Not Found",
        405 => "Method Not Allowed",
        406 => "Not Acceptable",
        407 => "Proxy Authentication Required",
        408 => "Request Timeout",
        409 => "Conflict",
        410 => "Gone",
        411 => "Length Required",
        412 => "Precondition Failed",
        413 => "Request Entity Too Large",
        414 => "Request-URI Too Long",
        415 => "Unsupported Media Type",
        416 => "Requested Range Not Satisfiable",
        417 => "Expectation Failed",
        418 => "I'm a teapot",
        421 => "Misdirected Request",
        422 => "Unprocessable Entity",
        423 => "Locked",
        424 => "Failed Dependency",
        426 => "Upgrade Required",
        428 => "Precondition Required",
        429 => "Too Many Requests",
        431 => "Request Header Fields Too Large",
        451 => "Unavailable For Legal Reasons",

        // Server Error 5xx
        500 => "Internal Server Error",
        501 => "Not Implemented",
        502 => "Bad Gateway",
        503 => "Service Unavailable",
        504 => "Gateway Timeout",
        505 => "HTTP Version Not Supported",
        506 => "Variant Also Negotiates",
        507 => "Insufficient Storage",
        508 => "Loop Detected",
        510 => "Not Extended",
        511 => "Network Authentication Required",
    ];

    public function __construct(
        Headers $headers = null,
        Cookies $cookies = null,
        Stream $body = null
    ) {
        if (!$headers) {
            $headers = new Headers();
        }

        if (!$cookies) {
            $cookies = new Cookies($headers);
        }

        if (!$body) {
            $body = new Stream('php://temp', 'r+');
        }

        $this->Headers      = $headers;
        $this->Cookies      = $cookies;
        $this->Body         = $body;
        $this->StatusCode   = 200;
        $this->ReasonPhrase = 'OK';
        $this->setProtocol();
    }

    public function __get(string $name)
    {
        return $this->$name;
    }

    public function setStatusCode(int $statusCode, string $reasonPhrase = null)
    {
        if (!$reasonPhrase) {
            if (isset($this->Messages[$statusCode])) {
                $reasonPhrase = $this->Messages[$statusCode];
            }
        }

        $this->StatusCode = $statusCode;
        $this->ReasonPhrase = $reasonPhrase;
    }

    public function getStatusLine(): string
    {
        return "{$this->Protocol} {$this->StatusCode} {$this->ReasonPhrase}";
    }

    public function redirect(string $path)
    {
        $this->Headers->add('Location', $path);
    }
}
