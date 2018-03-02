<?php
declare(strict_types=1);

namespace SystemCtl\Scope;

/**
 * UserScope
 *
 * @package SystemCtl\Scope
 * @author  icanhazstring <blubb0r05+github@gmail.com>
 */
class UserScope implements ScopeInterface
{
    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return '--user';
    }
}