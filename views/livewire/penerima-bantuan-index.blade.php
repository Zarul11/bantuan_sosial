<div class="p-4 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Form Penerima Bantuan</h2>

    @if (session()->has('message'))
    <div class="alert alert-success mb-3">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="simpan" class="space-y-2 mb-4">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <input type="text" wire:model="nik" placeholder="NIK" class="form-control">
            <input type="text" wire:model="nama" placeholder="Nama" class="form-control">
            <select wire:model="jenis_kelamin" class="form-control">
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
            <input type="text" wire:model="alamat" placeholder="Alamat" class="form-control">
            <input type="text" wire:model="desa" placeholder="Desa" class="form-control">
            <input type="text" wire:model="pekerjaan" placeholder="Pekerjaan" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">
            {{ $isEdit ? 'Update' : 'Simpan' }}
        </button>
    </form>

    <div class="mb-3 flex justify-between items-center">
        <input type="text" wire:model.debounce.300ms="search" class="form-control w-1/3"
            placeholder="Cari nama, NIK, desa...">

        <div>
            <label>Show</label>
            <select wire:model="perPage" class="form-select d-inline w-auto">
                <option value="3">3</option>
                <option value="5">5</option>
                <option value="10">10</option>
            </select>
            <span>entries</span>
        </div>
    </div>

    <table class="table table-bordered w-full">
        <thead class="table-light">
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Desa</th>
                <th>Pekerjaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
            <tr>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jenis_kelamin }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->desa }}</td>
                <td>{{ $item->pekerjaan }}</td>
                <td>
                    <button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-warning">Edit</button>
                    <button wire:click="hapus({{ $item->id }})" class="btn btn-sm btn-danger">Hapus</button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} results
        <div>
            {{ $data->links() }}
        </div>
    </div>
</div>