<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PenerimaBantuan;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class PenerimaBantuanIndex extends Component
{
    use WithPagination;

    public $nik, $nama, $jenis_kelamin, $alamat, $desa, $pekerjaan;
    public $isEdit = false;
    public $editId;

    public $search = '';
    public $perPage = 5;

    protected $paginationTheme = 'tailwind'; // Untuk Tailwind (jika pakai Laravel Breeze, Jetstream, dll)

    public function render()
    {
        $query = PenerimaBantuan::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('nik', 'like', '%' . $this->search . '%')
                  ->orWhere('desa', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.penerima-bantuan-index', [
            'data' => $query->latest()->paginate($this->perPage)
        ]);
    }

    public function simpan()
    {
        $this->validate([
            'nik' => 'required|numeric',
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'desa' => 'required|string',
            'pekerjaan' => 'required|string',
        ]);

        if ($this->isEdit && $this->editId) {
            $item = PenerimaBantuan::find($this->editId);
            $item->update([
                'nik' => $this->nik,
                'nama' => $this->nama,
                'jenis_kelamin' => $this->jenis_kelamin,
                'alamat' => $this->alamat,
                'desa' => $this->desa,
                'pekerjaan' => $this->pekerjaan,
            ]);
            session()->flash('message', 'Data berhasil diperbarui.');
        } else {
            PenerimaBantuan::create([
                'nik' => $this->nik,
                'nama' => $this->nama,
                'jenis_kelamin' => $this->jenis_kelamin,
                'alamat' => $this->alamat,
                'desa' => $this->desa,
                'pekerjaan' => $this->pekerjaan,
            ]);
            session()->flash('message', 'Data berhasil disimpan.');
        }

        $this->resetInput();
    }

    public function edit($id)
    {
        $data = PenerimaBantuan::find($id);
        $this->editId = $data->id;
        $this->nik = $data->nik;
        $this->nama = $data->nama;
        $this->jenis_kelamin = $data->jenis_kelamin;
        $this->alamat = $data->alamat;
        $this->desa = $data->desa;
        $this->pekerjaan = $data->pekerjaan;
        $this->isEdit = true;
    }

    public function hapus($id)
    {
        PenerimaBantuan::destroy($id);
        $this->resetInput();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    private function resetInput()
    {
        $this->nik = '';
        $this->nama = '';
        $this->jenis_kelamin = '';
        $this->alamat = '';
        $this->desa = '';
        $this->pekerjaan = '';
        $this->isEdit = false;
        $this->editId = null;
    }
}