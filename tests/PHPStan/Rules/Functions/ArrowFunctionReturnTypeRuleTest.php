<?php declare(strict_types = 1);

namespace PHPStan\Rules\Functions;

use PHPStan\Rules\FunctionReturnTypeCheck;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleLevelHelper;
use PHPStan\Testing\RuleTestCase;

/**
 * @extends RuleTestCase<ArrowFunctionReturnTypeRule>
 */
class ArrowFunctionReturnTypeRuleTest extends RuleTestCase
{

	protected function getRule(): Rule
	{
		return new ArrowFunctionReturnTypeRule(new FunctionReturnTypeCheck(new RuleLevelHelper(
			$this->createReflectionProvider(),
			true,
			false,
			true,
			false,
		)));
	}

	public function testRule(): void
	{
		$this->analyse([__DIR__ . '/data/arrow-functions-return-type.php'], [
			[
				'Anonymous function should return string but returns int.',
				12,
			],
			[
				'Anonymous function should return int but returns string.',
				14,
			],
		]);
	}

	public function testBug3261(): void
	{
		$this->analyse([__DIR__ . '/data/bug-3261.php'], []);
	}

}
