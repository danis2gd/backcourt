<?php
namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class RoleType extends AbstractEnumType
{
    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_COMMISSIONER = 'ROLE_COMMISSIONER';

    protected static $choices = [
        self::ROLE_USER => 'ROLE_USER',
        self::ROLE_ADMIN => 'ROLE_ADMIN',
        self::ROLE_COMMISSIONER => 'ROLE_COMMISSIONER',
    ];
}