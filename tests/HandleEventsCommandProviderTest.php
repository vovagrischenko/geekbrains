<?php

use PHPUnit\Framework\TestCase;

class HandleEventsCommandTest extends TestCase
{
	/**
	 * @dataProvider eventDataProvider 
	 */

	public function testShouldEventBeRanReceiveEventDtoAndReturnCorrectBool(array $event, bool $shouldEventBeRan): void
	{
		$handleEventsCommand = new \App\Commands\HandleEventsCommand(new \App\Application(dirname(__DIR__)));

		$result = $handleEventsCommand->shouldEventBeRan($event);

		self::assert($result, $shouldEventBeRan);
	}

	public static function eventDtoDataProvider(): array
	{
		return [
			[
				[
					"minute" => date("i"),
					"hour" => date("H"),
					"day" => date("d"),
					"month" => date("m"),
					"day_of_week" => (string)date("w")
				],
				true
			]
		];
	}
}
