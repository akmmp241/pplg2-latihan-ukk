<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Database\UniqueConstraintViolationException;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SiswaController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware(
                AdminMiddleware::class, 
                only: ['edit', 'update', 'destroy']
            ),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query("search");
        $class = $request->query("kelas");

        $allSiswa = Siswa::query();

        if ($search != null) {
            $allSiswa = $allSiswa->where('nama', 'like', "%$search%")
                ->orWhere('nis', 'like', "%$search%")
                ->orWhere('kelas', 'like', "%$search%");
        }

        if ($class != null) {
            $allSiswa = $allSiswa->where('kelas', $class);
        }

        $allSiswa = $allSiswa->get();

        $classes = Siswa::select('kelas')->distinct()->get();

        return view('siswa.index', compact('allSiswa', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        $request->validate([
            "nis" => "required|numeric",
            "name" => "required|regex:/^[\pL\s]+$/u",
            "class" => "required|alpha_num",
            "address" => "required"
        ]);

        $siswa = Siswa::where('nis', $request->nis)->first();

        if ($siswa != null) {
            return redirect()->back()->with([
                'message' => 'NIS sudah terdaftar'
            ]);
        }

        // process data
        Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->name,
            'kelas' => $request->class,
            'alamat' => $request->address
        ]);

        return redirect()->route('siswa.index')->with([
            'success' => 'User baru telah ditambahkan'
        ]);
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
        $siswa = Siswa::where('nis', $id)->firstOrFail();

        return view('siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate request
        $request->validate([
            "nis" => "required|numeric",
            "name" => "required|regex:/^[\pL\s]+$/u",
            "class" => "required|alpha_num",
            "address" => "required"
        ]);

        // process data
        try {
            Siswa::where('nis', $id)->update([
                'nis' => $request->nis,
                'nama' => $request->name,
                'kelas' => $request->class,
                'alamat' => $request->address
            ]);
        } catch (UniqueConstraintViolationException) {
            return redirect()->back()->with([
                'message' => 'NIS sudah terdaftar'
            ]);
        }

        return redirect()->route('siswa.index')->with([
            'success' => 'berhasil mengubah data'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // process data
        Siswa::where('nis', $id)->delete();

        return redirect()->back()->with([
            'success' => 'berhasil menghapus data'
        ]);
    }
}
