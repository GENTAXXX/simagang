<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departemen;
use App\Models\Mahasiswa;
use App\Models\Magang;
use App\Models\SkillMhs;
use Illuminate\Support\Facades\Auth;

class DepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $data = Magang::join('lowongan', 'magang.lowongan_id', '=', 'lowongan.id')
        ->where('mhs_id', $mhs->id)
        ->first();
        // dd($data);
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
        return view('depart.home', compact('depart', 'count'));
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
