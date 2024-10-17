@extends('templates.app', ['title' => 'Cost || Pengeluaranku'])

@section('dynamic-content')
    <div class="my-3">
        <a href="{{ route('cost.add') }}" class="btn btn-success mb-3">+ Tambah</a>
        @if (Session::get('success'))
            <div class="alert alert-success my-2">{{ Session::get('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ol>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
        @endif
        <table class="table table-bordered table-stripped text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>jumlah pengeluaran</th>
                    <th>jenis</th>
                    <th>Tindakan</th>
                 
                </tr>
            </thead>
            <tbody>
                @if (count($costs) > 0)
                    @foreach ($costs as $index => $item)
                        <tr>
                            <td>{{ ($costs->currentPage() - 1) * $costs->perpage() + ($index + 1) }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ 'Rp ' . number_format($item['jumlah'], 0, ',', '.') }}</td> <!-- Format rupiah -->
                            <td>{{ $item['jenis'] }}</td>
            
                            <td class="d-flex justify-content-center py-1">
                                <a href="{{ route('cost.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                                <button class="btn btn-danger"
                                    onclick="showModal('{{ $item->id }}', '{{ $item->name }}')">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-bold">Data Obat Kosong</td>
                    </tr>
                @endif
            </tbody>
            
        </table>
        <div class="d-flex justify-content-end mt-3">
            
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="form-delete-obat" method="POST">
                    @csrf
                    {{-- menimpa method="POST" diganti menjadi delete, sesuai dengan http method untuk menghapus data --}}
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus data user <span id="nama-obat"></span>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            {{-- save change dibuat type="submit" agar form di modal bisa jalanin action --}}
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
     function showModal(id, name) {
            // isi untuk action form
            let action = '{{ route('cost.delete', ':id') }}';
            action = action.replace(':id', id);
            // buat attribute action pada form
            $('#form-delete-obat').attr('action', action);
            // munculkan modal yg id nya exampleModal
            $('#exampleModal').modal('show');
            // innerText pada element html id nama-obat
            $('#nama-obat').text(name);
        }
    </script>
@endpush
