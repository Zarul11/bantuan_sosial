<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Assessment;
use App\Models\PenerimaBantuan;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class AssessmentIndex extends Component
{
    use WithPagination;

    public $penerima_id, $tanggal, $pendapatan, $jumlah_tanggungan, $kondisi_rumah, $status_layak, $catatan;
    public $isEdit = false, $editId;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        return view('livewire.assessment-index', [
            'data' => Assessment::with('penerima')->latest()->paginate(5),
            'penerimas' => PenerimaBantuan::all(),
        ]);
    }

    public function simpan()
    {
        $this->validate([
            'penerima_id' => 'required|exists:penerima_bantuan,id', // 
            'tanggal' => 'required|date',
            'pendapatan' => 'required|numeric',
            'jumlah_tanggungan' => 'required|numeric',
            'kondisi_rumah' => 'required|in:Baik,Sedang,Buruk',
            'status_layak' => 'required|boolean',
        ]);

        if ($this->isEdit && $this->editId) {
            $assessment = Assessment::findOrFail($this->editId);
            $assessment->update($this->getFormData());
            session()->flash('message', 'Data berhasil diperbarui.');
        } else {
            Assessment::create($this->getFormData());
            session()->flash('message', 'Data berhasil disimpan.');
        }

        $this->resetInput();
    }

    public function edit($id)
    {
        $item = Assessment::findOrFail($id);
        $this->editId = $item->id;
        $this->penerima_id = $item->penerima_id;
        $this->tanggal = $item->tanggal;
        $this->pendapatan = $item->pendapatan;
        $this->jumlah_tanggungan = $item->jumlah_tanggungan;
        $this->kondisi_rumah = $item->kondisi_rumah;
        $this->status_layak = $item->status_layak;
        $this->catatan = $item->catatan;
        $this->isEdit = true;
    }

    public function hapus($id)
    {
        Assessment::destroy($id);
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->penerima_id = null;
        $this->tanggal = null;
        $this->pendapatan = null;
        $this->jumlah_tanggungan = null;
        $this->kondisi_rumah = null;
        $this->status_layak = null;
        $this->catatan = null;
        $this->isEdit = false;
        $this->editId = null;
    }

    private function getFormData()
    {
        return [
            'penerima_id' => $this->penerima_id,
            'tanggal' => $this->tanggal,
            'pendapatan' => $this->pendapatan,
            'jumlah_tanggungan' => $this->jumlah_tanggungan,
            'kondisi_rumah' => $this->kondisi_rumah,
            'status_layak' => $this->status_layak,
            'catatan' => $this->catatan,
        ];
    }
}