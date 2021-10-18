<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Kategori;
use App\Models\Mitra;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mitraLayout(){
        $mitra = Mitra::where('user_id', Auth::id())->first();
        return $mitra->foto_mitra;
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
        $mitraId = Mitra::where("user_id", $idUserLogin)->first();
        $low = Lowongan::where("mitra_id", $mitraId->id)->get();
        $mitra = $this->mitraLayout();
        return view('mitra.lowongan.index', compact('low', 'mitra'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        $mitraId = Mitra::where('user_id', Auth::id())->first();
        $mitra = $this->mitraLayout();
        return view('mitra.lowongan.create', compact('mitraId', 'kategori', 'mitra'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

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
        $mitraId = Mitra::where('user_id', Auth::id())->first();
        $mitra = $this->mitraLayout();
        return view('mitra.lowongan.edit', compact('low', 'kategori', 'mitraId', 'mitra'));
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
        $validator = Validator::make($request->all(), [
            'nama_low' => 'required',
            'deskripsi_low' => 'required',
            'telepon_low' => 'required',
            'jumlah_mhs' => 'required',
            'durasi' => 'required',
            'mitra_id' => 'required',
            'kategori_id' => 'required',
            'lokasi' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

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
    public function destroy($id)
    {
       
        $low = Lowongan::find($id);

        if(!isset($low)){
            return redirect()->back()->with('error', 'Lowongan tidak ada');
        }
        $low->delete();
        return redirect()->back()->with('success', 'Lowongan berhasil dihapus!');
        
    }
}
