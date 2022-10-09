@extends('layouts.theadmin.header')

@section('content')
    <div class="main-content">
        <div class="modal fade" id="modal-large" tabindex="-1" data-backdrop="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h4 class="modal-title text-white" id="myModalLabel">Edit/Ganti File</h4>
                        <button type="button" class="close text-white" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('arsip.update', ['id' => $data->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body bg-secondary">
                            <p class="mb-0">
                                Catatan:
                            </p>
                            <ul>
                                <li class="text-danger">Gunakan File Berformat PDF</li>
                                <li class="text-danger">Kosongkan File Jika Tidak Diganti</li>
                            </ul>
                            <div class="row mt-4">
                                <div class="col-md-2">
                                    <label for="">Nomor Surat</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control w-50 @error('nomor') is-invalid @enderror"
                                        id="nomor" name="nomor" value="{{ old('nomor', $data->nomor) }}">

                                    @error('nomor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label for="">Kategori</label>
                                </div>
                                <div class="col-md-10">
                                    <select name="kategori" id="kategori"
                                        class="form-control w-75 @error('kategori') is-invalid @enderror">
                                        <option value="Undangan"
                                            {{ old('kategori', $data->kategori) == 'Undangan' ? 'selected' : '' }}>
                                            Undangan</option>
                                        <option value="Pengumuman"
                                            {{ old('kategori', $data->kategori) == 'Pengumuman' ? 'selected' : '' }}>
                                            Pengumuman</option>
                                        <option value="Nota Dinas"
                                            {{ old('kategori', $data->kategori) == 'Nota Dinas' ? 'selected' : '' }}>
                                            Nota Dinas</option>
                                        <option value="Pemberitahuan"
                                            {{ old('kategori', $data->kategori) == 'Pemberitahuan' ? 'selected' : '' }}>
                                            Pemberitahuan</option>
                                    </select>

                                    @error('kategori')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label for="">Judul</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                        id="judul" name="judul" value="{{ old('judul', $data->judul) }}">

                                    @error('judul')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label for="">File Surat (PDF)</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="input-group form-type-combine file-group w-50">
                                        <div class="input-group-input">
                                            <label>Pilih file...</label>
                                            <input type="text" class="form-control file-value" readonly>
                                            <input type="file" name="fileSurat" id="fileSurat"
                                                class="form-control @error('fileSurat') is-invalid @enderror">

                                            @error('fileSurat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <span class="input-group-btn">
                                            <button class="btn btn-light file-browser" type="button"><i
                                                    class="fa fa-upload"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-secondary">
                            <button type="button" class="btn btn-bold btn-pure btn-secondary"
                                data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-bold btn-pure btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card">
            <header class="card-header">
                <h6 class="card-title card-title-bold">Arsip Surat >> Lihat</h6>
            </header>

            <div class="card-body">
                <div class="text-muted">
                    <p>
                        <b>Nomor :</b> {{ $data->nomor }}<br>
                        <b>Kategori :</b> {{ $data->kategori }}<br>
                        <b>Judul :</b> {{ $data->judul }}<br>
                        <b>Waktu Unggah :</b>
                        {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM Y / HH:mm:ss') }}<br>
                    </p>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <iframe src="/file/{{ $data->file }}" height="500" width="100%"></iframe>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <a href="{{ route('arsip.index') }}" class="btn btn-md btn-secondary">
                            << Kembali </a>&NonBreakingSpace;
                                <a href="/file/{{ $data->file }}" class="btn btn-md btn-warning" download>
                                    Unduh </a>&NonBreakingSpace;
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-large">Edit/Ganti
                                    File</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
