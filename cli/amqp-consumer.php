<?php
/**
 * Created by PhpStorm.
 * User: david.li
 * Date: 19/2/19
 * Time: 17:24
 */

! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));

require '../vendor/autoload.php';

use Hyperf\DbConnection\Db;
use Hyperf\Di\Container;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Di\Definition\DefinitionSourceFactory;
use App\Constants\ConstData;
use App\Utils\Logger;

$conn_args = array(
    'host' => '127.0.0.1',
    'port' => '5672',
    'login' => 'guest',
    'password' => 'guest',
    'vhost'=>'/'
);

$e_name = 'bus-follow-light-exchange'; //交换机名
$q_name = 'bus-follow-light-queue'; //队列名
$k_route = 'bus-follow-light-routing-key'; //路由key


//创建连接和channel
$conn = new \AMQPConnection($conn_args);
if (!$conn->connect()) {
    die("Cannot connect to the broker!\n");
}
$channel = new \AMQPChannel($conn);

//创建交换机
$ex = new \AMQPExchange($channel);
$ex->setName($e_name);
$ex->setType(AMQP_EX_TYPE_DIRECT); //direct类型
$ex->setFlags(AMQP_DURABLE); //持久化
// $ex->publish($message [, $routing_key, $flags, $headers])
echo "Exchange Status:".$ex->declareExchange()."\n";

//创建队列
$q = new \AMQPQueue($channel);
$q->setName($q_name);
$q->setFlags(AMQP_DURABLE); //持久化
echo "Message Total:".$q->declareQueue()."\n";

//绑定交换机与队列，并指定路由键
echo 'Queue Bind: '.$q->bind($e_name, $k_route)."\n";

//阻塞模式接收消息
echo "Message:\n";
getContainer();
// while(True){
# qos
$channel->qos(0,1);
$q->consume('processMessage', AMQP_AUTOACK); # 消息一个消息
//$q->consume('processMessage', AMQP_AUTOACK); //自动ACK应答
// }
$conn->disconnect();

//\Hyperf\Utils\ApplicationContext::setContainer();

function processMessage($envelope, $queue) {
    $msg = $envelope->getBody();
//    var_dump($msg);
//    "{"_id":1611475660.278451,"data":{"vote_id":11737}}"
    $msg = json_decode($msg, true);
    $voteId = $msg['data']['vote_id'] ?? 0;
//    if(empty($voteId)){
//        return ErrorCode::OK;
//    }
    try{

        $lightVoteObject = Hyperf\DbConnection\Db::table('follow_light_vote')->where('vote_id', $voteId)->limit(1)->first();
        if(empty($lightVoteObject)){
            return true;
        }
        if($lightVoteObject->is_deal == 1){
            return true;
        }
        $currentTime = $lightVoteObject->created_at;
        $updatedData['vote'] = DB::raw('`vote` + ' . $lightVoteObject->vote);
        if($currentTime >= ConstData::FOLLOW_LIGHT_FIRST_START_TIME &&  $currentTime <= ConstData::FOLLOW_LIGHT_FIRST_END_TIME){
            $updatedData['first_light_vote'] = DB::raw('`first_light_vote` + ' . $lightVoteObject->vote);
        }
        if($currentTime >= ConstData::FOLLOW_LIGHT_SECOND_START_TIME &&  $currentTime <= ConstData::FOLLOW_LIGHT_SECOND_END_TIME){
            $updatedData['second_light_vote'] = DB::raw('`second_light_vote` + ' . $lightVoteObject->vote);
        }
        if($currentTime >= ConstData::FOLLOW_LIGHT_THIRD_START_TIME &&  $currentTime <= ConstData::FOLLOW_LIGHT_THIRD_END_TIME){
            $updatedData['third_light_vote'] = DB::raw('`third_light_vote` + ' . $lightVoteObject->vote);
        }
        if($currentTime >= ConstData::FOLLOW_LIGHT_FOUR_START_TIME &&  $currentTime <= ConstData::FOLLOW_LIGHT_FOUR_END_TIME){
            $updatedData['four_light_vote'] = DB::raw('`four_light_vote` + ' . $lightVoteObject->vote);
        }
        Db::beginTransaction();
        Db::table('follow_light_vote')->where('vote_id', $voteId)->update(['is_deal' => 1]);
        Db::table('follow_light')->where('light_id', $lightVoteObject->light_id)->update($updatedData);
        Db::commit();
        return true;
    }catch (\Exception $e){
        Db::rollBack();
        Logger::get('follow-light-deal-consumer-vote')->error($e->getMessage());
        return Hyperf\Amqp\Result::ACK;
    }
//    echo $msg."\n"; //处理消息
//    # getDeliveryTag 获取 ack 的唯一标示，
//    $queue->ack($envelope->getDeliveryTag()); //手动发送ACK应答
}


function getContainer()
{
    $container = new Container((new DefinitionSourceFactory(true))());
    if (! $container instanceof \Psr\Container\ContainerInterface) {
        throw new RuntimeException('The dependency injection container is invalid.');
    }
    ApplicationContext::setContainer($container);
    return $container;
}
