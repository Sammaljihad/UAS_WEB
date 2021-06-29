@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('surat-masuk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_surat">Nomor Surat</label>
                                <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror"
                                    name="nomor_surat" id="nomor_surat" value="{{ $nomor_surat }}" readonly>
                                @error('nomor_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_surat">Tanggal Surat</label>
                                <input type="date" class="form-control @error('tanggal_surat') is-invalid @enderror"
                                    name="tanggal_surat">
                                @error('tanggal_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pengirim">Nama Pengirim</label>
                                <input type="text" class="form-control @error('pengirim') is-invalid @enderror"
                                    name="pengirim" id="pengirim" placeholder="Masukan nama pengirim">
                                @error('pengirim')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar Surat</label>
                        <div class="mb-3">
                            <img src="{{ asset('images/no_image.jpg') }}" alt="" srcset="" width="100" id="lihat-gambar">
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="gambar" id="gambar">
                            <label class="custom-file-label" for="gambar">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary">Simpan</button>
                        <a href="{{ route('surat-masuk.index') }}" class="form-control btn btn-warning mt-3">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const loadFile = (event) => {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };

        $(document).ready(function() {
            $('#table-surat-masuk').DataTable()

            $('#gambar').on('change', function(e){
                $('#lihat-gambar').attr('src', URL.createObjectURL(e.target.files[0]))
            })
        })
    </script>
@endsection
