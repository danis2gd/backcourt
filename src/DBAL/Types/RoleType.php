<?php
namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class RoleType extends AbstractEnumType
{
    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';

    protected static $choices = [
        self::ROLE_USER => 'ROLE_USER',
        self::ROLE_ADMIN => 'ROLE_ADMIN',
    ];
}