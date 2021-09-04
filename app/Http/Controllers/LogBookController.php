<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\Lowongan;
use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\SkillMhs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class LogBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function print(){
        $logs = Logbook::join('magang', 'logbook.magang_id', '=', 'magang.id')
        ->join('mahasiswa', 'magang.mhs_id', '=', 'mahasiswa.id')
        ->where('mahasiswa.user_id', Auth::id())
        ->get();
        $pdf = PDF::loadView('mhs.logbook.print', compact('logs'));
        return $pdf->download('Logbook.pdf');
    }

    public function logbookDetail($id){
        $mhs = Mahasiswa::find($id);
        $data = Logbook::join('magang', 'logbook.magang_id', '=', 'magang.id')
        ->where('magang.mhs_id', $mhs->id)->get();
        $skill = SkillMhs::join('skill', 'skill_mhs.skill_id', '=', 'skill.id')
        ->where('skill_mhs.mhs_id', $mhs->id)
        ->select('skill')->get();
        return view('spv.logbook.show', compact('data', 'mhs', 'skill'));
    }

    public function mhsLogbook(){
        $data = Mahasiswa::join('magang', 'mahasiswa.id', '=', 'magang.mhs_id')
        ->join('lowongan', 'magang.lowongan_id', '=', 'lowongan.id')
        ->join('supervisor', 'magang.spv_id', '=', 'supervisor.id')
        ->where('supervisor.user_id', Auth::id())
        ->where('magang.approval', '!=', '2')
        ->select('mahasiswa.id as mhs_id', 'mahasiswa.*', 'lowongan.*', 'supervisor.*', 'magang.approval')
        ->orderBy('magang.approval', 'asc')
        ->get();
        return view('spv.logbook.index', compact('data'));
    }

    public function index()
    {
        $low = Lowongan::join('magang', 'lowongan.id', '=', 'magang.lowongan_id')
        ->join('mahasiswa', 'magang.mhs_id', '=', 'mahasiswa.id')
        ->where('mahasiswa.user_id', Auth::id())
        ->first();
        $logs = Logbook::join('magang', 'logbook.magang_id', '=', 'magang.id')
        ->join('mahasiswa', 'magang.mhs_id', '=', 'mahasiswa.id')
        ->where('mahasiswa.user_id', Auth::id())
        ->get();
        return view('mhs.logbook.index', compact('logs', 'low'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mhs.logbook.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $magang = Magang::join('mahasiswa', 'magang.mhs_id', '=', 'mahasiswa.id')
        ->where('mahasiswa.user_id', Auth::id())
        ->select('magang.id as mag_id', 'magang.*', 'mahasiswa.*')
        ->first();

        $request->validate([
            'tanggal' => 'required',
            'kegiatan' => 'required',
            'deskripsi_log' => 'required',
            'saran' =>'required',
        ]);

        try {
            Logbook::create([
                'tanggal' => $request->tanggal,
                'kegiatan' => $request->kegiatan,
                'deskripsi_log' => $request->deskripsi_log,
                'saran' => $request->saran,
                'magang_id' => $magang->mag_id,
            ]);
            return redirect()->back()->with('success', 'Aktivitas berhasil ditambahkan!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Aktivitas gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $log = Logbook::find($id);
        return view('mhs.logbook.show', compact('log'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $log = Logbook::find($id);
        return view('mhs.logbook.edit', compact('log'));
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
        $request->validate([
            'tanggal' => 'required',
            'kegiatan' => 'required',
            'deskripsi_log' => 'required',
            'saran' =>'required',
        ]);

        $log = Logbook::find($id);
        $log->update($request->all());
        return redirect()->route('logbook.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $log = Logbook::find($id);
        $log->delete();

        return redirect()->route('bimbingan.index');
    }
}
