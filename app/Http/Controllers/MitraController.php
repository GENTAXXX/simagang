<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Magang;
use App\Models\Mitra;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mitraLayout(){
        $mitra = Mitra::where('user_id', Auth::id())->first();
        return view('mitra.layout', compact('mitra'));
    }
    public function countPendaftar(){
        $data = Magang::where('approval', '0')
        ->whereNotNull('dosen_id')
        ->get();
        return $data->count();
    }

    public function mitraHome()
    {
        $mitra = Mitra::where("user_id", Auth::id())->first();
        $count = $this->countPendaftar();
        $low = $this->countLowongan();
        $mag = $this->countMag();
        $full = $this->countLowFull();
        return view('mitra.home', compact('mitra', 'count', 'low', 'mag', 'full'));
    }

    public function countLowongan(){
        $mitra = Mitra::where("user_id", Auth::id())->first();
        $low = Lowongan::where("mitra_id", $mitra->id)
        ->get();
        return $low->count();
    }

    public function countMag(){
        $data = Magang::join('mahasiswa', 'magang.mhs_id', '=', 'mahasiswa.id')
        ->join('lowongan', 'magang.lowongan_id', '=', 'lowongan.id')
        ->join('mitra', 'lowongan.mitra_id', '=', 'mitra.id')
        ->where('mitra.user_id', Auth::id())
        ->where('approval', '!=', '2')
        ->where('approval', '!=', '0')
        ->select('mahasiswa.*', 'lowongan.*', 'mitra.*', 'magang.id as magang_id', 'magang.*')
        ->get();
        return $data->count();
    }

    public function countLowFull(){
        $mitra = Mitra::where("user_id", Auth::id())->first();
        $data = Lowongan::where("mitra_id", $mitra->id)
        ->where('jumlah_mhs', '0')
        ->get();
        return $data->count();
    }

    public function index()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
