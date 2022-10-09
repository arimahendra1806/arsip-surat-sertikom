@extends('layouts.theadmin.header')

@section('content')
    <div class="main-content">
        <div class="card">
            <header class="card-header">
                <h6 class="card-title card-title-bold">Arsip Surat</h6>
            </header>

            <div class="card-body">
                <div class="text-muted">
                    <p>
                        Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.
                        Klik "Lihat" pada kolom aksi untuk menampilkan surat.
                    </p>
                </div>
                <div class="mt-3 d-flex flex-row-reverse">
                    <a href="{{ route('arsip.create') }}" class="btn btn-sm btn-dark">Arsipkan Surat</a>
                </div>
                <div class="hstack mt-3 form-type-round">
                    <p class="form-control-plaintext mr-4 no-wrap">Cari Surat :</p>
                    <input type="text" class="form-control mr-4" id="pencarian" placeholder="Ketikan sesuatu ..">
                    <button class="btn btn-md btn-primary" id="btnCari">Cari!</button>
                </div>
                <div class="mt-3 table-responsive">
                    <table class="table table-bordered table-lg w-100" id="Tables">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Kategori</th>
                                <th>Judul</th>
                                <th>Waktu Pengarsipan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            /* Ajax Token */
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /* Get data table */
            var table = $('#Tables').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('arsip.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nomor',
                        name: 'nomor'
                    },
                    {
                        data: 'kategori',
                        name: 'kategori'
                    },
                    {
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'waktu',
                        name: 'waktu'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                columnDefs: [{
                        searchable: false,
                        orderable: false,
                        targets: [0, 5]
                    },
                    {
                        width: '1%',
                        targets: [0, 5]
                    },
                ],
                order: [
                    // [4, 'desc']
                ],
                oLanguage: {
                    sUrl: "/vendor/dataTables/indonesian.json"
                },
                bLengthChange: false,
                bFilter: false,
            });

            /* Button Pencarian */
            $('#btnCari').click(function() {
                var word = $('#pencarian').val();
                if (!word) {
                    word = '0';
                }
                table.ajax.url("/arsip/cari/" + word).load();
            });

            /* Button Hapus */
            $('body').on('click', '#btnDelete', function() {
                var this_id = $(this).data("id");
                Swal.fire({
                    title: 'Data yang berkaitan akan terhapus secara keseluruhan! <br> Apakah anda ingin menghapus data ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/arsip/delete/" + this_id,
                            type: 'post',
                            data: {
                                "id": this_id,
                            },
                            success: function(data) {
                                table.ajax.reload();
                                Swal.fire({
                                    title: data.msg,
                                    icon: "success",
                                });
                            }
                        });
                    }
                });
            });

        });
    </script>
@endsection
