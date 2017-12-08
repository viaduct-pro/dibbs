<?php
namespace App\Console\Commands;

use App\Classes\Socket\ItemSocket;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class ItemServer extends Command
{
    protected $signature = 'item_server:start';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Start server');
        $server = IoServer::factory(
          new HttpServer(
              new WsServer(
                  new ItemSocket()
              )
          ), 8088
        );

        $server->run();
    }
}