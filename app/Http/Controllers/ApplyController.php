<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Dosen;
use App\Models\Lowongan;
use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\Mitra;
use App\Models\SkillMhs;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplyController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function countPendaftar(){
        $data = Magang::whereNull('spv_id')
        ->get();
        return $data->count();
    }
    
    public function countPengajuan(){
        $data = Magang::whereNull('dosen_id')
        ->get();
        return $data->count();
    }

    public function score(Request $request, $id){
        $data = Magang::find($id);
        try {
            $data->update([
                'keterangan' => $request->keterangan,
                'nilai' => $request->nilai,
            ]);
            return redirect()->route('spv.penilaian')->with('success', 'Nilai berhasil ditambahkan!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Nilai gagal ditambahkan!');
        }
    }

    public function penilaian(){
        $data = Magang::join('mahasiswa', 'magang.mhs_id', '=', 'mahasiswa.id')
        ->join('lowongan', 'magang.lowongan_id', '=', 'lowongan.id')
        ->join('supervisor', 'magang.spv_id', '=', 'supervisor.id')
        ->where('supervisor.user_id', Auth::id())
        ->where('approval', '3')
        ->select('magang.*', 'magang.id as mag_id', 'supervisor.*', 'mahasiswa.*', 'lowongan.nama_low')
        ->get();
        return view('spv.penilaian.index', compact('data'));
    }

    public function diajukan(){
        $data = Magang::join('mahasiswa', 'magang.mhs_id', '=', 'mahasiswa.id')
        ->join('lowongan', 'magang.lowongan_id', '=', 'lowongan.id')
        ->where('mahasiswa.user_id', Auth::id())
        ->get();
        return view('mhs.ajukan.index', compact('data'));
    }

    public function detailMagang($id){
        $data = Magang::join('lowongan', 'magang.lowongan_id', '=', 'lowongan.id')
        ->select('lowongan.*', 'magang.id as magang_id', 'magang.*')
        ->find($id);

        $mhs = Mahasiswa::where('id', $data->mhs_id)->first();
        $skill = SkillMhs::join('skill', 'skill_mhs.skill_id', '=', 'skill.id')
                ->where('skill_mhs.mhs_id', $mhs->id)
                ->select('skill')->get();

        $todayDate = date("Y-m-d");
        $count = $this->countPendaftar();
        if (isset($data->approval) == '3'){
            $button = 'disabled';
        };
        return view('mitra.magang.show', compact('data', 'count', 'skill', 'mhs', 'todayDate', 'button'));
    }

    public function listMagang(){
        $data = Magang::join('mahasiswa', 'magang.mhs_id', '=', 'mahasiswa.id')
        ->join('lowongan', 'magang.lowongan_id', '=', 'lowongan.id')
        ->join('mitra', 'lowongan.mitra_id', '=', 'mitra.id')
        ->where('mitra.user_id', Auth::id())
        ->where('approval', '!=', '2')
        ->select('mahasiswa.*', 'lowongan.*', 'mitra.*', 'magang.id as magang_id', 'magang.*')
        ->get();
        $todayDate = date("Y-m-d");
        $count = $this->countPendaftar();
        return view('mitra.magang.index', compact('data', 'count', 'todayDate'));
    }

    public function listPendaftar(){
        $data = Magang::join('mahasiswa', 'magang.mhs_id', '=', 'mahasiswa.id')
        ->join('lowongan', 'magang.lowongan_id', '=', 'lowongan.id')
        ->join('mitra', 'lowongan.mitra_id', '=', 'mitra.id')
        ->where('mitra.user_id', Auth::id())
        ->where('approval', '0')
        ->select('mahasiswa.*', 'lowongan.*', 'mitra.*', 'magang.id as magang_id', 'magang.*')
        ->get();
        $count = $this->countPendaftar();
        return view('mitra.pendaftar.index', compact('data', 'count'));
    }
    
    public function pendaftar($id){
        $data = Magang::join('lowongan', 'magang.lowongan_id', '=', 'lowongan.id')
        ->select('lowongan.*', 'magang.id as magang_id', 'magang.*')
        ->find($id);

        $mhs = Mahasiswa::where('id', $data->mhs_id)->first();
        $skill = SkillMhs::join('skill', 'skill_mhs.skill_id', '=', 'skill.id')
                ->where('skill_mhs.mhs_id', $mhs->id)
                ->select('skill')->get();

        $mitra = Mitra::where('user_id', Auth::id())->first();
        $spv = Supervisor::where('mitra_id', $mitra->id)->get();

        $count = $this->countPendaftar();
        return view('mitra.pendaftar.edit', compact('data', 'spv', 'count', 'mhs', 'skill'));
    }

    public function listPengajuan(){
        $magang = Magang::whereNull('dosen_id')->get();
        $count = $this->countPengajuan();
        return view('depart.pengajuan.index', compact('magang', 'count'));
    }

    public function pengajuan($id){
        $data = Magang::join('lowongan as low', 'magang.lowongan_id', '=', 'low.id')
        ->join('mitra', 'low.mitra_id', '=', 'mitra.id')
        ->select('low.*','magang.id as magang_id', 'magang.*', 'mitra.nama_mitra')
        ->find($id);

        $mhs = Mahasiswa::where('id', $data->mhs_id)->first();
        $skill = SkillMhs::join('skill', 'skill_mhs.skill_id', '=', 'skill.id')
                ->where('skill_mhs.mhs_id', $mhs->id)
                ->select('skill')->get();

        $depart = Departemen::where('user_id', Auth::id())->first();
        $dosen = Dosen::where('depart_id', $depart->id)->get();

        $count = $this->countPengajuan();
        return view('depart.pengajuan.edit', compact('data', 'dosen', 'count', 'mhs', 'skill'));
    }

    public function apply($id){
        $idUserLogin = Auth::id();
        $mhs = Mahasiswa::where('user_id', $idUserLogin)->first();
        $skill = SkillMhs::join('skill', 'skill_mhs.skill_id', '=', 'skill.id')
                ->where('skill_mhs.mhs_id', $mhs->id)
                ->select('skill')->get();
        $low = Lowongan::find($id);
        $button = 'enable';
        if ($mhs->NIM == null || $mhs->telepon_mhs == null || $mhs->pengalaman == null || 
        $mhs->jurusan_id == null || $mhs->status_id == null || $mhs->jenis_kelamin == null || 
        $mhs->tgl_lahir == null || $mhs->foto_mhs == null){
            $button = 'disabled';
        };
        return view('lowongan.apply', compact('mhs', 'low', 'button', 'skill'));
    }

    public function detail($id){
        $low = Lowongan::join('mitra', 'lowongan.mitra_id', 'mitra.id')
        ->select('mitra.*', 'lowongan.*')
        ->find($id);

        $mhs = Mahasiswa::where('user_id', Auth::id())
        ->get();
        $button = 'enable';
        if (isset($mhs->status_id) == '2'){
            $button = 'disabled';
        };
        return view('lowongan.detail', compact('low', 'button'));
    }
    
    public function index()
    {
        $low = Lowongan::all();
        return view('welcome', compact('low'));
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
        try {
            $magang = new Magang();
            $magang->mhs_id = $request->mhs_id;
            $magang->lowongan_id = $request->lowongan_id;
            $magang->save();

            return redirect()->route('mahasiswa.home')->with('success', 'Lowongan berhasil diajukan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lowongan gagal diajukan!');
        }
    }

    public function updateDospem(Request $request, $id){
        $magang = Magang::find($id);
        try {
            $magang->update([
                'dosen_id' => $request->dosen_id,
            ]);
    
            $mhs = Mahasiswa::find($magang->mhs_id);
            $mhs->update([
                'status_id' => '4'
            ]);
            
            return redirect()->route('pengajuan.index')->with('success','Pengajuan berhasil diajukan!');
        } catch (\Exception $e){
            return redirect()->back()->with('error','Pengajuan gagal diajukan!');
        }
    }

    public function approve($id){
        $magang = Magang::find($id);
        $magang->update([
            'approval' => '1'
        ]);
        return redirect()->route('pendaftar.index');
    }

    public function reject($id){
        $magang = Magang::find($id);
        $magang->update([
            'approval' => '0'
        ]);
        return redirect()->route('pendaftar.index');
    }
    
    public function approval(Request $request, $id){
        $magang = Magang::find($id);
        try {
            $magang->update([
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'spv_id' => $request->spv_id,
            ]);
    
            if($request->action == "approve"){
                $this->approve($id);
                $mhs = Mahasiswa::find($magang->mhs_id);
                $mhs->update([
                    'status_id' => '2'
                ]);
    
                $low = Lowongan::find($magang->lowongan_id);
                $jumlah = $low->jumlah_mhs -= 1;
                $low->update([
                    'jumlah_mhs' => $jumlah
                ]);
    
                $mgn = Magang::where('mhs_id', $mhs->id)
                ->where('id', '!=', $magang->id);
                $mgn->update([
                    'approval' => '2'
                ]);
            } else {
                $this->reject($id);
            }
            return redirect()->route('pendaftar.index')->with('success','Mahasiswa berhasil diterima!');
        } catch (\Exception $e){
            return redirect()->back()->with('error','Ada kolom yang belum diisi!');
        }
    }

    public function end($id){
        $magang = Magang::find($id);

        try {
            $magang->update([
                'approval' => '3'
            ]);
    
            $mhs = Mahasiswa::find($magang->mhs_id);
            $mhs->update([
                'status_id' => '3'
            ]);
    
            return redirect()->route('magang.index')->with('success','Magang berhasil diakhiri!');
        } catch (\Exception $e){
            return redirect()->back()->with('error','Magang gagal diakhiri!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lowongan $lowongan)
    {
        return view('lowongan.detail', compact('lowongan'));
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
