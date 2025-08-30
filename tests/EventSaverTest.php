<?php

use App\Actions\EventSaver;
use App\Models\Event;
use PHPUnit\Framework\TestCase;

class EventSaverTest extends TestCase
{
	/**
	 * @dataProvider eventDataProvider
	 */

	public function testHandleCallCorrectInsertInModel(array $eventDto, array $expectedArray): void
	{
		$mock = $this->getMockBuilder(Event::class)->disableOriginalConstructor()->setMethods(['insert'])->getMock();
		$mock->expects($this->once())->method('insert')
			->with("name, text, receiver_id, minute, hour, day, monrh, day_of_week", $expectedArray);

		$eventSaver = new EventSaver($mock);
		$eventSaver->handle($eventDto);

	}

	public static function eventDataProvider(): array
	{
		return [
			[
				[
					'name' => 'some-name',

	            	'text' => 'some-text',

	            	'receiver_id' => 'some-receiver_id',

	            	'minute' => 'some-minute',

	            	'hour' => 'some-hour',

	            	'day' => 'some-day',

	            	'month' => 'some-month',

	            	'day_of_week' => 'some-day_of_week'	
				],
				[
					'some-name',

	            	'some-text',

	            	'some-receiver_id',

	            	'some-minute',

	            	'some-hour',

	            	'some-day',

	            	'some-month',

	            	'some-day_of_week'	
				]
			],
			[
				[
					'name' => 'some-name',

	            	'text' => 'some-text',

	            	'receiver_id' => 'some-receiver_id',

	            	'minute' => null,

	            	'hour' => null,

	            	'day' => null,

	            	'month' => null,

	            	'day_of_week' => null	
				],
				[
					'some-name',

	            	'some-text',

	            	'some-receiver_id',

	            	null,

	            	null,

	            	null,

	            	null,

	            	null	
				]
			]
		];
	}
}

