<?php

namespace App\Http\Controllers;

use App\Models\catatan;
use App\Models\Catatan as ModelsCatatan;
use App\Models\KegiatanHarian;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CatatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = ModelsCatatan::all();
        return view('catatan.index', compact('data'));
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
            $catatan = $request->catatan;
            $projek = KegiatanHarian::whereDate('created_at', Carbon::now('F'))->first();
            if ($projek != null) {
                $projek_id = $projek->id;
                $user_id = auth()->user()->id;

                $data = ['catatan' => $catatan, 'kegiatan_id' => $projek_id, 'user_id' => $user_id];
                ModelsCatatan::create($data);
                return back()->with('message', 'Berhasil menambahkan catatan!');
            }
            return back()->with('message', 'Silakan tambah kegiatan dulu!');
        }
        return back()->with('message', 'Tidak Punya Akses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\catatan  $catatan
     * @return \Illuminate\Http\Response
     */
    public function show(catatan $catatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\catatan  $catatan
     * @return \Illuminate\Http\Response
     */
    public function edit(catatan $catatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\catatan  $catatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, catatan $catatan)
    {
        //
        if (auth()->user()) {
            $catatan_up = $request->catatan;
            $catatan->catatan = $catatan_up;
            $catatan->save();
            // dd($catatan_up);
            return back()->with('message', 'Berhasil menambahkan catatan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\catatan  $catatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(catatan $catatan)
    {
        //
    }
}