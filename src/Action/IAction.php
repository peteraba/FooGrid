<?php

declare(strict_types = 1);

namespace Foo\Grid\Action;

use Foo\Grid\Component\IComponent;
use Opulence\Orm\IEntity;

interface IAction extends IComponent
{
    public function setEntity(IEntity $entity);

    public function duplicate(): IAction;
}
