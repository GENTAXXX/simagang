<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supervisor;
use App\Models\Mahasiswa;
use App\Models\Magang;
use Illuminate\Support\Facades\Auth;

class SpvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function spvLayout(){
        $spv = Supervisor::where('user_id', Auth::id())->first();
        return $spv->foto_spv;
    }

    public function supervisorHome()
    {
        $spv = $this->spvLayout();
        $mhsLogbook = $this->countMhsLogbook();
        $nilai = $this->countPenilaian();
        return view('spv.home', compact('spv', 'mhsLogbook', 'nilai'));
    }

    public function countMhsLogbook(){
        $data = Mahasiswa::join('magang', 'mahasiswa.id', '=', 'magang.mhs_id')
        ->join('lowongan', 'magang.lowongan_id', '=', 'lowongan.id')
        ->join('supervisor', 'magang.spv_id', '=', 'supervisor.id')
        ->where('supervisor.user_id', Auth::id())
        ->where('magang.approval', '!=', '2')
        ->select('mahasiswa.id as mhs_id', 'mahasiswa.*', 'lowongan.*', 'supervisor.*', 'magang.approval')
        ->orderBy('magang.approval', 'asc')
        ->get();
        return $data->count();
    }

    public function countPenilaian(){
        $data = Magang::join('mahasiswa', 'magang.mhs_id', '=', 'mahasiswa.id')
        ->join('lowongan', 'magang.lowongan_id', '=', 'lowongan.id')
        ->join('supervisor', 'magang.spv_id', '=', 'supervisor.id')
        ->where('supervisor.user_id', Auth::id())
        ->where('approval', '3')
        ->whereNull('nilai')
        ->whereNull('keterangan')
        ->select('magang.*', 'magang.id as mag_id', 'supervisor.*', 'mahasiswa.*', 'lowongan.nama_low')
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
