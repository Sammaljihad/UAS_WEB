<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuratMasuk;
use Cloudinary;
use Carbon\Carbon;
use PDF;

class SuratMasukController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $data_surat_masuk = SuratMasuk::orderBy('created_at')->get();

        return view('pages.surat_masuk.index', compact('data_surat_masuk'));
    }

    public function create(){
        $no_awal = 1;
        $no_urut_akhir = SuratMasuk::max('nomor_surat');
        
        $bulan_romawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");

        $nomor_surat = '';

        if($no_urut_akhir){
            $nomor_surat = sprintf("%03s", abs(explode('/', $no_urut_akhir)[0] + 1)).'/SRT/'.$bulan_romawi[date("n")].'/'.date('Y');
        }else{
            $nomor_surat = sprintf("%03s", abs($no_awal)).'/SRT/'.$bulan_romawi[date("n")].'/'.date('Y');
        }
        return view('pages.surat_masuk.create', compact('nomor_surat'));
    }

    public function store(Request $request){
        $rules = [
            'nomor_surat' => 'required',
            'tanggal_surat' =>'required',
            'pengirim' => 'required',
        ];

        $messages = [
            'required' => 'Form :attribute tidak boleh kosong'
        ];

        $this->validate($request, $rules, $messages);

        $nama_file = Carbon::now()->format('Y-m-d H:i:s').'-'.explode('/', $request->nomor_surat)[0];

        $unggah_gambar = $request->file('gambar')->storeOnCloudinaryAs('shammal', $nama_file);

        $gambar = $unggah_gambar->getSecurePath();
        $public_id = $unggah_gambar->getPublicId();

        $data_surat_masuk = SuratMasuk::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'pengirim' => $request->pengirim,
            'gambar' => $request->gambar ? $gambar : null,
            'public_id' => $request->gambar ? $public_id : null,
        ]);

        return redirect()->route('surat-masuk.index')->with('success','Surat masuk berhasil ditambahkan');
    }

    public function edit($id){
        $data_surat_masuk = SuratMasuk::findOrFail($id);

        return view('pages.surat_masuk.edit', compact('data_surat_masuk'));
    }

    public function update(Request $request, $id){
        $data_surat_masuk = SuratMasuk::findOrFail($id);

        $rules = [
            'nomor_surat' => 'required',
            'tanggal_surat' =>'required',
            'pengirim' => 'required',
        ];

        $messages = [
            'required' => 'Form :attribute tidak boleh kosong'
        ];

        $this->validate($request, $rules, $messages);

        if($request->gambar){
            $nama_file = Carbon::now()->format('Y-m-d H:i:s').'-'.explode('/', $request->nomor_surat)[0];

            Cloudinary::destroy($data_surat_masuk->public_id);

            $unggah_gambar = $request->file('gambar')->storeOnCloudinaryAs('shammal', $nama_file);

            $gambar = $unggah_gambar->getSecurePath();
            $public_id = $unggah_gambar->getPublicId();
        }

        $data_surat_masuk->update([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'pengirim' => $request->pengirim,
            'gambar' => $request->gambar ? $gambar : $data_surat_masuk->gambar,
            'public_id' => $request->gambar ? $public_id : $data_surat_masuk->public_id
        ]);

        return redirect()->route('surat-masuk.index')->with('success','Surat masuk berhasil diubah');
    }

    public function destroy($id){
        $data_surat_masuk = SuratMasuk::findOrFail($id);
        Cloudinary::destroy($data_surat_masuk->public_id);
        $data_surat_masuk->delete();

        return redirect()->route('surat-masuk.index')->with('success','Surat masuk berhasil diubah');
    }

    public function printPdfSuratMasuk() {
        $data_surat_masuk = SuratMasuk::orderBy('created_at')->get();
        
        $pdf = PDF::loadView('pages.pdf.surat_masuk', ['data_surat_masuk' => $data_surat_masuk]);
        return $pdf->stream('invoice.pdf');
    }
}
