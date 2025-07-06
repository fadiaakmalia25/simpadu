<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = ['nama' => "Fadia", 'foto' => 'fadia.jpg'];
        $mahasiswa = Mahasiswa::with('prodi')->get();
        return view('mahasiswa.index', compact('data', 'mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data = ['nama' => "Fadia", 'foto' => 'fadia.jpg'];
        $prodi = Prodi::all();
        return view('mahasiswa.create', compact('data', 'prodi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nim' => 'required|unique:mahasiswa|max:10',
                'password' => 'required',
                'nama' => 'required|max:100',
                'tanggallahir' => 'required',
                'telp' => 'required|max:20',
                'email' => 'required|max:100',
                'foto' => 'image|file|max:2048'
            ],
            [
                'nim.required' => 'NIM harus diisi',
                'nim.unique' => 'NIM sudah terdaftar',
                'nim.max' => 'NIM maksimal 10 karakter',
                'password.required' => 'password wajib diisi'
            ]
        );
        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('images');
        }
        $validatedData['password'] = Hash::make($validatedData['password']);
        $data = array_merge($validatedData,$request->only(['id']));
        Mahasiswa::create($data);
        return redirect('/mahasiswa');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = ['nama' => "Fadia", 'foto' => 'fadia.jpg'];
        $mahasiswa = Mahasiswa::find($id);
        $prodi = prodi::all();
        return view('mahasiswa.edit', compact('data', 'mahasiswa', 'prodi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate(
            [
                'nama' => 'required|max:100',
                'tanggallahir' => 'required',
                'telp' => 'required|max:20',
                'email' => 'required|max:100',
                'foto' => 'image|file|max:2048'
            ],
            [
                'nama.required' => 'Nama harus diisi',
                'tanggallahir.required' => 'tanggallahir harus diisi',
                'telp.required' => 'telp harus diisi',
                'email.required' => 'email harus diisi',
                'foto' => 'File harus berupa gambar'
            ]
        );
        $mahasiswa = Mahasiswa::Find($id);
        if ($request->file('foto')) {
            if($mahasiswa->foto){
                storage::delete('images/'. $mahasiswa->foto);
            }
            $filePath = $request->file('foto')->store('images');
            $validatedData['foto'] = basename($filePath);
        }
        if ($request->input('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }
        $data = array_merge($validatedData, $request->only(['id']));
        Mahasiswa::where('nim', $id)->update($data);
        return redirect('/mahasiswa');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if ($mahasiswa->foto) {
            Storage::delete($mahasiswa->foto);
        }
        Mahasiswa::destroy($id);
        return redirect('/mahasiswa');
    }
}
