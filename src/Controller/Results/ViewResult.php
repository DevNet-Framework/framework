<?php

/**
 * @author      Mohammed Moussaoui
 * @copyright   Copyright (c) Mohammed Moussaoui. All rights reserved.
 * @license     MIT License. For full license information see LICENSE file in the project root.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Core\Controller\Results;

use DevNet\Core\Controller\ActionContext;

class ViewResult extends ActionResult
{
    protected string $Content;
    protected int $StatusCode;

    public function __construct(string $content, int $statusCode = 200)
    {
        $this->Content = $content;
        $this->StatusCode = $statusCode;
    }

    public function execute(ActionContext $actionContext): void
    {
        $httpContext = $actionContext->HttpContext;
        $httpContext->Response->Headers->add("Content-Type", "text/html");
        $httpContext->Response->Body->write($this->Content);
        $httpContext->Response->setStatusCode($this->StatusCode);
    }
}
