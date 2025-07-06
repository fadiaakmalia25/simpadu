<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ['nama' => "Fadia", 'foto' => 'fadia.jpg'];
        $prodi = Prodi::all();
        return view('prodi.index', compact('data', 'prodi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = ['nama' => "Fadia", 'foto' => 'fadia.jpg'];
        return view('prodi.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:100',
            'kaprodi' => 'required|max:100',
            'jurusan' => 'required|max:100',
        ], [
            'nama.required' => 'Nama prodi wajib diisi',
            'kaprodi.required' => 'Nama kaprodi wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
        ]);

        Prodi::create($validatedData);
        return redirect('/prodi');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = ['nama' => "Fadia", 'foto' => 'fadia.jpg'];
        $prodi = Prodi::findOrFail($id);
        return view('prodi.edit', compact('data', 'prodi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'kaprodi' => 'required',
            'jurusan' => 'required',
        ], [
            'nama.required' => 'Nama prodi wajib diisi',
            'kaprodi.required' => 'Nama kaprodi wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->update($validatedData);

        return redirect('/prodi')->with('success', 'Data prodi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prodi = Prodi::findorFail($id);
        $prodi->delete($id);
        return redirect('/prodi');
    }
}
