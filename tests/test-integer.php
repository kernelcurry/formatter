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
				'result' => 0
			],
			'zero_3' => [
				'value'  => 0,
				'pretty' => false,
				'abbrv'  => true,
				'result' => 0
			],
			'zero 4' => [
				'value'  => 0,
				'pretty' => true,
				'abbrv'  => true,
				'result' => 0
			]
		];

		/**
		 * This test checks all of the test_array results.
		 *
		 * @throws Exception
		 */
		public function testIntegers() {
			$formatter = new Formatter;
			foreach ($this->test_array as $test)
			{
				$formatter->setPretty($test['pretty']);
				$formatter->setAbbrv($test['abbvr']);
				$this->assertEquals($test['result'], $formatter->value($test['value'], 'integer'));
			}
		}

	}