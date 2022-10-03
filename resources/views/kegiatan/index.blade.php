@extends('layouts.default')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data Kegiatan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kegiatan Harian</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="row">
            <div class="col-12">
                {{-- table data absen --}}
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between mb-0">
                        <h5 class="card-title">Tabel Kegiatan</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                            Tambah
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table datatable" id="projekTable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Projek</th>
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            {{ $item->projek->nama_projek }}
                                        </td>
                                        <td>
                                            {{ $item->kegiatan }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-light rounded-pill" title="Ubah"
                                                id='edit' name='edit' data-bs-toggle="modal"
                                                data-bs-target="#editModal"
                                                data-bs-act="{{ route('kegiatan-harian.update', $item->id) }}"
                                                data-bs-kegiatan="{{ $item->kegiatan }}"
                                                data-bs-projek_id="{{ $item->projek_id }}">
                                                <i class="ri-edit-2-line"></i></button>
                                            <button type="button" class="btn btn-light rounded-pill" title="Hapus"
                                                id="hapus" name="hapus" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                data-bs-act="{{ route('kegiatan-harian.destroy', $item->id) }}"
                                                data-bs-id="{{ $item->id }}"
                                                data-bs-name="{{ $item->projek->nama_projek }}">
                                                <i class="ri-delete-bin-line"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Modal tambah --}}
                <div class="modal fade" id="addModal" tabindex="-1">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Kegiatan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form class="row g-3 needs-validation" action="{{ route('kegiatan-harian.store') }}"
                                method="post" novalidate>
                                @csrf
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="deskripsi" class="form-label">Hari</label>
                                            <input class="form-control" id="tanggal" name="tanggal"
                                                value="{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label for="nama_projek" class="form-label">Nama Projek</label>
                                            <select class="form-select" aria-label="Nama Projek" name="projek_id"
                                                id="projek_id">
                                                <option selected disabled>Pilih salah satu</option>
                                                @foreach ($projek as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_projek }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="kegiatan" class="form-label">Kegiatan</label>
                                            <textarea class="form-control" id="kegiatan" name="kegiatan" style="height: 150px;"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Modal edit --}}
                <div class="modal fade" id="editModal" tabindex="-1">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Ubah Kegiatan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form class="row g-3 needs-validation" id="update-form" action="/" method="post"
                                novalidate>
                                @csrf
                                @method('put')
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="deskripsi" class="form-label">Hari</label>
                                            <input class="form-control" id="tanggal" name="tanggal"
                                                value="{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}"
                                                readonly>
                                        </div>
                                        <div class="col-12">
                                            <label for="nama_projek" class="form-label">Nama Projek</label>
                                            <select class="form-select" aria-label="Nama Projek" name="projek_id"
                                                id="projek_id">
                                                <option selected disabled>Pilih salah satu</option>
                                                @foreach ($projek as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_projek }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="kegiatan" class="form-label">Kegiatan</label>
                                            <textarea class="form-control" id="kegiatan" name="kegiatan" style="height: 150px;"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Modal hapus --}}
                <div class="modal fade" id="deleteModal" tabindex="-1">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form class="row g-3 needs-validation" id="delete-form" action="/" method="post"
                                novalidate>
                                @csrf
                                @method('delete')
                                <div class="modal-body">
                                    <p class="text-center">
                                        Yakin untuk menghapus kegiatan projek <strong
                                            class="badge border-danger border-1 text-danger" id="nama-projek"> </strong>?
                                    </p>
                                    <div class="alert alert-danger text-center" role="alert">
                                        <i class="bi bi-exclamation-octagon me-1"></i>
                                        <span class=""> Perhatian! Data tidak dapat dikembalikan.</span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-success">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('page-script')
    <script>
        $(function() {
            // switch button
            $('#status').click(function() {
                var active = $(this).prop('checked') == true ? 1 : 0;
                $('#status').val(active);
            });

            // modal edit
            $('#editModal').bind('show.bs.modal', event => {
                const updateForm = $('form#update-form');
                const updateButton = $(event.relatedTarget);

                updateForm.attr('action', updateButton.attr('data-bs-act'));
                updateForm.find('#projek_id').val(updateButton.attr('data-bs-projek_id'));
                updateForm.find('#kegiatan').val(updateButton.attr('data-bs-kegiatan'));
            }).bind('hide.bs.modal', e => {
                const updateForm = $('form#update-form');
                updateForm.attr('action', '/');
                updateForm[0].reset();
            });

            // delete modal
            $('#deleteModal').bind('show.bs.modal', event => {
                const delButton = $(event.relatedTarget);
                const delForm = $('form#delete-form');
                delForm.attr('action', delButton.attr('data-bs-act'));
                delForm.find('#nama-projek').text('"' + delButton.attr('data-bs-name') + '"')
            })

        });
    </script>
@endsection
