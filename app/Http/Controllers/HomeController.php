<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Catatan;
use App\Models\KegiatanHarian;
use App\Models\Projek;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

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
        $thisMonth =  Carbon::now()->format('m');
        $absenTotal = Absen::where('keterangan', 'Datang')->whereMonth('created_at', $thisMonth)->count();
        $absenMasuk = Absen::where('keterangan', 'Datang')->where('status', 1)->whereMonth('created_at', $thisMonth)->count();
        $absenBolos = Absen::where('keterangan', 'Datang')->where('status', 0)->whereMonth('created_at', $thisMonth)->count();

        $catatan = Catatan::whereMonth('created_at', $thisMonth)->get();

        if (Projek::all()->count() != 0) {
            $ttlProjek = Projek::count();
            $projekFinish = Projek::where('status', 1)->count();
            $presentaseProjek = ($projekFinish / $ttlProjek * 100);


            $ttlMasuk = ($absenMasuk / $absenTotal * 100);
            $ttlBolos = ($absenBolos / $absenTotal * 100);
        } else {
            $ttlProjek = 0;
            $projekFinish = 0;
            $presentaseProjek = 0;



            $ttlMasuk = 0;
            $ttlBolos = 0;
        }
        return view('dashboard', compact('ttlProjek', 'presentaseProjek', 'absenMasuk', 'ttlMasuk', 'absenBolos', 'ttlBolos', 'catatan'));
    }

    public function kerja_projek()
    {
        // $data = Projek::with('kegiatan')->withCount('kegiatan')->get()->groupBy(function ($date) {
        //     return Carbon::parse($date->kegiatan->created_at)->format('d'); // grouping by years
        // });
        $data = KegiatanHarian::with('projek')->get()->groupBy(
            function ($date) {
                return Carbon::parse($date->created_at)->format('d-F-Y'); // grouping by years
            }
        );
        // return $data->toJson(JSON_PRETTY_PRINT);
        // return $data->toArray();
        // $array = [];
        // foreach ($data as $key => $value) {
        //     $array[] = ['nama_projek' => $key->nama_projek, 'kegiatan' => $value->nama_kegiatan, 'created_at' => $value->created_at];
        // }
        return Response::json($data);
    }
}