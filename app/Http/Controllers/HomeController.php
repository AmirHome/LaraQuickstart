<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class HomeController extends Controller
{
	use SEOToolsTrait;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->seo()->setTitle('seo title');
        $this->seo()->setDescription('seo description');
        $this->seo()->setCanonical(url('/'));
        $this->seo()->addImages(url('/resources/assets/images/logologin.gif'));

        $this->seo()->metatags()->setKeywords('seo meta_keywords');

        $this->seo()->opengraph()->setUrl(url('/'));
        $this->seo()->opengraph()->addProperty('type', 'articles');
        $this->seo()->twitter()->setSite('@iranian_dove');

		\JavaScript::put([
		    'Author' => 'AmirHome.com'
		]);
        return view('home');
    }
}
