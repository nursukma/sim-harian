@extends('layouts.default')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Absensi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Absen</a></li>
                    <li class="breadcrumb-item active">Datang</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="row">
            <div class="col-12">
                {{-- table data absen --}}
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between mb-0">
                        <h5 class="card-title">Absen Bosss <span>supaya disiplin ya :)</span></h5>
                    </div>
                    <div class="card-body">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Absen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            {{ $item->user->name }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}
                                        </td>
                                        <td>
                                            @if ($item->status == true)
                                                <span class="badge rounded-pill bg-success">Masuk</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger">Bolos</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (\Carbon\Carbon::parse($item->created_at)->translatedFormat('d') != \Carbon\Carbon::now()->format('d'))
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="status"
                                                        name="status" title='Masuk' onclick="return false;">
                                                </div>
                                            @elseif($item->status == true)
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="status"
                                                        name="status" title='Masuk' checked onclick="return false;">
                                                </div>
                                            @else
                                                <form action="{{ route('absens-datang.update', $item->user_id) }}"
                                                    method="post">
                                                    @method('put')
                                                    @csrf
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="status"
                                                            name="status" title="Belum Absen" onclick="submit()">
                                                    </div>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('page-script')
    <script>
        $(function() {
            $('#status').click(function() {
                var active = $(this).prop('checked') == true ? 1 : 0;
                $('#status').val(active);
            });
        });
    </script>
@endsection
