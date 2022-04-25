<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Produk;
use App\Models\Sortir;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SortirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $sortir = Sortir::all();

        return datatables()::of($sortir)
            ->addIndexColumn()
            ->addColumn('aksi', function ($sortir) {
                return '
                    <button onclick="editform(`' . route('sortir.update', $sortir->id_sortir) . '`)" class="btn btn-info btn-xs">Edit</button>
                    <button onclick="deleteform(`' . route('sortir.destroy', $sortir->id_sortir) . '`)" class="btn btn-danger btn-xs">Hapus</button>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function index()
    {
        $produks = Produk::all();
        $suppliers = Supplier::all();
        return view('sortir.index', compact('produks', 'suppliers'));
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
        $i_kd_produk = $request->input('kd_produk');
        $i_kd_supplier = $request->input('kd_supplier');
        $i_warna = $request->input('warna');
        $i_berat = $request->input('berat');
        $i_tgl_sortir = $request->input('tgl_sortir');

        // ke Master
        $master = DB::table('tbl_master')->where('kd_produk', $i_kd_produk)->first();
        $global = $master->stok_global;
        $sortir = $master->stok_sortir;
        $giling = $master->stok_giling;
        $master->$master->update([
            '',
            '',
            '',
        ]);

        Sortir::create([
            'kd_produk' => $i_kd_produk,
            'kd_supplier' => $i_kd_supplier,
            'warna' => $i_warna,
            'berat' => $i_berat,
            'tgl_sortir' => $i_tgl_sortir,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan sortir');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sortir = Sortir::where('id_sortir', $id)->first();
        return response()->json($sortir);
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
        $data = $request->all();
        $data = $request->except('_token', '_method');
        $user = Sortir::where('id_sortir', $id);

        $user->update($data);

        return response()->json('Data Berhasil Update', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sortir = Sortir::where('id_sortir', $id);
        $sortir->delete();

        return response(null, 204);
    }
}
