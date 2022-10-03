<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Projek;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Projek::all()->count() != 0) {
            $ttlProjek = Projek::count();
            $projekFinish = Projek::where('status', 1)->count();
            $presentaseProjek = ($projekFinish / $ttlProjek * 100);

            $thisMonth =  Carbon::now()->format('m');
            $absenTotal = Absen::where('keterangan', 'Datang')->whereMonth('created_at', $thisMonth)->count();
            $absenMasuk = Absen::where('keterangan', 'Datang')->where('status', 1)->whereMonth('created_at', $thisMonth)->count();
            $absenBolos = Absen::where('keterangan', 'Datang')->where('status', 0)->whereMonth('created_at', $thisMonth)->count();

            $ttlMasuk = ($absenMasuk / $absenTotal * 100);
            $ttlBolos = ($absenBolos / $absenTotal * 100);
            return view('dashboard', compact('ttlProjek', 'presentaseProjek', 'absenMasuk', 'ttlMasuk', 'absenBolos', 'ttlBolos'));
        } else {
            $ttlProjek = 0;
            $projekFinish = 0;
            $presentaseProjek = 0;

            $thisMonth =  Carbon::now()->format('m');
            $absenTotal = Absen::where('keterangan', 'Datang')->whereMonth('created_at', $thisMonth)->count();
            $absenMasuk = Absen::where('keterangan', 'Datang')->where('status', 1)->whereMonth('created_at', $thisMonth)->count();
            $absenBolos = Absen::where('keterangan', 'Datang')->where('status', 0)->whereMonth('created_at', $thisMonth)->count();

            $ttlMasuk = 0;
            $ttlBolos = 0;
            return view('dashboard', compact('ttlProjek', 'presentaseProjek', 'absenMasuk', 'ttlMasuk', 'absenBolos', 'ttlBolos'));
        }
    }
}