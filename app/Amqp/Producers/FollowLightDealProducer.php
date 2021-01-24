<?php

declare(strict_types=1);

namespace App\Amqp\Producers;

use Hyperf\Amqp\Annotation\Producer;
use Hyperf\Amqp\Message\ProducerMessage;
use Hyperf\Amqp\Message\Type;


/**
 * Class FollowLightDealProducer
 * @package App\Amqp\Producers
 * @Producer(exchange="bus-follow-light-exchange", routingKey="bus-follow-light-routing-key")
 */
class FollowLightDealProducer extends ProducerMessage
{

    /**
     * @var string
     */
    protected $type = Type::DIRECT;

    public function __construct($id)
    {
        $this->payload = [
            '_id' => microtime(true),
            'data' => ['vote_id' => $id]
        ];
    }
}