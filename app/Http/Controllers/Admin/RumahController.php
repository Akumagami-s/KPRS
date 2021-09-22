<?php

namespace App\Http\Controllers\Admin;

use App\Fasilitas;
use App\Gambar;
use App\Http\Controllers\Controller;
use App\Rumah;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RumahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collect = Rumah::get();
        if(Rumah::count() >= 1)
        {
            foreach($collect as $home);
        } else {
            $home = null;
        }
        return view('admin.rumah.index', [
            'data' => Rumah::latest()->paginate(5),
            'home' => $home ? $home : null
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rumah.create', [
            'fasilitas' => Fasilitas::orderBy('nama_fasilitas', 'ASC')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'gambar_satu' => 'nullable|mimes:png,jpg,jpeg,ico,icon,svg',
            'gambar_kedua' => 'nullable|mimes:png,jpg,jpeg,ico,icon,svg',
            'gambar_ketiga' => 'nullable|mimes:png,jpg,jpeg,ico,icon,svg',
            'gambar_keempat' => 'nullable|mimes:png,jpg,jpeg,ico,icon,svg',
            'gambar_kelima' => 'nullable|mimes:png,jpg,jpeg,ico,icon,svg',
            'link' => 'active_url'
        ]);
        $gambar = new Gambar;
        if(request()->file('gambar_satu'))
        {
            $nm_satu = request('gambar_satu');
            $namaFile_satu = time().rand(100,999).".".$nm_satu->getClientOriginalName();
            $nm_satu->move(public_path().'/gambar_rumah', $namaFile_satu);
        }
        if(request()->file('gambar_kedua'))
        {
            $nm_dua = request('gambar_kedua');
            $namaFile_dua = time().rand(100,999).".".$nm_dua->getClientOriginalName();
            $nm_dua->move(public_path().'/gambar_rumah', $namaFile_dua);
        } 
        if(request()->file('gambar_ketiga'))
        {
            $nm_tiga = request('gambar_ketiga');
            $namaFile_tiga = time().rand(100,999).".".$nm_tiga->getClientOriginalName();
            $nm_tiga->move(public_path().'/gambar_rumah', $namaFile_tiga);
        } 
        if(request()->file('gambar_keempat'))
        {
            $nm_empat = request('gambar_keempat');
            $namaFile_empat = time().rand(100,999).".".$nm_empat->getClientOriginalName();
            $nm_empat->move(public_path().'/gambar_rumah', $namaFile_empat);
        } 
        if(request()->file('gambar_kelima'))
        {
            $nm_dua = request('gambar_kelima');
            $namaFile_lima = time().rand(100,999).".".$nm_dua->getClientOriginalName();
            $nm_dua->move(public_path().'/gambar_rumah', $namaFile_lima);
        } 
        $gambar->gambar_satu = request()->file('gambar_satu') ? $namaFile_satu : null;
        $gambar->gambar_kedua =  request()->file('gambar_kedua') ? $namaFile_dua : null;
        $gambar->gambar_ketiga =  request()->file('gambar_ketiga') ? $namaFile_tiga : null;
        $gambar->gambar_keempat =  request()->file('gambar_keempat') ? $namaFile_empat : null;
        $gambar->gambar_kelima =  request()->file('gambar_kelima') ? $namaFile_lima : null;
        $gambar->save();
        $harga = preg_replace('/[Rp. ]/','',request('harga'));
        try {
            $rumah = Rumah::create([
                'nama_rumah' => request('nama_rumah'),
                'deskripsi' => request('deskripsi'),
                'gambar_id' => $gambar->id,
                'alamat' => request('alamat'),
                'luas_tanah' => request('luas_tanah'),
                'luas_bangunan' => request('luas_bangunan'),
                'lat' => request('lat'),
                'lng' => request('lng'),
                'link' => request('link'),
                'harga' => $harga,
                'status' => 0
            ]);
            $rumah->fasilitas()->attach(request('fasilitas_id'));
        } catch (\Exception $e) {
            Alert::error('Message Information', 'Saved failed! ' . $e->getMessage());
            return back();
        };
        Alert::success('Message Information', 'Rumah berhasil disimpan');
        return redirect()->route('admin.rumah.index');
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
    public function edit(Rumah $rumah)
    {
        return view('admin.rumah.edit', [
            'rumah' => $rumah,
            'fasilitas' => Fasilitas::orderBy('nama_fasilitas', 'ASC')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Rumah $rumah)
    {
        $attr = $this->validate(request(), [
            'nama_rumah' => 'required|string',
            'alamat' => 'required|string',
            'luas_tanah' => 'required|numeric',
            'luas_bangunan' => 'required|numeric',
            'deskripsi' => 'nullable',
            'harga' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'link' => 'required',
            'status' => 'required'
        ]);
        // gambar satu
        if(request()->file('gambar_satu') == "")
        {
            $rumah->gambar->gambar_satu = $rumah->gambar->gambar_satu;
        } else {
            if(request()->hasFile('gambar_satu'))
            {
                $file = 'gambar_rumah/'.$rumah->gambar->gambar_satu;
                if(is_file($file))
                {
                    unlink($file);
                }
                $file = request()->file('gambar_satu');
                $filename = time().rand(100,999).".".$file->getClientOriginalName();
                request()->file('gambar_satu')->move('gambar_rumah/', $filename);
                $rumah->gambar->update([
                    'gambar_satu' => $filename
                ]);
            }
        }
        // gambar dua
        if(request()->file('gambar_kedua') == "")
        {
            $rumah->gambar->gambar_kedua = $rumah->gambar->gambar_kedua;
        } else {
            if(request()->hasFile('gambar_kedua'))
            {
                $file = 'gambar_rumah/'.$rumah->gambar->gambar_kedua;
                if(is_file($file))
                {
                    unlink($file);
                }
                $file = request()->file('gambar_kedua');
                $filename = time().rand(100,999).".".$file->getClientOriginalName();
                request()->file('gambar_kedua')->move('gambar_rumah/', $filename);
                $rumah->gambar->update([
                    'gambar_kedua' => $filename
                ]);
            }
        }
        // gambar tiga
        if(request()->file('gambar_ketiga') == "")
        {
            $rumah->gambar->gambar_ketiga = $rumah->gambar->gambar_ketiga;
        } else {
            if(request()->hasFile('gambar_ketiga'))
            {
                $file = 'gambar_rumah/'.$rumah->gambar->gambar_ketiga;
                if(is_file($file))
                {
                    unlink($file);
                }
                $file = request()->file('gambar_ketiga');
                $filename = time().rand(100,999).".".$file->getClientOriginalName();
                request()->file('gambar_ketiga')->move('gambar_rumah/', $filename);
                $rumah->gambar->update([
                    'gambar_ketiga' => $filename
                ]);
            }
        }
        // gambar empat
        if(request()->file('gambar_keempat') == "")
        {
            $rumah->gambar->gambar_keempat = $rumah->gambar->gambar_keempat;
        } else {
            if(request()->hasFile('gambar_keempat'))
            {
                $file = 'gambar_rumah/'.$rumah->gambar->gambar_keempat;
                if(is_file($file))
                {
                    unlink($file);
                }
                $file = request()->file('gambar_keempat');
                $filename = time().rand(100,999).".".$file->getClientOriginalName();
                request()->file('gambar_keempat')->move('gambar_rumah/', $filename);
                $rumah->gambar->update([
                    'gambar_keempat' => $filename
                ]);
            }
        }
        // gambar lima
        if(request()->file('gambar_kelima') == "")
        {
            $rumah->gambar->gambar_kelima = $rumah->gambar->gambar_kelima;
        } else {
            if(request()->hasFile('gambar_kelima'))
            {
                $file = 'gambar_rumah/'.$rumah->gambar->gambar_kelima;
                if(is_file($file))
                {
                    unlink($file);
                }
                $file = request()->file('gambar_kelima');
                $filename = time().rand(100,999).".".$file->getClientOriginalName();
                request()->file('gambar_kelima')->move('gambar_rumah/', $filename);
                $rumah->gambar->update([
                    'gambar_kelima' => $filename
                ]);
            }
        }
        $attr['harga'] = preg_replace('/[Rp. ]/','',request('harga'));
        try {
            $rumah->update($attr);
            $rumah->fasilitas()->sync(request('fasilitas_id'));
        } catch (\Exception $e) {
            Alert::error('Message Information', 'Updated failed! ' . $e->getMessage());
            return back();
        };
        Alert::success('Message Information', 'Rumah berhasil diupdate');
        return redirect()->route('admin.rumah.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rumah $rumah)
    {
        $thumb_satu = 'gambar_rumah/'.$rumah->gambar->gambar_satu;
        $thumb_kedua = 'gambar_rumah/'.$rumah->gambar->gambar_kedua;
        $thumb_ketiga = 'gambar_rumah/'.$rumah->gambar->gambar_ketiga;
        $thumb_keempat = 'gambar_rumah/'.$rumah->gambar->gambar_keempat;
        $thumb_kelima = 'gambar_rumah/'.$rumah->gambar->gambar_kelima;
        try {
            if(is_file($thumb_satu))
            {
                unlink($thumb_satu);
            }
            if(is_file($thumb_kedua))
            {
                unlink($thumb_kedua);
            }
            if(is_file($thumb_ketiga))
            {
                unlink($thumb_ketiga);
            }
            if(is_file($thumb_keempat))
            {
                unlink($thumb_keempat);
            }
            if(is_file($thumb_kelima))
            {
                unlink($thumb_kelima);
            }
            Gambar::where('id', $rumah->gambar_id)->delete();
            $rumah->fasilitas()->detach();
            $rumah->delete();
        } catch (\Exception $e) {
            Alert::error('Message Information', 'Deleted failed!');
            return back();
        };
        Alert::success('Message Information', 'Rumah berhasil dihapus');
        return back();
    }
}
