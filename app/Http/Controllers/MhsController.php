<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Logbook;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\SkillMhs;
use App\Models\Magang;
use Illuminate\Support\Facades\Auth;

class MhsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mhsLayout(){
        $mhs = Mahasiswa::where('user_id', Auth::id())->first();
        dd($mhs);
        return view('mhs.layout', compact('mhs'));
    }
    public function mahasiswaHome()
    {
        $mhs = Mahasiswa::where("user_id", Auth::id())->first();
        $ajukan = $this->countAjukan();
        $log = $this->countLogbook();
        $bim = $this->countBimbingan();
        return view('mhs.home', compact('mhs', 'ajukan', 'log', 'bim'));
    }

    public function countAjukan(){
        $data = Magang::join('mahasiswa', 'magang.mhs_id', '=', 'mahasiswa.id')
        ->join('lowongan', 'magang.lowongan_id', '=', 'lowongan.id')
        ->where('mahasiswa.user_id', Auth::id())
        ->get();
        return $data->count();
    }

    public function countLogbook(){
        $data = Logbook::join('magang', 'logbook.magang_id', '=', 'magang.id')
        ->join('mahasiswa', 'magang.mhs_id', '=', 'mahasiswa.id')
        ->where('mahasiswa.user_id', Auth::id())
        ->get();
        return $data->count();
    }

    public function countBimbingan(){
        $data = Bimbingan::join('magang', 'bimbingan.magang_id', '=', 'magang.id')
        ->join('mahasiswa', 'magang.mhs_id', '=', 'mahasiswa.id')
        ->where('mahasiswa.user_id', Auth::id())
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
