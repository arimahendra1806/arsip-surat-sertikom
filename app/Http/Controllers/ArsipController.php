<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipModel;
use DataTables, Validator, Alert, File;

class ArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = ArsipModel::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('waktu', function($model){
                    $waktu = \Carbon\Carbon::parse($model->created_at)->isoFormat('D MMMM Y / HH:mm:ss');
                    return $waktu;
                })
                ->addColumn('action', function($model){
                    $btn = '<div class="hstack"><a class="btn btn-danger btn-sm text-white mr-1" id="btnDelete" data-id="'.$model->id.'">Hapus</a>
                    <a class="btn btn-warning btn-sm text-white mr-1" id="btnDownload" data-id="'.$model->id.'" href="file/'.$model->file.'" download>Unduh</a>
                    <a class="btn btn-info btn-sm text-white" id="btnShow" data-id="'.$model->id.'" href="arsip/'.$model->id.'">Lihat</a></div>';
                    return $btn;
                })
                ->rawColumns(['waktu','action'])
                ->toJson();
        }

        return view('arsip.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('arsip.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nomor' => ['required','unique:arsip,nomor'],
            'kategori' => ['required'],
            'judul' => ['required'],
            'fileSurat' => ['required','file','mimes:pdf'],
        ];

        $messages = [];

        $attributes = [
            'nomor' => 'Nomor Surat',
            'kategori' => 'Kategori Surat',
            'judul' => 'Judul Surat',
            'fileSurat' => 'File Surat',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if(!$validator->passes()){
            Alert::error('Terjadi Kesalahan!');

            return redirect()->back()->withInput()->withErrors($validator->errors()->toArray());
        } else {
            $data = new ArsipModel;
            $data->nomor = $request->nomor;
            $data->kategori = $request->kategori;
            $data->judul = $request->judul;

            if ($request->hasFile('fileSurat')){
                $file = $request->file('fileSurat');
                $filename = time()."_".$file->getClientOriginalName();
                $file->move(public_path('file'), $filename);

                $data->file = $filename;
            }

            $data->save();

            Alert::success('Berhasil Menambahkan Data!');

            return redirect('/arsip');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = ArsipModel::where('id', $id)->first();

        return view('arsip.show', compact('data'));
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
        $data = ArsipModel::where('id', $id)->first();

        if ($data->nomor == $request->nomor) {
            if ($request->hasFile('fileSurat')) {
                $rules = [
                    'kategori' => ['required'],
                    'judul' => ['required'],
                    'fileSurat' => ['required','file','mimes:pdf'],
                ];
            } else {
                $rules = [
                    'kategori' => ['required'],
                    'judul' => ['required'],
                ];
            }
        } else {
            if ($request->hasFile('fileSurat')) {
                $rules = [
                    'nomor' => ['required','unique:arsip,nomor'],
                    'kategori' => ['required'],
                    'judul' => ['required'],
                    'fileSurat' => ['required','file','mimes:pdf'],
                ];
            } else {
                $rules = [
                    'nomor' => ['required','unique:arsip,nomor'],
                    'kategori' => ['required'],
                    'judul' => ['required'],
                ];
            }
        }

        $messages = [];

        $attributes = [
            'nomor' => 'Nomor Surat',
            'kategori' => 'Kategori Surat',
            'judul' => 'Judul Surat',
            'fileSurat' => 'File Surat',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if(!$validator->passes()){
            Alert::error('Terjadi Kesalahan!');

            return redirect()->back()->withInput()->withErrors($validator->errors()->toArray());
        } else {
            $data->nomor = $request->nomor;
            $data->kategori = $request->kategori;
            $data->judul = $request->judul;

            if ($request->hasFile('fileSurat')){
                $file = $request->file('fileSurat');
                $filename = time()."_".$file->getClientOriginalName();
                $file->move(public_path('file'), $filename);

                $path = public_path() . '/file/' . $data->file;
                File::delete($path);

                $data->file = $filename;
            }

            $data->save();

            Alert::success('Berhasil Memperbarui Data!');

            return redirect('/arsip');
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
        $data = ArsipModel::find($id);

        $path = public_path() . '/file/' . $data->file;
        File::delete($path);

        $data->delete();

        return response()->json(['msg' => "Berhasil Menghapus Data!"]);
    }

    public function cari($word)
    {
        if ($word == "0") {
            $data = ArsipModel::latest()->get();
        } else {
            $data = ArsipModel::latest()->where('judul', 'like', '%'. $word .'%')->get();
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('waktu', function($model){
                $waktu = \Carbon\Carbon::parse($model->created_at)->isoFormat('D MMMM Y / HH:mm:ss');
                return $waktu;
            })
            ->addColumn('action', function($model){
                $btn = '<div class="hstack"><a class="btn btn-danger btn-sm text-white mr-1" id="btnDelete" data-id="'.$model->id.'">Hapus</a>
                <a class="btn btn-warning btn-sm text-white mr-1" id="btnDownload" data-id="'.$model->id.'" href="file/'.$model->file.'" download>Unduh</a>
                <a class="btn btn-info btn-sm text-white" id="btnShow" data-id="'.$model->id.'">Lihat</a></div>';
                return $btn;
            })
            ->rawColumns(['waktu','action'])
            ->toJson();
    }
}
