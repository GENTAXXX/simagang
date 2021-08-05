<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Kabupaten;
use App\Models\Mahasiswa;
use App\Models\Mitra;
use App\Models\Skill;
use App\Models\SkillMhs;
use App\Models\Supervisor;
use App\Models\User;
use App\Models\Magang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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

    public function countPendaftar(){
        $data = Magang::whereNull('spv_id')
        ->whereNotNull('dosen_id')
        ->get();
        return $data->count();
    }
    public function index()
    {
        $idUserLogin = Auth::id();
        $user = User::where("id", $idUserLogin)->first();
        switch ($user->role_id) {
            case '1':
                $depart = Departemen::where("user_id", $idUserLogin)->first();
                $count = $this->countPengajuan();
                return view('depart.profile.index', compact('depart', 'count'));
                break;
            case '2':
                $mitra = Mitra::where("user_id", $idUserLogin)->first();
                $count = $this->countPendaftar();
                return view('mitra.profile.index', compact('mitra', 'count'));
                break;
            case '3':
                $dosen = Dosen::where("user_id", $idUserLogin)->first();
                return view('dosen.profile.index', compact('dosen'));
                break;
            case '4':
                $spv = Supervisor::where("user_id", $idUserLogin)->first();
                return view('spv.profile.index', compact('spv'));
                break;
            case '5':
                $mhs = Mahasiswa::where("user_id", $idUserLogin)->first();
                // dd($mhs);
                $skill = SkillMhs::join('skill', 'skill_mhs.skill_id', '=', 'skill.id')
                ->where('skill_mhs.mhs_id', $mhs->id)
                ->select('skill')->get();
                
                return view('mhs.profile.index', compact('mhs', 'skill'));
                break;
        };
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
        $idUserLogin = Auth::id();
        $user = User::where("id", $idUserLogin)->first();
        switch ($user->role_id) {
            case '1':
                $depart = Departemen::where("user_id", $idUserLogin)->first();
                $count = $this->countPengajuan();
                return view('depart.profile.edit', compact('depart', 'count'));
                break;
            case '2':
                $mitra = Mitra::where("user_id", $idUserLogin)->first();
                $kabupatens = Kabupaten::all();
                $count = $this->countPendaftar();
                return view('mitra.profile.edit', compact('mitra', 'kabupatens', 'count'));
                break;
            case '3':
                $dosen = Dosen::where("user_id", $idUserLogin)->first();
                $depart = Departemen::all();
                return view('dosen.profile.edit', compact('dosen', 'depart'));
                break;
            case '4':
                $spv = Supervisor::where("user_id", $idUserLogin)->first();
                $mitra = Mitra::all();
                return view('spv.profile.edit', compact('spv', 'mitra'));
                break;
            case '5':
                $mhs = Mahasiswa::where("user_id", $idUserLogin)->first();
                $jurusan = Jurusan::all();
                $skill = Skill::all();
                $gender = ['Laki-laki','Perempuan'];
                $depart = Departemen::all();
                return view('mhs.profile.edit', compact('mhs', 'jurusan', 'skill', 'gender', 'depart'));
                break;
        };
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
        $idUserLogin = Auth::id();
        $user = $request->user();
        switch ($user->role_id) {
            case '1':
                $depart = Departemen::where("user_id", $idUserLogin)->first();
                $request->validate([
                    'nama_depart' => 'required',
                    'alamat_depart' => 'required',
                    'telepon_depart' => 'required',
                    'NIDN' => 'required',
                    'foto_depart' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $imageName = $request->nama_depart . '.' . $request->foto_depart->extension();
                $request->foto_depart->move(public_path('images'), $imageName);

                try {
                    $depart->update([
                        'nama_depart' => $request->nama_depart,
                        'alamat_depart' => $request->alamat_depart,
                        'telepon_depart' => $request->telepon_depart,
                        'NIDN' => $request->NIDN,
                        'foto_depart' => $imageName,
                    ]);
    
                    $user = User::where('id', Auth::id())->first();
                    $user->update([
                        'name' => $request->nama_depart
                    ]);
                    return redirect()->route('profile.index')->with('success', 'Profle berhasil diubah!');
                    break;
                } catch (\Exception $e){
                    return redirect()->back()->with('error', 'Profle gagal diubah!');
                    break;
                }
            case '2':
                $mitra = Mitra::where("user_id", $idUserLogin)->first();
                $request->validate([
                    'nama_mitra' => 'required',
                    'alamat_mitra' => 'required',
                    'telepon_mitra' => 'required',
                    'fax_mitra' => 'required',
                    'foto_mitra' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'kab_id' => 'required',
                ]);

                $imageName = $request->nama_mitra . '.' . $request->foto_mitra->extension();
                $request->foto_mitra->move(public_path('images'), $imageName);

                try {
                    $mitra->update([
                        'nama_mitra' => $request->nama_mitra,
                        'alamat_mitra' => $request->alamat_mitra,
                        'fax_mitra' => $request->fax_mitra,
                        'telepon_mitra' => $request->telepon_mitra,
                        'kab_id' => $request->kab_id,
                        'foto_mitra' => $imageName,
                    ]);
    
                    $user = User::where('id', Auth::id())->first();
                    $user->update([
                        'name' => $request->nama_mitra
                    ]);
                    return redirect()->route('profile.index')-with('success', 'Profle berhasil diubah!');
                    break;
                } catch (\Exception $e){
                    return redirect()->back()->with('error', 'Profle gagal diubah!');
                    break;
                }
            case '3':
                $dosen = Dosen::where("user_id", $idUserLogin)->first();
                $request->validate([
                    'nama_dosen' => 'required',
                    'telepon_dosen' => 'required',
                    'NIP' => 'required',
                    'foto_dosen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'depart_id' => 'required',
                ]);

                $imageName = $request->nama_dosen . '.' . $request->foto_dosen->extension();
                $request->foto_dosen->move(public_path('images'), $imageName);

                try {
                    $dosen->update([
                        'nama_dosen' => $request->nama_dosen,
                        'telepon_dosen' => $request->telepon_dosen,
                        'NIP' => $request->NIP,
                        'depart_id' => $request->depart_id,
                        'foto_dosen' => $imageName,
                    ]);
    
                    $user = User::where('id', Auth::id())->first();
                    $user->update([
                        'name' => $request->nama_dosen
                    ]);
                    return redirect()->route('profile.index')-with('success', 'Profle berhasil diubah!');
                    break;
                } catch (\Exception $e){
                    return redirect()->back()->with('error', 'Profle gagal diubah!');
                    break;
                }
            case '4':
                $spv = Supervisor::where("user_id", $idUserLogin)->first();
                $request->validate([
                    'nama_spv' => 'required',
                    'telepon_spv' => 'required',
                    'no_pegawai' => 'required',
                    'foto_spv' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'mitra_id' => 'required',
                ]);

                $imageName = $request->nama_spv . '.' . $request->foto_spv->extension();
                $request->foto_spv->move(public_path('images'), $imageName);

                try {
                    $spv->update([
                        'nama_spv' => $request->nama_spv,
                        'telepon_spv' => $request->telepon_spv,
                        'no_pegawai' => $request->no_pegawai,
                        'mitra_id' => $request->mitra_id,
                        'foto_spv' => $imageName,
                    ]);
    
                    $user = User::where('id', Auth::id())->first();
                    $user->update([
                        'name' => $request->nama_spv
                    ]);
                    return redirect()->route('profile.index')-with('success', 'Profle berhasil diubah!');
                    break;
                } catch (\Exception $e){
                    return redirect()->back()->with('error', 'Profle gagal diubah!');
                    break;
                }
            case '5':
                $mhs = Mahasiswa::where("user_id", $idUserLogin)->first();
                $request->validate([
                    'nama_mhs' => 'required',
                    'NIM' => 'required',
                    'telepon_mhs' => 'required',
                    'pengalaman' => 'required',
                    'jurusan_id' => 'required',
                    'jenis_kelamin' => 'required',
                    'tgl_lahir' => 'required',
                    'foto_mhs' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'depart_id' => 'required'
                ]);

                foreach ($request->skill_id as $skill){
                    // dd($skill);
                    SkillMhs::create([
                        'skill_id' => $skill,
                        'mhs_id' => $mhs->id
                    ]);
                }

                $imageName = $request->nama_mhs . '.' . $request->foto_mhs->extension();
                $request->foto_mhs->move(public_path('images'), $imageName);
                
                try {
                    $mhs->update([
                        'nama_mhs' => $request->nama_mhs,
                        'NIM' => $request->NIM,
                        'telepon_mhs' => $request->telepon_mhs,
                        'pengalaman' => $request->pengalaman,
                        'jurusan_id' => $request->jurusan_id,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'tgl_lahir' => $request->tgl_lahir,
                        'foto_mhs' => $imageName,
                        'depart_id' => $request->depart_id
                    ]);
    
                    $user = User::where('id', Auth::id())->first();
                    $user->update([
                        'name' => $request->nama_mhs
                    ]);
                    return redirect()->route('profile.index')-with('success', 'Profle berhasil diubah!');
                    break;
                } catch (\Exception $e){
                    return redirect()->back()->with('error', 'Profle gagal diubah!');
                    break;
                }
        }
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
