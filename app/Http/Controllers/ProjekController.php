<?php

namespace App\Http\Controllers;

use App\Models\Projek;
use Illuminate\Http\Request;

class ProjekController extends Controller
{
    const DATA_INPUT = [
        'nama_projek',
        'deskripsi',
        'keterangan',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Projek::all();
        return view('projek.index', compact('data'));
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
            Projek::create($data);
            return back()->with('message', 'Berhasil tambah data!');
        }
        return back()->with('message', 'Tidak Punya Akses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projek  $projek
     * @return \Illuminate\Http\Response
     */
    public function show(Projek $projek)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projek  $projek
     * @return \Illuminate\Http\Response
     */
    public function edit(Projek $projek)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Projek  $projek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projek $projek)
    {
        //
        if (auth()->user()) {
            $data = $request->only(self::DATA_INPUT);
            $projek->update($data);
            return back()->with('message', 'Berhasil ubah data!');
        }
        return back()->with('message', 'Tidak Punya Akses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projek  $projek
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projek $projek)
    {
        //
        if (auth()->user()) {
            $projek->delete();
            return back()->with('message', 'Berhasil hapus data!');
        }
        return back()->with('message', 'Tidak Punya Akses');
    }

    public function selesai($id)
    {
        //
        $data = Projek::where('id', $id)->first();
        if ($data) {
            $data->status = 1;
            $data->save();
        }
        return back()->with('message', 'Projek berhasil diselesaikan');
    }

    public function belum($id)
    {
        $data = Projek::where('id', $id)->first();
        if ($data) {
            $data->status = 0;
            $data->save();
        }
        return back()->with('message', 'Projek belum diselesaikan');
    }
}