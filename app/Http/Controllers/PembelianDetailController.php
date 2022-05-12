<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PembelianDetail;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class PembelianDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data(Request $request, $id)
    {
        $filter = $request->input('name');

        if ($filter != null) {
            $detail = DB::table('tbl_penjualan_master')
                ->where('nama_customer', 'like', '%' . $filter . '%')
                ->orWhere('nosp', $filter);
        }

        $detail = DB::table('tbl_pembelian_detail as a')->leftJoin('tbl_master as b', 'a.kd_produk', 'b.kd_produk')
            ->where('kd_pembelian', $id)
            ->get();
        // dd($detail);

        $data = array();

        $total = 0;
        $total_item = 0;


        foreach ($detail as $item) {
            $row = array();
            $row['kode_produk'] = '<span class="label label-success">' . $item->kd_produk . '</span';
            $row['nama_produk'] = $item->nama_produk;
            $row['harga']  = 'Rp. ' . format_uang($item->harga_kg);
            $row['jumlah']      = '<input type="number" class="form-control input-sm quantity" data-id="' . $item->id_pembelian_detail . '" data-produk="' . $item->kd_produk . '" value="' . $item->berat . '">';
            $row['subtotal']    = 'Rp. ' . format_uang($item->total_harga);
            $row['sts']    = '<select name="sts" id="sts" class="form-control status"  data-id="' . $item->id_pembelian_detail . '" data-produk="' . $item->kd_produk . '">
                                    <option value="0">Pilih Kondisi</option>
                                    <option value="1" ' . (($item->sts == 1) ? 'selected' : '') . '>Belum Sortir</option>
                                    <option value="5" ' . (($item->sts == 5) ? 'selected' : '') . '>Siap Giling</option>
                                </select>';
            $row['aksi']        = '<div class="btn-group">
                                    <button onclick="deleteData(`' . route('pembelianDetail.destroy', $item->id_pembelian_detail) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                </div>';
            $data[] = $row;

            $total += $item->harga_kg * $item->berat;
            $total_item += $item->berat;
        }
        $data[] = [
            'kode_produk' => '
                <div class="total hidden ">' . $total . '</div>
                <div class="total_item hidden ">' . $total_item . '</div>',
            'nama_produk' => '',
            'harga'  => '',
            'jumlah'      => '',
            'subtotal'    => '',
            'sts'    => '',
            'aksi'        => '',
        ];

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['aksi', 'kode_produk', 'jumlah', 'sts'])
            ->make(true);
    }

    public function index(Request $request)
    {
        $produk = DB::table('tbl_master')->orderBy('nama_produk')->get();
        $session = session('kd_pembelian');
        $supplier = Supplier::all();

        // Cek apakah ada transaksi yang sedang berjalan
        if (session('kd_pembelian')) {
            return view('pembelian_detail.index', compact('session', 'produk', 'supplier'));
        } else {
            return redirect()->route('pembelian.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('pembelianDetail.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produk = DB::table('tbl_master')->where('kd_produk', $request->kd_produk)->first();
        if (!$produk) {
            return response()->json('Data gagal disimpan', 400);
        } else {
            DB::table('tbl_pembelian_detail')->insert([
                'kd_pembelian'  =>  $request->input('kd_pembelian'),
                'kd_produk'     =>  $request->input('kd_produk'),
                'warna'         =>  $produk->warna,
                'harga_satuan'  =>  $produk->harga_kg,
                'berat'         =>  '0',
                'sts'           =>  '0',
                'total_harga'   =>  '0',
            ]);
        }

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = DB::table('tbl_pembelian_detail')->where('kd_produk', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('kode_produk', function ($detail) {
                return '<span class="label label-success">' . $detail->produk->kode_produk . '</span>';
            })
            ->addColumn('nama_produk', function ($detail) {
                return $detail->produk->nama_produk;
            })
            ->addColumn('harga_jual', function ($detail) {
                return 'Rp. ' . format_uang($detail->harga_jual);
            })
            ->addColumn('jumlah', function ($detail) {
                return format_uang($detail->jumlah);
            })
            ->addColumn('subtotal', function ($detail) {
                return 'Rp. ' . format_uang($detail->subtotal);
            })
            ->rawColumns(['kode_produk'])
            ->make(true);
    }

    public function selesai()
    {
        $setting = Setting::first();

        return view('penjualan.selesai', compact('setting'));
    }

    public function notaKecil()
    {
        $setting = Setting::first();
        $penjualan = Penjualan::find(session('kd_pembelian'));
        if (!$penjualan) {
            abort(404);
        }
        $detail = PenjualanDetail::with('produk')
            ->where('kd_pembelian', session('kd_pembelian'))
            ->get();

        return view('penjualan.nota_kecil', compact('setting', 'penjualan', 'detail'));
    }

    public function notaBesar()
    {
        $setting = Setting::first();
        $penjualan = Penjualan::find(session('kd_pembelian'));
        if (!$penjualan) {
            abort(404);
        }
        $detail = PenjualanDetail::with('produk')
            ->where('kd_pembelian', session('kd_pembelian'))
            ->get();

        $pdf = PDF::loadView('penjualan.nota_besar', compact('setting', 'penjualan', 'detail'));
        $pdf->setPaper(0, 0, 609, 440, 'potrait');
        return $pdf->stream('Transaksi-' . date('Y-m-d-his') . '.pdf');
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
        $harga = DB::table('tbl_pembelian_detail')->where('id_pembelian_detail', $id)->where('kd_produk', $request->produk)->first();
        $total_harga = $harga->harga_satuan * $request->jumlah;

        $pembelian_detail = DB::table('tbl_pembelian_detail')
            ->where('kd_produk', $request->produk)
            ->where('id_pembelian_detail', $id);

        if (!$request->jumlah) {
            $pembelian_detail->update([
                'sts' => $request->sts,
            ]);
        } elseif (!$request->sts) {
            $pembelian_detail->update([
                'berat' => $request->jumlah,
                'total_harga' => $total_harga,
                'sts' =>  $pembelian_detail->first()->sts,
            ]);
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
        $kd_pembelian = session('kd_pembelian');
        $detail = PembelianDetail::where('kd_pembelian', $kd_pembelian)->where('id_pembelian_detail', $id);
        $detail->delete();

        return response(null, 204);
    }

    public function detail($id)
    {
        $customer = DB::table('tbl_penjualan_detail')
            ->where('nosp', $id)->get();
        return response()->json($customer);
    }

    public function getkota(Request $request)
    {
        $kota = DB::table('tbl_place_kota')->where("prov_id", $request->prov_id)
            ->orderBy('city_name', 'ASC')->pluck('city_id', 'city_name');
        return response()->json($kota);
    }
    public function getkecamatan(Request $request)
    {
        $kecamatan = DB::table('tbl_place_kecamatan')->where("city_id", $request->city_id)
            ->orderBy('dis_name', 'ASC')->pluck('dis_id', 'dis_name');
        return response()->json($kecamatan);
    }
    public function getkelurahan(Request $request)
    {
        $kelurahan = DB::table('tbl_place_kelurahan')->where("dis_id", $request->dis_id)
            ->orderBy('subdis_name', 'ASC')->pluck('subdis_id', 'subdis_name');
        return response()->json($kelurahan);
    }

    public function loadForm($total = 0)
    {
        $data    = [
            'totalrp' => format_uang($total),
        ];

        return response()->json($data);
    }
}
