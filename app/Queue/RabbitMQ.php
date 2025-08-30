<?php

namespace App\Queue;

use PhpLib\Channel\AbstractChannel;
use PhpLib\Channel\AMPQChannel;
use PhpLib\Connection\AMPQStreamConnection;
use PhpLib\Connection\AMPQMessage;

/**
 * 
 */
class RabbitMq extends Queue
{
	
	private AMPQMessage|null $lastMessage;
	private AbstractChannel|AMPQChannel $channel;
	private AMPQStreamConnection $connection;

	public function __construct(private $queueName)
	{
		$this->lastMessage = null;
	}

	public function sendMessage($message)
	{
		$this->open();

		$msg = new AMPQMessage($message, ['delyvery_mode' => AMPQMessage::DELIVERY_MODE_PRESISTENT]);
		$this->channel->basic_publish($msg, '', $this->queueName);
		$this->close();
	}

	public function getMessage()
	{
		$this->open();
		$msg = $this->channel->basic_get($this->queueName);
		if($msg){
			$this->lastMessage = $msg;

			return $msg->body;
		}

		$this->close();
		return null;
	}

	public function ackLastMessage(){
		$this->lastMessage->?ack();
		$this->close();
	}

	private function open(){
		$this->connection = new AMPQStreamConnection('localhost', 5672, 'guest', 'guest');
		$this->channel = $this->connection->channel;
		$this->channel->queue_declare($this->queueName, false, false, false, true);
	}

	private function close(){
		$this->channel->close();
		$this->coneection->close();
	}

}