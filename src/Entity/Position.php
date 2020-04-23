<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\LookupInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/*
 * @ORM\Table(
 *     name="ublPosition"
 * )
 *
 * @ORM\Entity(readOnly=true)
 *
 * @UniqueEntity(fields={"handle"})
 *
 * @ORM\HasLifecycleCallbacks()
 */
class Position
{
    public const POINT_GUARD = 'POINT_GUARD';
    public const SHOOTING_GUARD = 'SHOOTING_GUARD';
    public const SMALL_FORWARD = 'SMALL_FORWARD';
    public const POWER_FORWARD = 'POWER_FORWARD';
    public const CENTER = 'CENTER';
    public const SIXTH_MAN = 'SIXTH_MAN';
    public const SEVENTH_MAN = 'SEVENTH_MAN';
    public const EIGHTH_MAN = 'EIGHTH_MAN';
    public const NINTH_MAN = 'NINTH_MAN';
    public const TENTH_MAN = 'TENTH_MAN';
    public const ELEVENTH_MAN = 'ELEVENTH_MAN';
    public const TWELFTH_MAN = 'TWELFTH_MAN';
}