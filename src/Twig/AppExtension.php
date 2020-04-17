<?php
declare(strict_types=1);

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    private const MILLION = 1000000;

    /**
     * @return array|TwigFilter[]
     */
    public function getFilters()
    {
        return [
            new TwigFilter('salary', [$this, 'formatSalary']),
        ];
    }

    /**
     * @param float $number
     * @param string $currency
     *
     * @return string
     */
    public function formatSalary(float $number, string $currency = 'USD')
    {
        return '$' . round($number / self::MILLION, 2) . 'M';
    }
}