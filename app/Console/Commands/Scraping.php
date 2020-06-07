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
        $goutte = GoutteFacade::request('GET', 'https://www.amazon.co.jp/s?k=%E3%83%99%E3%83%88%E3%83%8A%E3%83%A0sim&rh=p_76%3A2227292051&dc&__mk_ja_JP=%E3%82%AB%E3%82%BF%E3%82%AB%E3%83%8A&qid=1589005874&rnid=2227291051&ref=sr_nr_p_76_1');

        //画像を取得するための配列を準備
        $images = array();
        //テキストを取得するための配列を準備
        $texts = array();

        //画像のsrc部分を取得
        $goutte->filter('.s-image')->each(function ($node) use (&$images) {
            $images[] = $node->attr('src');
        });

        //テキストを取得
        $goutte->filter('.s-image')->each(function ($node) use (&$texts) {
            $texts[] = $node->attr('alt');
        });

        $params = [
            'images' => $images,
            'texts' => $texts,
        ];
        
        dd($params);
    }
}
