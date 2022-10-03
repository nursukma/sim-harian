<?php

namespace App\Http\Controllers;

use App\Models\KegiatanHarian;
use App\Models\Projek;
use Illuminate\Http\Request;

class KegiatanHarianController extends Controller
{
    const DATA_INPUT = ['kegiatan', 'projek_id', 'user_id'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data =  KegiatanHarian::all();
        $projek = Projek::all()->where('status', 0);
        return view('kegiatan.index', compact('data', 'projek'));
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
            $data['user_id'] = auth()->user()->id;
            KegiatanHarian::create($data);
            return back()->with('message', 'Berhasil menambahkan kegiatan!');
        }
        return back()->with('message', 'Tidak Punya Akses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KegiatanHarian  $kegiatanHarian
     * @return \Illuminate\Http\Response
     */
    public function show(KegiatanHarian $kegiatanHarian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KegiatanHarian  $kegiatanHarian
     * @return \Illuminate\Http\Response
     */
    public function edit(KegiatanHarian $kegiatanHarian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KegiatanHarian  $kegiatanHarian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KegiatanHarian $kegiatanHarian)
    {
        //
        if (auth()->user()) {
            $data = $request->only(self::DATA_INPUT);
            $data['user_id'] = auth()->user()->id;
            $kegiatanHarian->update($data);
            return back()->with('message', 'Berhasil mengubah kegiatan!');
        }
        return back()->with('message', 'Tidak Punya Akses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KegiatanHarian  $kegiatanHarian
     * @return \Illuminate\Http\Response
     */
    public function destroy(KegiatanHarian $kegiatanHarian)
    {
        //
        if (auth()->user()) {
            $kegiatanHarian->delete();
            return back()->with('message', 'Berhasil menghapus kegiatan!');
        }
        return back()->with('message', 'Tidak Punya Akses');
    }
}