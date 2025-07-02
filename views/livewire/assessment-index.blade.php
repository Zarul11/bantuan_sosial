<div class="p-4 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Form Assessment</h2>

    @if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="simpan" class="space-y-2">
        <div>
            <label for="penerima_id">Penerima</label>
            <select wire:model="penerima_id" class="form-control">
                <option value="">-- Pilih Penerima --</option>
                @foreach($penerimas as $penerima)
                <option value="{{ $penerima->id }}">{{ $penerima->nama }}</option>
                @endforeach
            </select>
        </div>

        <input type="date" wire:model="tanggal" placeholder="Tanggal" class="form-control">
        <input type="number" wire:model="pendapatan" placeholder="Pendapatan" class="form-control">
        <input type="number" wire:model="jumlah_tanggungan" placeholder="Jumlah Tanggungan" class="form-control">

        <select wire:model="kondisi_rumah" class="form-control">
            <option value="">-- Kondisi Rumah --</option>
            <option value="Baik">Baik</option>
            <option value="Sedang">Sedang</option>
            <option value="Buruk">Buruk</option>
        </select>

        <select wire:model="status_layak" class="form-control">
            <option value="">-- Status Layak --</option>
            <option value="1">Layak</option>
            <option value="0">Tidak Layak</option>
        </select>

        <textarea wire:model="catatan" placeholder="Catatan" class="form-control"></textarea>

        <button type="submit" class="btn btn-primary">
            {{ $isEdit ? 'Update' : 'Simpan' }}
        </button>
    </form>

    <hr class="my-4">

    <h3 class="text-lg font-bold mb-2">Data Assessment</h3>
    <table class="table table-bordered w-full">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Pendapatan</th>
                <th>Tanggungan</th>
                <th>Kondisi Rumah</th>
                <th>Status Layak</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->penerima->nama }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->pendapatan }}</td>
                <td>{{ $item->jumlah_tanggungan }}</td>
                <td>{{ $item->kondisi_rumah }}</td>
                <td>{{ $item->status_layak ? 'Layak' : 'Tidak Layak' }}</td>
                <td>{{ $item->catatan }}</td>
                <td>
                    <button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-warning">Edit</button>
                    <button wire:click="hapus({{ $item->id }})" class="btn btn-sm btn-danger">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    {{ $data->links() }}
</div>