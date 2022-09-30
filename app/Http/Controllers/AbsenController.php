<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsenController extends Controller
{

    const DATA_INPUT = [
        'user_id', 'keterangan', 'status'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Absen::with('user')->where('keterangan', 'Datang')->get();
        return view('absen.datang', compact('data'));
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
        if (auth()->user()->id == $request->user_id) {
            $data = $request->only(self::DATA_INPUT);
            $data['keterangan'] = 'Datang';
            Absen::create($data);
            return back()->with('message', 'Absen Sukses!');
        }
        return back()->with('message', 'Tidak Punya Akses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function show(Absen $absen)
    {
        //
        $absen->load('user');
        return response()->json($absen);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function edit(Absen $absen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
        if (auth()->user()->id) {
            $data = Absen::where('user_id', $id)->where('keterangan', 'Datang')->WhereDate('created_at', Carbon::today())->first();
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
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absen $absen)
    {
        //
    }
}