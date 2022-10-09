@extends('layouts.theadmin.header')

@section('content')
    <div class="main-content">
        <div class="card">
            <header class="card-header">
                <h6 class="card-title card-title-bold">Arsip Surat >> Unggah</h6>
            </header>

            <div class="card-body">
                <div class="text-muted">
                    <p class="mb-0">
                        Unggah surat yang telah terbit pada form ini untuk diarsipkan. <br>
                        Catatan:
                    </p>
                    <ul>
                        <li class="text-danger">Gunakan File Berformat PDF</li>
                    </ul>
                </div>
                <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-4">
                        <div class="col-md-2">
                            <label for="">Nomor Surat</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control w-50 @error('nomor') is-invalid @enderror"
                                id="nomor" name="nomor" value="{{ old('nomor') }}">

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
                                <option value="Undangan" {{ old('kategori') == 'Undangan' ? 'selected' : '' }}>
                                    Undangan
                                </option>
                                <option value="Pengumuman" {{ old('kategori') == 'Pengumuman' ? 'selected' : '' }}>
                                    Pengumuman
                                </option>
                                <option value="Nota Dinas" {{ old('kategori') == 'Nota Dinas' ? 'selected' : '' }}>
                                    Nota Dinas
                                </option>
                                <option value="Pemberitahuan" {{ old('kategori') == 'Pemberitahuan' ? 'selected' : '' }}>
                                    Pemberitahuan
                                </option>
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
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                                name="judul" value="{{ old('judul') }}">

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
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a href="{{ route('arsip.index') }}" class="btn btn-md btn-secondary">
                                << Kembali </a>&NonBreakingSpace;
                                    <input type="submit" class="btn btn-md btn-dark" value="Simpan">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
