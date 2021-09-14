<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Karyawan;
use Livewire\WithPagination;

class Karyawans extends Component
{
    use WithPagination;

    public $karyawan;
    public $search = '';
    public $perPage = 10;
    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $karyawan_id, $name, $bonus, $deleteId;
    public $isModal = 0, $deleteConfirmation = false;
    public $input = [];

    public $i = 1;

    public function render()
    {   
        $karyawan = Karyawan::query()
        ->search($this->search)
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);
        return view('livewire.karyawan.karyawans', [
            'karyawans' => $karyawan,
        ]);
    }

    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc'){
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->input, $i);
    }

    public function remove($i)
    {
        unset($this->input[$i]);
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function resetFields()
    {
        $this->name = '';
        $this->bonus = '';
        $this->karyawan_id = '';
    }

    public function openModal()
    {
        $this->isModal = true;
    }

    public function closeModal()
    {
        $this->isModal = false;
    }

    public function store()
    {

        $this->validate([
            'name'    => "required|string",
            'bonus' => "required",
        ]);

        $result = Karyawan::updateOrCreate(['id' => $this->karyawan_id ],
               [
                 'name' => $this->name,
                 'bonus' => $this->bonus,
                ]);

        session()->flash('message', $this->karyawan ? 'About Update Successfully' : 'About Created Successfully');

        $this->closeModal();
        $this->resetFields();
        // session()->flash('message', $this->)
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $this->name = $karyawan->name;
        $this->bonus = $karyawan->bonus;
        $this->karyawan_id = $id;
        $this->openModal();
    }

    public function openDeleteModal($id)
    {
        $this->deleteId = $id;
        $this->deleteConfirmation = true;
    }

    public function closeDeleteModal()
    {
        $this->deleteConfirmation = false;
        $this->resetFields();
    }

    public function delete($id)
    {
        $karyawan = Karyawan::find($id);
        $result = $karyawan->delete();
        if($result != "0") {
            session()->flash('message', 'Berhasil menghapus data');
        } else {
            session()->flash('errMessage', 'gagal menghapus data');
        }

        $this->closeDeleteModal();
    }
}
