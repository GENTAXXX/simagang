<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Mitra;
use App\Models\Role;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Magang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function departLayout(){
        $depart = Departemen::where('user_id', Auth::id())->first();
        return $depart->foto_depart;
    }

    public function index()
    {
        $user = User::orderBy('role_id', 'asc')->get();
        $depart = $this->departLayout();
        return view('depart.user.index', compact('user', 'depart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();
        $depart = $this->departLayout();
        return view('depart.user.create', compact('role', 'depart'));
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
            'name' => 'required',
            'role_id' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $request = new Request($request->all());

        $request->merge([
            'password' => Hash::make($request->password)
        ]);

        $depart = Departemen::where('user_id', Auth::id())
        ->first();

        $user = User::create($request->all());
        switch ($user->role_id) {
            case '1':
                Departemen::create([
                    'user_id' => $user['id'],
                    'nama_depart' => $user['name'],
                ]);
                break;
            case '2':
                Mitra::create([
                    'user_id' => $user['id'],
                    'nama_mitra' => $user['name'],
                ]);
                break;
            case '3':
                Dosen::create([
                    'user_id' => $user['id'],
                    'nama_dosen' => $user['name'],
                    'depart_id' => $depart->id,
                ]);
                break;
            case '4':
                Supervisor::create([
                    'user_id' => $user['id'],
                    'nama_spv' => $user['name'],
                ]);
                break;
            case '5':
                Mahasiswa::create([
                    'user_id' => $user['id'],
                    'nama_mhs' => $user['name'],
                    'depart_id' => $depart->id,
                ]);
                break;
        }
        return redirect()->route('users.index')->with('success','Akun berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $result = User::find($user->id);

        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
        // return view('lowongan.show', compact('lowongan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = User::find($user->id);
        $role = Role::all();
        $depart = $this->departLayout();
        return view('depart.user.edit', compact('user', 'role', 'depart'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'role_id' => 'required',
            'email' => 'required',
        ]);
        
        $user->update($request->all());
        switch ($user->role_id) {
            case '1':
                $depart = Departemen::where('user_id', $user->id)->first();
                $depart->update([
                    'nama_depart' => $user['name'],
                ]);
                break;
            case '2':
                $mitra = Mitra::where('user_id', $user->id)->first();
                $mitra->update([
                    'nama_mitra' => $user['name'],
                ]);
                break;
            case '3':
                $dosen = Dosen::where('user_id', $user->id)->first();
                $dosen->update([
                    'nama_dosen' => $user['name'],
                ]);
                break;
            case '4':
                $spv = Supervisor::where('user_id', $user->id)->first();
                $spv->update([
                    'nama_spv' => $user['name'],
                ]);
                break;
            case '5':
                $mhs = Mahasiswa::where('user_id', $user->id)->first();
                $mhs->update([
                    'nama_mhs' => $user['name'],
                ]);
                break;
        }
        return redirect()->route('users.index')->with('success', 'Akun berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if(!isset($user)){
            return redirect()->back()->with('error', 'User tidak ada');
        }
        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus!');
    }
}
