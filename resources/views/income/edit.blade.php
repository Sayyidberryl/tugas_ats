@extends('templates.app', ['title' => 'Edit || PEKU.ID'])
@section('dynamic-content')
<style>
    body {
        background-color: #f8f9fa;
    }
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        margin: 2rem auto;
    }
    .card-header {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        padding: 15px;
    }
    .form-control, .form-select {
        border: 1px solid #ced4da;
        border-radius: 6px;
        padding: 8px 12px;
        font-size: 0.9rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .form-control:focus, .form-select:focus {
        border-color: #6a11cb;
        box-shadow: 0 0 0 0.2rem rgba(106, 17, 203, 0.25);
    }
    .btn-primary {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        border: none;
        padding: 8px 20px;
        font-size: 0.9rem;
        transition: all 0.3s;
    }
    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(106, 17, 203, 0.3);
    }
    .form-label {
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 0.3rem;
    }
</style>
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title text-center mb-0">Edit</h5>
        </div>
        <div class="card-body p-3">
            {{-- action route mengirim $item['id'] untuk spesifikasi data di route path{id} --}}
            <form action="{{ route('income.edit.update',$income['id']) }}" method="POST">
                @csrf
                {{-- http method route untuk ubah data --}}
                @method('PATCH')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $income['name'] }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $income['jumlah'] }}">
                    @error('jumlah')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis Pengeluaran</label>
                    <select name="jenis" id="jenis" class="form-select">
                        <option value="pasif" {{ $income['type'] == 'pasif' ? 'selected' : '' }}>pasif</option>
                        <option value="aktif" {{ $income['type'] == 'aktif' ? 'selected' : '' }}>aktif</option>
                    </select>
                    @error('jenis')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary rounded-pill">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
