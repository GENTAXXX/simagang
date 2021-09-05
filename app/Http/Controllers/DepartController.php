<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departemen;
use App\Models\Mahasiswa;
use App\Models\Magang;
use App\Models\SkillMhs;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function departLayout(){
        $depart = Departemen::where('user_id', Auth::id())->first();
        return view('depart.layout', compact('depart'));
    }
    public function countPengajuan(){
        $data = Magang::whereNull('dosen_id')
        ->get();
        return $data->count();
    }
    
    public function detailMhs($id){
        $mhs = Mahasiswa::find($id);
        $skill = SkillMhs::join('skill', 'skill_mhs.skill_id', '=', 'skill.id')
                ->where('skill_mhs.mhs_id', $mhs->id)
                ->select('skill')->get();
        $data = Magang::leftJoin('lowongan', 'magang.lowongan_id', '=', 'lowongan.id')
        ->leftJoin('mitra', 'lowongan.mitra_id', '=', 'mitra.id')
        ->where('mhs_id', $mhs->id)
        ->first();
        $count = $this->countPengajuan();
        return view('depart.mhs.show', compact('mhs', 'data', 'count', 'skill'));
    }

    public function listMhs()
    {
        $depart = Departemen::where('user_id', Auth::id())->first();
        $mhs = Mahasiswa::where('depart_id', $depart->id)
        ->orderBy('nama_mhs', 'asc')
        ->get();
        $count = $this->countPengajuan();
        return view('depart.mhs.index', compact('mhs', 'count'));
    }
    
    public function departHome()
    {
        $depart = Departemen::where("user_id", Auth::id())->first();
        $count = $this->countPengajuan();
        $user = $this->countUser();
        $mitra = $this->countMitra();
        $spv = $this->countSpv();
        $dosen = $this->countDosen();
        $mhs = $this->countMhs();
        $mhsMag = $this->countMhsMagang();
        $blmMag = $this->countBelumMagang();
        return view('depart.home', compact('depart', 'count', 'user', 'mitra', 'spv', 'dosen', 'mhs', 'mhsMag', 'blmMag'));
    }

    public function countUser(){
        $data = User::all();
        return $data->count();
    }

    public function countMitra(){
        $data = User::where('role_id', '2')
        ->get();
        return $data->count();
    }

    public function countSpv(){
        $data = User::where('role_id', '4')
        ->get();
        return $data->count();
    }

    public function countDosen(){
        $data = User::where('role_id', '3')
        ->get();
        return $data->count();
    }

    public function countMhs(){
        $data = User::where('role_id', '5')
        ->get();
        return $data->count();
    }

    public function countMhsMagang(){
        $data = Mahasiswa::where('status_id', '2')
        ->get();
        return $data->count();
    }

    public function countBelumMagang(){
        $data = Mahasiswa::where('status_id', '1')
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
    public function show(Mahasiswa $mhs)
    {
        $data = Mahasiswa::find($mhs->id);
        return view('depart.mhs.detail', compact('data'));
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
