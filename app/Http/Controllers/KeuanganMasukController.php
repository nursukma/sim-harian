<?php

namespace App\Http\Controllers;

use App\Models\KeuanganMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeuanganMasukController extends Controller
{
    const DATA_INPUT = ['catatan', 'nominal', 'jumlah_uang', 'user_id', 'status'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = KeuanganMasuk::where('status', 1)->get();
        return view('keuangan.masuk', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (auth()->user()) {
            $data = $request->only(self::DATA_INPUT);
            $ttlData = KeuanganMasuk::all()->count();
            $jmlUang = DB::table('keuangan')->select('jumlah_uang')->where('status', 1)->orderBy('id', 'desc')->first();
            if ($ttlData == 0) {
                $data['jumlah_uang'] = $request->nominal;
            }
            $data['jumlah_uang'] = ($jmlUang + $data['nominal']);
            $data['user_id'] = auth()->user()->id;
            $data['status'] = 1;
            KeuanganMasuk::create($data);
            return back()->with('message', 'Berhasil tambah data!');
        }
        return back()->with('message', 'Tidak Punya Akses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KeuanganMasuk  $keuanganMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(KeuanganMasuk $keuanganMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KeuanganMasuk  $keuanganMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(KeuanganMasuk $keuanganMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KeuanganMasuk  $keuanganMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KeuanganMasuk $keuanganMasuk)
    {
        //
        if (auth()->user()) {
            $data = $request->only(self::DATA_INPUT);
            $ttlData = KeuanganMasuk::all()->count();
            $jmlUang = DB::table('keuangan')->select('jumlah_uang')->where('status', 1)->orderBy('id', 'desc')->first();
            $nominalLama = DB::table('keuangan')->select('nominal')->where('status', 1)->orderBy('id', 'desc')->first();
            if ($ttlData == 0) {
                $data['jumlah_uang'] = $request->nominal;
            }
            $data['jumlah_uang'] = $jmlUang->jumlah_uang - $nominalLama->nominal + (int)$data['nominal'];
            $data['user_id'] = auth()->user()->id;
            // dd($data);
            $keuanganMasuk->update($data);
            return back()->with('message', 'Berhasil mengubah data!');
        }
        return back()->with('message', 'Tidak Punya Akses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KeuanganMasuk  $keuanganMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(KeuanganMasuk $keuanganMasuk)
    {
        //
        if (auth()->user()->id) {
            $keuanganMasuk->delete();
            return back()->with('message', 'Berhasil menghapus data!');
        }
        return back()->with('message', 'Tidak Punya Akses');
    }
}