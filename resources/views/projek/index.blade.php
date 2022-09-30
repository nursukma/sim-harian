@extends('layouts.default')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data Projek</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Projek</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="row">
            <div class="col-12">
                {{-- table data absen --}}
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between mb-0">
                        <h5 class="card-title">Tabel Projek</h5>
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
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            {{ $item->nama_projek }}
                                        </td>
                                        <td>
                                            {{ $item->deskripsi }}
                                        </td>
                                        <td>
                                            {{ $item->keterangan }}
                                        </td>
                                        <td>
                                            @if ($item->status == true)
                                                <form action="{{ route('projeks.belum', $item->id) }}" method="post">
                                                    @method('put')
                                                    @csrf
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="status"
                                                            name="status" title="Selesai" checked onclick="submit()">
                                                    </div>
                                                </form>
                                            @else
                                                <form action="{{ route('projeks.selesai', $item->id) }}" method="post">
                                                    @method('put')
                                                    @csrf
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="status"
                                                            name="status" title="Belum Selesai" onclick="submit()">
                                                    </div>
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-light rounded-pill" title="Ubah"
                                                id='edit' name='edit' data-bs-toggle="modal"
                                                data-bs-target="#editModal"
                                                data-bs-act="{{ route('projeks.update', $item->id) }}"
                                                data-bs-nama_projek="{{ $item->nama_projek }}"
                                                data-bs-deskripsi="{{ $item->deskripsi }}"
                                                data-bs-keterangan="{{ $item->keterangan }}">
                                                <i class="ri-edit-2-line"></i></button>
                                            <button type="button" class="btn btn-light rounded-pill" title="Hapus"
                                                id="hapus" name="hapus" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                data-bs-act="{{ route('projeks.destroy', $item->id) }}"
                                                data-bs-id="{{ $item->id }}" data-bs-name="{{ $item->nama_projek }}">
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
                                <h5 class="modal-title">Tambah Projek</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form class="row g-3 needs-validation" action="{{ route('projeks.store') }}" method="post"
                                novalidate>
                                @csrf
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="nama_projek" class="form-label">Nama Projek</label>
                                            <input type="text" class="form-control" id="nama_projek" name="nama_projek">
                                        </div>
                                        <div class="col-12">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" id="deskripsi" name="deskripsi" style="height: 100px;"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <label for="deskripsi" class="form-label">Keterangan</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan" style="height: 100px;"></textarea>
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

                {{-- Modal edit --}}
                <div class="modal fade" id="editModal" tabindex="-1">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Ubah Projek</h5>
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
                                            <label for="nama_projek" class="form-label">Nama Projek</label>
                                            <input type="text" class="form-control" id="nama_projek"
                                                name="nama_projek">
                                        </div>
                                        <div class="col-12">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" id="deskripsi" name="deskripsi" style="height: 100px;"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <label for="deskripsi" class="form-label">Keterangan</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan" style="height: 100px;"></textarea>
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
                    <div class="modal-dialog modal-sm modal-dialog-centered">
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
                                        Yakin untuk menghapus <strong class="badge border-danger border-1 text-danger"
                                            id="nama-projek"> </strong>?
                                    </p>
                                    <div class="alert alert-danger" role="alert">
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
                updateForm.find('#nama_projek').val(updateButton.attr('data-bs-nama_projek'));
                updateForm.find('#deskripsi').val(updateButton.attr('data-bs-deskripsi'));
                updateForm.find('#keterangan').val(updateButton.attr('data-bs-keterangan'));
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
