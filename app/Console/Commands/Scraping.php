<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Weidner\Goutte\GoutteFacade as GoutteFacade;

class Scraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scraping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Amazonでベトナムのsimカードをスクレイピングします';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // ここではアマゾンカメラランキングをスクレイピング
        $goutte = GoutteFacade::request('GET', 'https://boards.4channel.org/sp/thread/100466668');

        //画像を取得するための配列を準備
        $images = array();
        //テキストを取得するための配列を準備
        $texts = array();

        // 画像のsrc部分を取得
        $goutte->filter('.s-image')->each(function ($node) use (&$images) {
            $images[] = $node->attr('src');
        });

        // テキストを取得
        $goutte->filter('.s-image')->each(function ($node) use (&$texts) {
            $texts[] = $node->attr('alt');
        });
        // $goutte->filter('.postMessage')->each(function ($node) use (&$images) {
        //     $images[] = $node->attr('blockquote');
        //     dd($images);
        // });

        $params = [
            'images' => $images,
            'texts' => $texts,
        ];
        
        dd($params);
    }
}
