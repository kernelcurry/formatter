<?php namespace KernelCurry;

/**
 * Light weight formatter for a number of value types.
 *
 * @package  Formatter
 * @author   Michael Curry <kernelcurry@gmail.com>
 */

class Formatter {

	/**
	 * Types that are allowed for the formatter
	 *
	 * @param array $types
	 */
	protected $types = [
		'integer',
		'float',
		'decimal',
		'time',
		'currency',
		'percent'
	];

	/**
	 * If you want the returned values to be pretty
	 * set this to true.
	 *
	 * @var bool $pretty
	 */
	protected $pretty = true;

	/**
	 * If you want numbers to be return in an abbreviated
	 * format, set this to true
	 *
	 * @var bool $pretty
	 */
	protected $abbrv = false;

	/**
	 * Formats a single data point given the type
	 *
	 * @param  mixed  $value
	 * @param  string $type
	 * @return mixed
	 */
	public function value($value, $type)
	{
		// Check if the data type is defined
		if ($this->typeCheck($type))
		{
			return $this->{$type}($value);
		}
		else
		{
			return $value;
		}
	}

	/**
	 * Determine if the formatter will return pretty values
	 *
	 * @return boolean
	 */
	public function isPretty()
	{
		return $this->pretty;
	}

	/**
	 * Set the pretty property of the function.
	 * true = pretty formatting enabled
	 *
	 * @param boolean $pretty
	 */
	public function setPretty($pretty)
	{
		$this->pretty = $pretty;
	}

	/**
	 * Determine if the formatter will return abbreviated values
	 *
	 * @return boolean
	 */
	public function isAbbrv()
	{
		return $this->abbrv;
	}

	/**
	 * Set the abbrv property of the function.
	 * true = abbreviated format enabled
	 *
	 * @param boolean $abbrv
	 */
	public function setAbbrv($abbrv)
	{
		$this->abbrv = $abbrv;
	}

	/**
	 * Format the value as an integer.
	 *
	 * @param  mixed $value
	 * @return integer
	 */
	protected function integer($value)
	{
		if ($this->pretty)
		{
			if ($this->abbrv)
			{
				return $this->abbreviateNumber($value);
			}

			return number_format($value);
		}

		return intval($value);
	}

	/**
	 * Format the value as a float.
	 *
	 * @param  mixed $value
	 * @return float
	 */
	protected function float($value)
	{
		if ($this->pretty)
		{
			if ($this->abbrv)
			{
				return $this->abbreviateNumber($value);
			}

			return number_format($value);
		}

		return floatval($value);
	}

	/**
	 * Format the value as a decimal.
	 *
	 * @param  mixed $value
	 * @return float
	 */
	protected function decimal($value)
	{
		if ($this->pretty)
		{
			if ($this->abbrv)
			{
				return $this->abbreviateNumber($value);
			}

			return floatval(number_format($value, 2, '.', ''));
		}

		return floatval(round($value, 2));
	}

	/**
	 * Format the value as a time value.
	 *
	 * @param  mixed $value
	 * @return float
	 */
	protected function time($value)
	{
		if ($this->pretty)
		{
			// Minutes and seconds should have leading zeroes
			$hours = str_pad(floor($value / 3600), 2, '0', STR_PAD_LEFT);
			$mins = str_pad(floor(($value - ($hours * 3600)) / 60), 2, '0', STR_PAD_LEFT);
			$secs = str_pad(floor($value % 60), 2, '0', STR_PAD_LEFT);

			// If there are no hours, remove the first zero and colon
			return implode(':', [$hours, $mins, $secs]);
		}

		return floatval(round($value, 2));
	}

	/**
	 * Format the value as currency.
	 *
	 * @param  mixed $value
	 * @return mixed
	 */
	protected function currency($value)
	{
		if ($this->pretty)
		{
			if ($this->abbrv)
			{
				return $this->abbreviateNumber($value, '$');
			}

			return '$' . number_format($value, 2);
		}

		return floatval(round($value, 2));
	}

	/**
	 * Format the value as a percent.
	 *
	 * @param  mixed $value
	 * @return mixed
	 */
	protected function percent($value)
	{
		if ($this->pretty)
		{
			if ($this->abbrv)
			{
				return $this->abbreviateNumber($value * 100, '', '%');
			}

			return number_format($value * 100, 2) . '%';
		}

		return floatval(round($value, 4));
	}

	protected function typeCheck($type)
	{
		return in_array($type, $this->types) && method_exists($this, $type);
	}

	/**
	 * Abbreviate any given number.  This function automatically rounds the given value.
	 *
	 * @param $value
	 * @param string $prefix
	 * @param string $suffix
	 * @return string
	 */
	protected function abbreviateNumber($value, $prefix = '', $suffix = '')
	{
		if ($value < 0)
		{
			return '-'.$prefix.abbreviateNumber(abs($value)).$suffix;
		}

		$value = round($value);
		if ($value < 10000)
		{
			return $prefix.$value.$suffix;
		}

		$places = 0;
		if ($value >= 1000000)
		{
			$places = 2;
		}

		$abbreviations = array(12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => '');

		foreach($abbreviations as $exponent => $abbreviation)
		{
			if ($value >= pow(10, $exponent))
			{
				return $prefix.round(floatval($value / pow(10, $exponent)), $places).$abbreviation.$suffix;
			}
		}
	}

}