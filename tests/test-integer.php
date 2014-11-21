<?php

	use KernelCurry\Formatter;

	class IntegerTest extends PHPUnit_Framework_TestCase{

		/**
		 * Variables to be used
		 *
		 * @var array $test_array
		 */
		protected $test_array = [
			'zero_1' => [
				'value'  => 0,
				'pretty' => false,
				'abbrv'  => false,
				'result' => 0
			],
			'zero_2' => [
				'value'  => 0,
				'pretty' => true,
				'abbrv'  => false,
				'result' => '0'
			],
			'zero_3' => [
				'value'  => 0,
				'pretty' => false,
				'abbrv'  => true,
				'result' => 0
			],
			'zero_4' => [
				'value'  => 0,
				'pretty' => true,
				'abbrv'  => true,
				'result' => '0'
			],
			'one_1' => [
				'value'  => 1,
				'pretty' => false,
				'abbrv'  => false,
				'result' => 1
			],
			'one_2' => [
				'value'  => 1,
				'pretty' => true,
				'abbrv'  => false,
				'result' => '1'
			],
			'one_3' => [
				'value'  => 1,
				'pretty' => false,
				'abbrv'  => true,
				'result' => 1
			],
			'one_4' => [
				'value'  => 1,
				'pretty' => true,
				'abbrv'  => true,
				'result' => '1'
			],
			'hundred_1' => [
				'value'  => 100,
				'pretty' => false,
				'abbrv'  => false,
				'result' => 100
			],
			'hundred_2' => [
				'value'  => 100,
				'pretty' => true,
				'abbrv'  => false,
				'result' => '100'
			],
			'hundred_3' => [
				'value'  => 100,
				'pretty' => false,
				'abbrv'  => true,
				'result' => 100
			],
			'hundred_4' => [
				'value'  => 100,
				'pretty' => true,
				'abbrv'  => true,
				'result' => '100'
			],
			'thousand_1' => [
				'value'  => 1000,
				'pretty' => false,
				'abbrv'  => false,
				'result' => 1000
			],
			'thousand_2' => [
				'value'  => 1000,
				'pretty' => true,
				'abbrv'  => false,
				'result' => '1,000'
			],
			'thousand_3' => [
				'value'  => 1000,
				'pretty' => false,
				'abbrv'  => true,
				'result' => 1000
			],
			'thousand_4' => [
				'value'  => 1000,
				'pretty' => true,
				'abbrv'  => true,
				'result' => '1K'
			]
		];

		/**
		 * This test checks all of the test_array results.
		 *
		 * @throws Exception
		 */
		public function testIntegers() {
			$formatter = new Formatter;
			foreach ($this->test_array as $key => $test)
			{
				$formatter->setPretty($test['pretty']);
				$formatter->setAbbrv($test['abbrv']);
				$this->assertEquals($test['result'], $formatter->value($test['value'], 'integer'));
			}
		}

	}