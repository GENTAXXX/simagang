<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Magang;
use App\Models\Lowongan;
use App\Models\SkillMhs;
use Illuminate\Support\Facades\Validator;

class BimbinganController extends Controller
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

    public function mhsLayout(){
        $mhs = Mahasiswa::where('user_id', Auth::id())->first();
        return $mhs->foto_mhs;
    }
    
    public function feedbackBimbingan(Request $request, $id){
        $bim = Bimbingan::find($id);
        try {
            $bim->update([
                'feedback' => $request->feedback
            ]);
            return redirect()->route('dospem.bimbingan', $request->mhs_id)->with('success', 'Feedback berhasil ditambahkan!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Feedback gagal ditambahkan!');
        }
    }

    public function bimbinganDetail($id){
        $mhs = Mahasiswa::find($id);
        $data = Bimbingan::join('magang', 'bimbingan.magang_id', '=', 'magang.id')
        ->where('magang.mhs_id', $mhs->id)
        ->select('bimbingan.*', 'magang.*', 'bimbingan.id as bim_id')
        ->get();
        $mag = Magang::join('lowongan', 'magang.lowongan_id', '=', 'lowongan.id')
        ->join('mitra', 'lowongan.mitra_id', '=', 'mitra.id')
        ->join('mahasiswa', 'magang.mhs_id', '=', 'mahasiswa.id')
        ->join('status', 'mahasiswa.status_id', '=', 'status.id')
        ->where('magang.mhs_id', $id)
        ->first();
        $skill = SkillMhs::join('skill', 'skill_mhs.skill_id', '=', 'skill.id')
        ->where('skill_mhs.mhs_id', $mhs->id)
        ->select('skill')->get();
        $dosen = $this->dospemLayout();
        return view('dosen.bimbingan.edit', compact('data', 'mhs', 'mag', 'skill', 'dosen'));
    }

    public function mhsBimbingan(){
        $data = Mahasiswa::join('magang', 'mahasiswa.id', '=', 'magang.mhs_id')
        ->leftJoin('bimbingan', 'magang.id', '=', 'bimbingan.magang_id')
        ->join('dosen', 'magang.dosen_id', '=', 'dosen.id')
        ->where('dosen.user_id', Auth::id())
        ->where('magang.approval', '!=', '2')
        ->select('mahasiswa.*', 'magang.*', 'dosen.*', 'mahasiswa.id as mhs_id', 'bimbingan.*')
        ->orderBy('magang.approval', 'asc')
        ->groupBy('mahasiswa.nama_mhs')
        ->get();
        $arrFeedback = array();
        foreach($data as $d){
            if(isset($d->catatan) && isset($d->feedback) && isset($d->tgl_bimbingan)) 
            $arrFeedback[$d->mhs_id] = $d->feedback;
            if(!isset($d->catatan) && !isset($d->feedback) && !isset($d->tgl_bimbingan)) 
            $arrFeedback[$d->mhs_id] = "Belum ada bimbingan";
        }
        $dosen = $this->dospemLayout();
        return view('dosen.bimbingan.index', compact('data', 'arrFeedback', 'dosen'));
    }

    public function index()
    {
        $low = Lowongan::join('magang', 'lowongan.id', '=', 'magang.lowongan_id')
        ->join('mahasiswa', 'magang.mhs_id', '=', 'mahasiswa.id')
        ->join('dosen', 'magang.dosen_id', '=', 'dosen.id')
        ->where('mahasiswa.user_id', Auth::id())
        ->first();
        $bimbingan = Bimbingan::join('magang', 'bimbingan.magang_id', '=', 'magang.id')
        ->join('mahasiswa', 'magang.mhs_id', '=', 'mahasiswa.id')
        ->where('mahasiswa.user_id', Auth::id())
        ->orderBy('tgl_bimbingan', 'asc')
        ->get();
        $mhs = $this->mhsLayout();
        return view('mhs.bimbingan.index', compact('bimbingan', 'low', 'mhs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mhs.bimbingan.create');
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

        $validator = Validator::make($request->all(), [
            'catatan' => 'required',
            'tgl_bimbingan' => 'required',
            'file' => 'required',
        ]);

        $fileName = 'Bimbingan' . $request->tgl_bimbingan . time() . '.' . $request->file->extension();
        $request->file->move(public_path('file'), $fileName);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            Bimbingan::create([
                'catatan' => $request->catatan,
                'tgl_bimbingan' => $request->tgl_bimbingan,
                'file' => $fileName,
                'magang_id' => $magang->mag_id,
            ]);
            return redirect()->back()->with('success', 'Bimbingan berhasil ditambahkan!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Bimbingan gagal ditambahkan!');
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
        $bimbingan = Bimbingan::find($id);
        return view('mhs.bimbingan.show', compact('bimbingan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bimbingan = Bimbingan::find($id);
        return view('mhs.bimbingan.edit', compact('bimbingan'));
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
            'catatan' => 'required',
            'tgl_bimbingan' => 'required',
            'mhs_id' => 'required',
            'dosen_id' =>'required'
        ]);

        $bimbingan = Bimbingan::find($id);
        $bimbingan->update($request->all());
        return redirect()->route('bimbingan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bimbingan = Bimbingan::find($id);
        $bimbingan->delete();

        return redirect()->route('bimbingan.index');
    }
}
