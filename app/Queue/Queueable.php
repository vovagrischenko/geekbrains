<?php

namespace App\Queue;

interface Queueable{
	public function hanlde();
	public function toQueue();
}