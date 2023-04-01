<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Response;
use App\Models\Pengaduan;
use PDF;
use Excel;
use App\Exports\InterviewsExport;
use RealRashid\SweetAlert\Facades\Alert;




class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     */

     public function login()
     {
        return view('login');
     }

     public function auth(Request $request)
     {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
        
        $user = $request->only('email', 'password');
        if (Auth::attempt($user)) {
            if (Auth::user()->role == 'admin'){
                return redirect()->route('data.admin')->with('toast_success','Berhasil Login!' );
            } elseif (Auth::user()->role == 'petugas') {
                return redirect()->route('data_petugas')->with('toast_success','Berhasil Login!');
            }
        } else {
            return redirect()->back()->with('toast_warning', 'Gagal Login!');
        }

     }

     public function data(Request $request)
     {
        $search = $request->search;
        $data = Interview::with('response')->where('name', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'DESC')->get();
        return view('data',compact('data'));
     }
     public function dataPetugas(Request $request)
     {
     $search = $request->search;
        // with : ambil relasi (nama fungsi hasOne/hasMany/BelongsTo di modelnya),ambil data dr relasi itu
        $data = Interview::with('response')->orderBy('created_at', 'DESC')->get();
        return view('data_petugas', compact('data'));
     }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'age' => 'required',
            'phone_number' => 'required',
            'last_education'=> 'required',
            'education_name' => 'required',
            'cv_file'=> 'required|mimes:pdf',

        ]);
        $cv = $request->file('cv_file');
        $cvName = rand() . '.' . $cv->extension();
        $path = public_path('assets/cvfile/');
        $cv->move($path, $cvName);

            Interview::create([
                'name' => $request->name,
                'email' => $request->email,
                'age' => $request->age,
                'phone_number' => $request->phone_number,
                'last_education' => $request->last_education,
                'education_name' => $request->education_name,
                'cv_file' => $cvName,
            ]);
            return redirect()->route('home')->with('toast_success', 'Berhasil Menambahkan Data!');
    }

    public function createPDF()
    {
        $data = Interview::with('response')->get()->toArray();
        view()->share('data',$data);
        $pdf = PDF::loadview('print',$data)->setPaper('A4','landscape');
        return $pdf->download('pdf_file.pdf');
    }

    public function createExcel()
    {
        $file_name = 'data_keseluruhan_interviews.xlsx';
        return Excel::download(new InterviewsExport, $file_name);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    /**
     * Display the specified resource.
     */
    public function show(Interview $interview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Interview $interview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Interview $interview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Interview::where('id', $id)->firstOrFail();
        // $data isinya-> nik sampe foto dr pengaduan
        // nikin variable yg isinya ngarah ke file foto terkait
        // public_path nyari file di folder public yg namanua sama kaya $data bagian foto
        $cv = public_path('assets/cvfile/' . $data['cv_file']);
        //    uda nemu fotonya, tinggal hapus fotonya pake unlink
        unlink($cv);
        //    hapus $data yang isinya data->foto tadi, hapusnya di database
        $data->delete();
        Response::where('interview_id',$id)->delete();
        //    settelehnya dikembalikan lg ke halaman awal
        return redirect()->back()->with('toast_success,Berhasil menghapus data!');
    }

    }

