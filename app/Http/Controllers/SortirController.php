<?php

namespace App\Http\Controllers;

use App\Models\Sortir;
use Illuminate\Http\Request;

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
            ->addColumn('aksi', function($sortir){
                return '
                    <button onclick="editform(`'. route('sortir.update',$sortir->id_sortir) .'`)" class="btn btn-info btn-xs">Edit</button>
                    <button onclick="deleteform(`'. route('sortir.destroy',$sortir->id_sortir) .'`)" class="btn btn-danger btn-xs">Hapus</button>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function index()
    {
        return view('sortir.index');
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
        Sortir::create($request->all());

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
        $sortir = Sortir::where('id_sortir',$id)->first();
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
        $data =$request->except('_token','_method');
        $user = Sortir::where('id_sortir',$id);

        $user->update($data);

        return response()->json('Data Berhasil Update',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sortir = Sortir::where('id_sortir',$id);
        $sortir->delete();

        return response(null,204);
    }
}
