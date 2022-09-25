<?php

namespace App\Http\Controllers;

use App\Exports\MahasiswaExport;
use Illuminate\Http\Request;
use app\Models\M_Mahasiswa;
use App\Models\Modelmhs;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Export;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'dataMhs' => Modelmhs::all()
        ];
        return view('index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $NIM = $request->NIM;
        $foto = $request->foto;
        $alamat = $request->alamat;



        $validateData = $request->validate([
            'nama' => 'required',
            'NIM' => 'required|numeric',
            'foto' => 'mimes:jpg,png,jpeg|image|max:2048',
            'alamat' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('upload');
        } else {
            $path = '';
        }

        $mhs = new Modelmhs;
        $mhs->id = $id;
        $mhs->nama = $nama;
        $mhs->NIM = $NIM;
        $mhs->foto = $path;
        $mhs->alamat = $alamat;

        $mhs->save();

        return redirect()->back()->with('alert', 'Create Success!');
        // return redirect()->route('beranda')->with('jsAlert', 'Berhasil Menambahkan Mahasiswa');

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
        $mhs = Modelmhs::find($id);
        $data = [
            'id' => $id,
            'nama' => $mhs->nama,
            'NIM' => $mhs->NIM,
            'foto' => $mhs->foto,
            'alamat' => $mhs->alamat,
        ];
        return View('edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $NIM = $request->NIM;
        $foto = $request->foto;
        $alamat = $request->alamat;


        $validateData = $request->validate([
            'nama' => 'required',
            'NIM' => 'required|numeric',
            'foto' => 'mimes:jpg,png,jpeg|image|max:2048',
            'alamat' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('upload');
        } else {
            $path = '';
        }


        $mhs = Modelmhs::find($id);

        $pathFoto =  $mhs->foto;
        if ($pathFoto != null || $pathFoto != '') {
            Storage::delete($pathFoto);
        }

        $mhs->nama = $nama;
        $mhs->NIM = $NIM;
        $mhs->foto = $path;
        $mhs->alamat = $alamat;

        $mhs->save();


        return redirect()->back()->with('alert', 'Update Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mhs = Modelmhs::find($id);
        $pathFoto = $mhs->foto;
        if ($pathFoto != null || $pathFoto != '') {
            Storage::delete($pathFoto);
        }

        $id = Modelmhs::find($id)->delete();
        return redirect()->back()->with('alert', 'Delete Success!');
    }

    public function export()
    {
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }
}
