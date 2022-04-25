<?php

namespace App\Http\Controllers;

use App\Models\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $master = Master::all();

        return datatables()::of($master)
            ->addIndexColumn()
            ->addColumn('aksi', function ($master) {
                return '
                    <button onclick="editform(`' . route('master.update', $master->kd_produk) . '`)" class="btn btn-warning btn-xs">Edit</button>
                    <button onclick="deleteform(`' . route('master.destroy', $master->kd_produk) . '`)" class="btn btn-danger btn-xs">Hapus</button>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function index()
    {
        return view('master.index');
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
        $i_kd_produk    = $request->input('kd_produk');
        $i_nama_produk  = $request->input('nama_produk');
        $i_jenis        = $request->input('jenis');
        $i_warna        = $request->input('warna');
        $i_harga_kg     = $request->input('harga_kg');
        $i_stok_global  = '0';
        $i_stok_sortir  = '0';
        $i_stok_giling  = '0';
        $i_penyusutan   = '0';
        $i_harga_beli   = '0';
        $i_hpp          = '0';


        $id = DB::table('tbl_master')->max('id');
        if ($id == null) {
            $id = 0;
        }
        $kode_produk = kode('P-', $id);

        Master::create([
            'kd_produk'     => $kode_produk,
            'nama_produk'   => $i_nama_produk,
            'jenis'         => $i_jenis,
            'warna'         => $i_warna,
            'harga_kg'      => $i_harga_kg,
            'stok_global'   => $i_stok_global,
            'stok_sortir'   => $i_stok_sortir,
            'stok_giling'   => $i_stok_giling,
            'penyusutan'    => $i_penyusutan,
            'harga_beli'    => $i_harga_beli,
            'hpp'           => $i_hpp,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan master');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $master = Master::where('kd_produk', $id)->first();
        return response()->json($master);
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
        $user = Master::where('kd_produk', $id);

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
        $master = Master::where('kd_produk', $id);
        $master->delete();

        return response(null, 204);
    }
}
