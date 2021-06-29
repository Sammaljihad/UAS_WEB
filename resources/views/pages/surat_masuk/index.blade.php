@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="mb-4 float-right d-flex">
                    <a href="{{ route('surat-masuk.create') }}" class="btn btn-primary">Tambah surat </a>
                    <a href="{{ route('surat-masuk.print') }}" target="_blank" class="btn btn-info ml-2">Print </a>
                </div>
                <table class="table table-stripped table-hover" id="table-surat-masuk">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Surat</th>
                            <th scope="col">Pengirim</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_surat_masuk as $key => $surat_masuk)
                            <tr>
                                <td>
                                    <img src="{{ $surat_masuk->gambar }}" alt="" width="50">
                                </td>
                                <td style="vertical-align: middle">
                                    <strong>{{ $surat_masuk->nomor_surat }}</strong><br>
                                    Tanggal Surat : {{ date('d M Y', strtotime($surat_masuk->tanggal_surat)) }}
                                </td>
                                <td style="vertical-align: middle">{{ $surat_masuk->pengirim }}</td>
                                <td style="vertical-align: middle">
                                    <form action="{{ route('surat-masuk.destroy', $surat_masuk->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="{{ route('surat-masuk.edit', $surat_masuk->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#table-surat-masuk').DataTable()
        })
    </script>
@endsection
