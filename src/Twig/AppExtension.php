<?php
/**
 * Created by PhpStorm.
 * User: Sony
 * Date: 13/02/2019
 * Time: 22:30
 */

namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
	public function getFilters()
	{
		return [
			new TwigFilter('price', [$this, 'priceFilter'])
		];
	}
	public function priceFilter($number)
	{
		return'$'.number_format($number, 2, '.', ',');
	}

}