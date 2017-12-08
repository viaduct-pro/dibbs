<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Server\IoServer;

use App\Classes\Socket\Pusher;
use React\EventLoop\Factory as ReactLoop;
use React\ZMQ\Context as ReactContext;
use React\Socket\Server as ReactServer;
use Ratchet\Wamp\WampServer;

class PushServer extends Command
{


    protected $signature = 'socketpush:serve';

    protected $description = 'Command description.';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $loop = ReactLoop::create();

        $pusher = new Pusher();

        $context = new ReactContext($loop);

        $pull = $context->getSocket(\ZMQ::SOCKET_PULL);
        $pull->bind('tcp://127.0.0.1:5555');
        $pull->on('message', [$pusher, 'broadcast']);

        $webSock = new ReactServer('tcp://0.0.0.0:8050', $loop);
//        $webSock->listen(8070, '0.0.0.0');
        $webServer = new IoServer(
            new HttpServer(
                new WsServer(
                    new WampServer(
                        $pusher
                    )
                )
            ), $webSock
        );
        $this->info('Start server');

//        $webServer->info('Run handle');
        $loop->run();
    }

}