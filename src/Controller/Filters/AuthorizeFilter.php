<?php

/**
 * @author      Mohammed Moussaoui
 * @copyright   Copyright (c) Mohammed Moussaoui. All rights reserved.
 * @license     MIT License. For full license information see LICENSE file in the project root.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Core\Controller\Filters;

use DevNet\Core\Controller\IActionFilter;
use DevNet\Core\Controller\ActionContext;
use DevNet\Core\Controller\ActionExecutionDelegate;
use DevNet\Core\Security\Authentication\AuthenticationDefaults;
use DevNet\System\Async\Task;

class AuthorizeFilter implements IActionFilter
{
    private array $Options;

    public function __construct(array $options = [])
    {
        $this->Options = $options;
    }

    public function onActionExecution(ActionContext $context, ActionExecutionDelegate $next): Task
    {
        $httpContext   = $context->HttpContext;
        $authorization = $context->HttpContext->Authorization;

        if ($authorization) {
            $user   = $httpContext->User;
            $policy = $this->Options['Policy'] ?? 'Authentication';
            $result = $authorization->Authorize($policy, $user);

            if (!$result->isSucceeded()) {
                if ($policy == 'Authentication') {
                    $authentication = $httpContext->getAttribute('Authentication');
                    $loginPath      = "/account/login";

                    if ($authentication) {
                        $handler   = $authentication->Handlers[AuthenticationDefaults::AuthenticationScheme] ?? null;
                        $loginPath = $handler->Options->LoginPath;
                    }

                    $httpContext->Response->redirect($loginPath);
                } else {
                    $httpContext->Response->setStatusCode(403);
                }

                return Task::completedTask();
            }
        }

        return $next($context);
    }
}
