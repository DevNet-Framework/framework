<?php

/**
 * @author      Mohammed Moussaoui
 * @copyright   Copyright (c) Mohammed Moussaoui. All rights reserved.
 * @license     MIT License. For full license information see LICENSE file in the project root.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Core\Dispatcher;

use DevNet\Core\Http\HttpContext;
use DevNet\System\Event\Delegate;
use DevNet\System\Async\Task;

class RequestDelegate extends Delegate
{
    /** RequestDelegate signature */
    public function delegate(HttpContext $context): Task
    {
    }
}
