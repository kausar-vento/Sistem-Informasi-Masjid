<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\FundRaising;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function landingPage() {
        return view('landing-page.landing_page', [
            'dataEvent' => Event::latest()->get(),
            'dataDonasi' => FundRaising::latest()->get()
        ]);
    }

    public function detailLandingPage($title) {
        $getEvent = Event::where('nama_event', 'like', $title)->first();
        // dd($getEvent);
        return view('landing-page.detail_landing_page', compact('getEvent'));
    }

    public function detailDonasiLandingPage($kegiatan) {
        $getDonasi = FundRaising::where('nama_kegiatan', 'like', $kegiatan)->first();
        // dd($getDonasi);
        return view('landing-page.detail_donasi_landing_page', compact('getDonasi'));
    }

    public function tester() {
        return view('landing-page.tester');
    }
}
