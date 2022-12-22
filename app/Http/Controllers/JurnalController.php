<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Employee;
use App\Exports\AbsenExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;


class JurnalController extends Controller
{

    public function insertabsen(Request $request){
        // dd($request->all());
        
        $data = Jurnal::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotoabsensi/' , $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('awal')->with('success','Absensi Pegawai Berhasil di Tambahkan');
        
    }

    public function harian(Request $request){
        if($request->has('search')){
            $data = Jurnal::where('nama' , 'LIKE' , '%' .$request->search.'%')->paginate(10);
            Session::put('halaman_url' , request()->fullUrl());
        }else{
            $data = Jurnal::paginate(10);
            Session::put('halaman_url' , request()->fullUrl());
        }
        return view('jurnalharian' , compact('data'));
    }

    public function bulanan(Request $request){
        if($request->has('search')){
            $data = Employee::where('nama' , 'LIKE' , '%' .$request->search.'%')->paginate(10);
            Session::put('halaman_url' , request()->fullUrl());
        }else{
            $data = Employee::paginate(10);
            Session::put('halaman_url' , request()->fullUrl());
        }
        return view('jurnalbulanan' , compact('data'));
    }

    public function deleteabsen($id){
        $data = Jurnal::find($id);
        $data->delete();
        return redirect()->route('harian')->with('success','Data Berhasil di Hapus');
    }

    public function exportexcel(){
        return Excel::download(new AbsenExport, 'AbsenPegawai.csv');
    }
}