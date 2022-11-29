<?php

namespace App\Http\Controllers\Manager\Pages;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Foundation\Inspiring;

use App\Models\Pages\Page;

class PageController extends Controller
{
	/* Show Home */
	public function showHome() {
        $data = $this->getPageData('home');
        
        return view('manager.pages.home', array_merge($data, [
        	'quote' => Inspiring::quote(),
        ]));
	}

	/* Show About */
	public function showAbout() {
		$data = $this->getPageData('about');
        return view('manager.pages.about', $data);
	}

	/* Show Terms and Conditions */
	public function showTerms() {
		$data = $this->getPageData('terms_and_conditions');
        return view('manager.pages.terms', $data);
	}

	/* Show Privacy Policy */
	public function showPrivacy() {
		$data = $this->getPageData('privacy_policy');
        return view('manager.pages.privacy', $data);
	}

	/* Show Sample Page */
	public function showSamplePage() {
        return view('manager.pages.samples.index', [

        ]);
	}

	/* Get Page Data */
	protected function getPageData($slug) {
		$item = Page::where('slug', $slug)->firstOrFail();
		return $item->getData();
	}
}
