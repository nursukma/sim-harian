<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsenPulangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Absen::with('user')->where('keterangan', 'Pulang')->get();
        return view('absen.pulang', compact('data'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AbsenPulang  $absenPulang
     * @return \Illuminate\Http\Response
     */
    public function show(Absen $absenPulang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AbsenPulang  $absenPulang
     * @return \Illuminate\Http\Response
     */
    public function edit(Absen $absenPulang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AbsenPulang  $absenPulang
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
        if (auth()->user()->id) {
            $data = Absen::where('user_id', $id)->where('keterangan', 'Pulang')->WhereDate('created_at', Carbon::today())->FIRST();
            if ($data) {
                $data->status = 1;
                $data->save();
            }
            return back()->with('message', 'Berhasil Absen!');
        }
        return back()->with('message', 'Tidak Punya Akses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AbsenPulang  $absenPulang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absen $absenPulang)
    {
        //
    }
}