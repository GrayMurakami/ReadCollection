<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

use App\Events\AuditLogEvent;

class PageController extends Controller
{
    public function topPage()
    {
        return view('topPage');
    }

    public function homePage()
    {
        $randomBook = Book::inRandomOrder()->first();
        return view('homePage', compact('randomBook'));
    }

    public function showSimpleSearchPage()
    {
        // 簡単な検索ページの訪問イベントを作成し、監査に記録
        event(new AuditLogEvent(auth()->id(), 'visit_page', 'User ' . auth()->user()->name . ' visited simple search page'));

        return view('simpleSearchPage');
    }

    public function showDetailSearchPage()
    {
        // 監査に記録する詳細検索ページ訪問イベントを作成
        event(new AuditLogEvent(auth()->id(), 'visit_page', 'User ' . auth()->user()->name . ' visited detail search page'));
        return view('detailSearchPage');
    }

    public function best10Page()
    {
        // best10ページの訪問イベントを作成し、監査に記録
        event(new AuditLogEvent(auth()->id(), 'visit_page', 'User ' . auth()->user()->name . ' visited best 10 page'));

        $selectedBestBooks = [
            ['cover_image' => 'storage/cover_images/book38_451.jpg', 'title' => '華氏451度', 'author' => 'レイ・ブラッドベリ', 'route' => 'books.showBook38'],
            ['cover_image' => 'storage/cover_images/book8_1984.jpg', 'title' => '1984年', 'author' => 'ジョージ・オーウェル', 'route' => 'books.showBook8'],
            ['cover_image' => 'storage/cover_images/book1_Master.jpg', 'title' => '巨匠とマルガリータ', 'author' => 'ミハイル・ブルガーコフ', 'route' => 'books.showBook1'],
            ['cover_image' => 'storage/cover_images/book19_TreeComrad.jpg', 'title' => '三人の仲間', 'author' => 'エーリヒ・マリア・レマルク', 'route' => 'books.showBook19'],
            ['cover_image' => 'storage/cover_images/book14_DorianGray.jpg', 'title' => 'ドリアン・グレイの肖像', 'author' => 'オスカー・ワイルド', 'route' => 'books.showBook14'],
            ['cover_image' => 'storage/cover_images/book5_LittlePrince.jpg', 'title' => '星の王子さま', 'author' => 'アントワーヌ・ド・サン＝テグジュペリ', 'route' => 'books.showBook5'],
            ['cover_image' => 'storage/cover_images/book45_Wine.jpg', 'title' => 'たんぽぽのお酒', 'author' => 'レイ・ブラッドベリ', 'route' => 'books.showBook45'],
            ['cover_image' => 'storage/cover_images/book18_NadPropasti.jpg', 'title' => '麦畑でつかまえて', 'author' => 'J.D.サリンジャー', 'route' => 'books.showBook18'],
            ['cover_image' => 'storage/cover_images/book12_AnnaK.jpg', 'title' => 'アンナ・カレーニナ', 'author' => 'レフ・トルストイ', 'route' => 'books.showBook12'],
            ['cover_image' => 'storage/cover_images/book3_Prestuplenie.jpg', 'title' => '罪と罰', 'author' => 'フョードル・ドストエフスキー', 'route' => 'books.showBook3']
        ];

        return view('best10Page', compact('selectedBestBooks'));
    }


    public function mustReadPage()
    {
        // mustReadページの訪問イベントを作成し、監査に記録
        event(new AuditLogEvent(auth()->id(), 'visit_page', 'User ' . auth()->user()->name . ' visited must read page'));

        $selectedReadBooks = [
            ['cover_image' => 'storage/cover_images/book1_Master.jpg', 'title' => '巨匠とマルガリータ', 'author' => 'ミハイル・ブルガーコフ', 'route' => 'books.showBook1'],
            ['cover_image' => 'storage/cover_images/book2_Onegin.jpg', 'title' => 'エヴゲーニイ・オネーギン', 'author' => 'アレクサンドル・プーシキン', 'route' => 'books.showBook2'],
            ['cover_image' => 'storage/cover_images/book3_Prestuplenie.jpg', 'title' => '罪と罰', 'author' => 'フョードル・ドストエフスキー', 'route' => 'books.showBook3'],
            ['cover_image' => 'storage/cover_images/book4_War.jpg', 'title' => '戦争と平和', 'author' => 'レフ・トルストイ', 'route' => 'books.showBook4'],
            ['cover_image' => 'storage/cover_images/book5_LittlePrince.jpg', 'title' => '星の王子さま', 'author' => 'アントワーヌ・ド・サン＝テグジュペリ', 'route' => 'books.showBook5'],
            ['cover_image' => 'storage/cover_images/book6_Hero.jpg', 'title' => '現代の英雄', 'author' => 'ミハイル レールモントフ', 'route' => 'books.showBook6'],
            ['cover_image' => 'storage/cover_images/book7_Chairs.jpg', 'title' => '十二の椅子', 'author' => 'イリヤ・イリフとエフゲニー・ペトロフ', 'route' => 'books.showBook7'],
            ['cover_image' => 'storage/cover_images/book8_1984.jpg', 'title' => '1984年', 'author' => 'ジョージ・オーウェル', 'route' => 'books.showBook8'],
            ['cover_image' => 'storage/cover_images/book9_Hundread.jpg', 'title' => '百年の孤独', 'author' => 'ガブリエル・ガルシア・マルケス', 'route' => 'books.showBook9'],
            ['cover_image' => 'storage/cover_images/book10_HarryPotter.jpg', 'title' => 'ハリー・ポッターと賢者の石', 'author' => 'J.K.ローリング', 'route' => 'books.showBook10']
        ];

        return view('mustReadPage', compact('selectedReadBooks'));
    }

    public function bestsellerPage()
    {
        // bestsellerページの訪問イベントを作成し、監査に記録
        event(new AuditLogEvent(auth()->id(), 'visit_page', 'User ' . auth()->user()->name . ' visited bestseller page'));

        $selectedSellerBooks = [
            ['cover_image' => 'storage/cover_images/book21_People.jpg', 'title' => '人間失格', 'author' => '太宰治', 'route' => 'books.showBook21'],
            ['cover_image' => 'storage/cover_images/book22_Money.jpg', 'title' => 'こころ', 'author' => '夏目 漱石', 'route' => 'books.showBook22'],
            ['cover_image' => 'storage/cover_images/book23_Ocean.jpg', 'title' => '破戒', 'author' => '島崎 藤村', 'route' => 'books.showBook23'],
            ['cover_image' => 'storage/cover_images/book24_Cloud.jpg', 'title' => '沈黙', 'author' => '遠藤 周作', 'route' => 'books.showBook24'],
            ['cover_image' => 'storage/cover_images/book25_Woman.jpg', 'title' => '砂の女', 'author' => '安部 公房', 'route' => 'books.showBook25'],
            ['cover_image' => 'storage/cover_images/book26_Man.jpg', 'title' => '仮面の告白', 'author' => '三島 由紀夫', 'route' => 'books.showBook26'],
            ['cover_image' => 'storage/cover_images/book27_Square.jpg', 'title' => '坊つちやん', 'author' => '夏目 漱石', 'route' => 'books.showBook27'],
            ['cover_image' => 'storage/cover_images/book28_School.jpg', 'title' => '告白', 'author' => '湊 かなえ', 'route' => 'books.showBook28'],
            ['cover_image' => 'storage/cover_images/book29_Conbini.jpg', 'title' => 'コンビニ人間', 'author' => '村田 沙耶香', 'route' => 'books.showBook29'],
            ['cover_image' => 'storage/cover_images/book30_German.jpg', 'title' => '車輪の下', 'author' => 'ヘルマン・ヘッセ', 'route' => 'books.showBook30']
        ];

        return view('bestsellerPage', compact('selectedSellerBooks'));
    }

    public function contactPage()
    {
        return view('contactPage');
    }
}
