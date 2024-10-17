<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use Illuminate\Http\Request;

class CostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $costs = Cost::where('name', 'LIKE', '%' . $request->search . '%')
            ->orderBy('name', 'ASC')
            ->simplePaginate(5);

        //compact : mengirim data ke blade
        return view('table.index', compact('costs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('table.add'); // Perbaiki path view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'jenis' => 'required',
                'name' => 'required',
                'jumlah' => 'required',
            ],
            [
                'jenis.required' => 'Jenis harus diisi',
                'name.required' => 'Nama diisi',
                'jumlah.required' => 'Jumlah harus diisi',
            ]
        );

        $proses = Cost::create([
            'jenis' => $request->jenis,
            'name' => $request->name,
            'jumlah' => $request->jumlah
        ]);

        if ($proses) {
            return redirect()->route('cost')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('table.add')->with('failed', 'Gagal mengambil data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cost $cost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cost = Cost::where('id', $id)->first();
        return view('table.edit', compact('cost'));
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

        $CostBefore = Cost::where('id', $id)->first();

        $proses =$CostBefore->update([
            'jenis' => $request->jenis,
            'name' => $request->name,
            'jumlah' => $request->jumlah,
        ]);

        if ($proses) {
            return redirect()->route('cost')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('cost.edit', $id)->with('failed', 'Gagal mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proses = Cost::where('id', $id)->delete();
        if ($proses) {
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('failed', 'Gagal menghapus data');
        }
    }
}
