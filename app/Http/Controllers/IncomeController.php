<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $incomes = Income::where('name', 'LIKE', '%' . $request->search . '%')
        ->orderBy('name', 'ASC')
        ->simplePaginate(5);
        return view('income.index', compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('income.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate(
            [
                'jenis' => 'required',
                'name' => 'required',
                'jumlah' => 'required',
            ],
            [
                'jenis.required' => 'Jenis harus diisi',
                'name.required' => 'Nama harus diisi',
                'jumlah.required' => 'Jumlah harus diisi',
            ]
        );
    
        // Bersihkan format rupiah dari input jumlah
        $jumlah = str_replace(['Rp ', '.'], '', $request->jumlah);
    
        // Simpan data ke database
        $proses = Income::create([
            'jenis' => $request->jenis,
            'name' => $request->name,
            'jumlah' => $jumlah, // Simpan jumlah yang sudah dibersihkan
        ]);
    
        // Cek apakah data berhasil disimpan
        if ($proses) {
            return redirect()->route('income')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('income.add')->with('failed', 'Gagal menambahkan data');
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $income = Income::where('id', $id)->first();
        return view('income.edit', compact('income'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'jenis' => 'required',
                'name' => 'required',
                'jumlah' => 'required|numeric',
            ],
            [
                'jenis.required' => 'Jenis pengeluaran harus diisi',
                'name.required' => 'Nama harus diisi',
                'jumlah.required' => 'Jumlah harus diisi',
                'jumlah.numeric' => 'Jumlah harus berupa angka',
            ]
        );

        $IncomeBefore = Income::where('id', $id)->first();

        $proses =$IncomeBefore->update([
            'jenis' => $request->jenis,
            'name' => $request->name,
            'jumlah' => $request->jumlah,
        ]);

        if ($proses) {
            return redirect()->route('income')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('income.edit', $id)->with('failed', 'Gagal mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $proses = Income::where('id', $id)->delete();
        if ($proses) {
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('failed', 'Gagal menghapus data');
        }
    }
}
