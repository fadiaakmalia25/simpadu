@extends('template.main')

@section('content')
<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Data Prodi</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('prodi.index') }}">Data Prodi</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Prodi</h3>
                        </div>

                        <form action="{{ url('prodi', $prodi->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="nama" class="form-label">Nama Prodi</label>
                                    <input type="text" id="nama" name="nama"
                                           class="form-control @error('nama') is-invalid @enderror"
                                           value="{{ old('nama', $prodi->nama) }}">
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kaprodi" class="form-label">Kaprodi</label>
                                    <input type="text" id="kaprodi" name="kaprodi"
                                           class="form-control @error('kaprodi') is-invalid @enderror"
                                           value="{{ old('kaprodi', $prodi->kaprodi) }}">
                                    @error('kaprodi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jurusan" class="form-label">Jurusan</label>
                                    <input type="text" id="jurusan" name="jurusan"
                                           class="form-control @error('jurusan') is-invalid @enderror"
                                           value="{{ old('jurusan', $prodi->jurusan) }}">
                                    @error('jurusan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="card-footer">
                                <a href="{{ route('prodi.index') }}" class="btn btn-warning">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!--end::App Main-->
@endsection