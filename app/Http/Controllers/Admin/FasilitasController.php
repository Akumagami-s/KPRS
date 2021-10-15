<?php

namespace App\Http\Controllers\Admin;

use App\Fasilitas;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.fasilitas.index', [
            'data' => Fasilitas::latest()->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fasilitas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $attr = $this->validate(request(), [
            'nama_fasilitas' => 'required'
        ]);
        try {
            Fasilitas::create($attr);
        } catch (\Exception $e) {
            Alert::error('Message Information', 'Saved failed!');
            return back();
        };
        Alert::success('Message Information', 'Fasilitas berhasil disimpan');
        return redirect()->route('admin.fasilitas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        return view('admin.fasilitas.edit', compact('fasilitas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $attr = $this->validate(request(), [
            'nama_fasilitas' => 'required'
        ]);
        try {
            $fasilitas->update($attr);
        } catch (\Exception $e) {
            Alert::error('Message Information', 'Updated failed!');
            return back();
        };
        Alert::success('Message Information', 'Fasilitas berhasil diupdate');
        return redirect()->route('admin.fasilitas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Fasilitas::findOrFail($id)->delete();
        } catch (\Exception $e) {
            Alert::error('Message Information', 'Deleted failed!');
            return back();
        };
        Alert::success('Message Information', 'Fasilitas berhasil dihapus');
        return back();
    }
}
