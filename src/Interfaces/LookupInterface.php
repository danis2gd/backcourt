<?php
declare(strict_types=1);

namespace App\Interfaces;

interface LookupInterface {
    public function getHandle(): string;
}