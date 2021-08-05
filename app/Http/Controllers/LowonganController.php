<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Kategori;
use App\Models\Mitra;
use App\Models\Magang;
use Illuminate\Support\Facades\Auth;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function countPendaftar(){
        $data = Magang::where('spv_id', null)->get();
        return $data->count();
    }

    public function AllLowongan(Request $request){
        $cari = $request->cari;
        $low = Lowongan::where('jumlah_mhs', '>', 0)
        ->where('nama_low','like','%'.$cari.'%')
        ->paginate();
        return view('welcome', compact('low'));
    }

    public function index()
    {
        $idUserLogin = Auth::id();
        $mitra = Mitra::where("user_id", $idUserLogin)->first();
        $low = Lowongan::where("mitra_id", $mitra->id)->get();
        $count = $this->countPendaftar();
        return view('mitra.lowongan.index', compact('low', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        $mitra = Mitra::all();
        $count = $this->countPendaftar();
        return view('mitra.lowongan.create', compact('mitra', 'kategori', 'count'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_low' => 'required',
            'deskripsi_low' => 'required',
            'telepon_low' => 'required',
            'jumlah_mhs' => 'required',
            'durasi' => 'required',
            'mitra_id' => 'required',
            'kategori_id' => 'required',
            'lokasi' => 'required',
            'foto_low' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = $request->nama_low . '.' . $request->foto_low->extension();
        $request->foto_low->move(public_path('images'), $imageName);

        $mitra = Mitra::where('user_id', Auth::id())->first();

        try {
            Lowongan::create([
                'nama_low' => $request->nama_low,
                'deskripsi_low' => $request->deskripsi_low,
                'telepon_low' => $request->telepon_low,
                'jumlah_mhs' => $request->jumlah_mhs,
                'durasi' => $request->durasi,
                'mitra_id' => $mitra->id,
                'kategori_id' => $request->kategori_id,
                'lokasi' => $request->lokasi,
                'foto_low' => $imageName,
            ]);
            return redirect()->route('lowongan.index')->with('success','Lowongan berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error','Lowongan gagal dibuat!');
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
        return view('mitra.lowongan.detail', compact('lowongan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lowongan $lowongan)
    {
        $low = Lowongan::find($lowongan->id);
        $kategori = Kategori::all();
        $mitra = Mitra::all();
        $count = $this->countPendaftar();
        return view('mitra.lowongan.edit', compact('low', 'kategori', 'mitra', 'count'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lowongan $lowongan)
    {
        $request->validate([
            'nama_low' => 'required',
            'deskripsi_low' => 'required',
            'telepon_low' => 'required',
            'jumlah_mhs' => 'required',
            'durasi' => 'required',
            'mitra_id' => 'required',
            'kategori_id' => 'required',
            'lokasi' => 'required',
            'foto_low' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = $request->nama_low . '.' . $request->foto_low->extension();
        $request->foto_low->move(public_path('images'), $imageName);

        try {
            $lowongan->update($request->all());
            return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil diubah!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Lowongan gagal diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lowongan $lowongan)
    {
        $lowongan = Lowongan::find($lowongan->id);
        try {
            $lowongan->delete();

            return redirect()->back()->with('success', 'Lowongan berhasil dihapus!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Lowongan gagal dihapus!');
        }
    }
}
