<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Bimbingan;

class DospemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dospemLayout(){
        $dosen = Dosen::where('user_id', Auth::id())->first();
        return $dosen->foto_dosen;
    }

    public function dospemHome()
    {
        $dosen = Dosen::where("user_id", Auth::id())->first();
        $mhsBim = $this->countMhsBim();
        $feedback = $this->countBim();
        return view('dosen.home', compact('dosen', 'mhsBim', 'feedback'));
    }

    public function countMhsBim(){
        $data = Mahasiswa::join('magang', 'mahasiswa.id', '=', 'magang.mhs_id')
        ->join('dosen', 'magang.dosen_id', '=', 'dosen.id')
        ->where('dosen.user_id', Auth::id())
        ->where('magang.approval', '!=', '2')
        ->select('mahasiswa.*', 'magang.*', 'dosen.*', 'mahasiswa.id as mhs_id')
        ->orderBy('magang.approval', 'asc')
        ->get();
        return $data->count();
    }

    public function countBim(){
        $data = Bimbingan::leftJoin('magang', 'bimbingan.magang_id', '=', 'magang.id')
        ->join('dosen', 'magang.dosen_id', '=', 'dosen.id')
        ->where('dosen.user_id', Auth::id())
        ->whereNull('feedback')
        ->select('bimbingan.*', 'magang.*', 'bimbingan.id as bim_id')
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
