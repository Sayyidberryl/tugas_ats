@extends('templates.app', ['title' => 'ADD|PEKU.ID'])
@section('dynamic-content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Tambah Pengeluran</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('cost.add.store') }}" method="POST">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ol>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                    </ol>
                            @endforeach
                    </div>
                    @endif
                    {{-- 
                        aturan form menambahkan/mengubah/hapus :
                        1.Method  POST
                        2.name diambil dari nama_field migration 
                        3.harus ada @csrf dibawah <form> headers token mengirim data
                        4.form search,action halaman return view,form selain search isi action harus bebeda dengan return view    
                        --}}
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="text" name="jumlah" id="jumlah" class="form-control"
                            value="{{ old('jumlah') }}" onkeyup="formatRupiah(this)">
                    </div> 
                    <div class="form-group">
                        <label for="jenis" class="form-label">Jenis</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option hidden selected disabled>Pilih </option>
                            <option value="kebutuhan" {{ old('type') == 'keinginan' ? 'selected' : ' ' }}>Kebutuhan</option>
                            <option value="keinginan" {{ old('type') == 'kebutuhan' ? 'selected' : '' }}>Keinginan</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <style>
        .card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            padding: 0.75rem 1rem;
        }

        .card-body {
            padding: 1rem;
        }

        .form-group {
            margin-bottom: 0.75rem;
        }

        .form-control {
            border-radius: 6px;
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.15rem rgba(0, 123, 255, 0.25);
        }

        select.form-control {
            background-position: right 0.75rem center;
            background-size: 0.8em;
        }

        label {
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .btn-success {
            padding: 0.5rem 1.5rem;
            font-size: 0.9rem;
            border-radius: 6px;
        }

        @media (min-width: 768px) {
            .col-md-6 {
                max-width: 450px;
            }
        }
    </style>
     <script>
        function formatRupiah(input) {
    let angka = input.value.replace(/[^,\d]/g, '').toString();
    let rupiah = '';
    let ribuan = angka.length > 3 ? angka.substr(0, angka.length % 3) + '.' + angka.substr(angka.length % 3).match(/\d{3}/g).join('.') : angka;
    input.value = 'Rp ' + ribuan;
}
    </script>
@endsection
