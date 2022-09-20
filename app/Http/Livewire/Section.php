<?php

namespace App\Http\Livewire;

use App\Models\Section as ModelsSection;
use Livewire\Component;

class Section extends Component
{

    public $addMore = [1];
    public $count = 0;
    public $section_name, $section_status, $edit_id;

    public $checked = [], $selectAll = false;

    // Add More

    public function AddMore()
    {
        $countable =  $this->count++;

        if ($countable < 4) {

            $this->addMore[] = count($this->addMore) + 1;
        }
    }

    // Remove More
    public function Remove($index)
    {

        $this->count--;
        unset($this->addMore[$index]);
    }

    protected $listeners = ['RecordDeleted'];

    public function store()
    {
        foreach ($this->section_name as $key => $section) {
            ModelsSection::create([
                'section_name' => $this->section_name[$key],
                'status' => $this->section_status[$key] ?? 0 //if the status is empty 0 else
            ]);
        }

        $this->FormReset();
        $this->SwalMessageDialog('Section Created Successfully!');
    }



    public function editSection($section_id)
    {
        $this->edit_id = $section_id;
        $section = ModelsSection::findOrFail($section_id);
        $this->section_name = $section->section_name;
        $this->section_status = $section->status;
    }

    public function update($section_id)
    {

        ModelsSection::updateOrCreate(['id' => $this->edit_id], [
            'section_name' => $this->section_name,
            'status' => $this->section_status ?? 0 //if the status is empty 0 else
        ]);

        $this->FormReset();
        $this->SwalMessageDialog('Section Updated Successfully!');
    }

    public function isChecked($section_id)
    {

        return  $this->checked && $this->selectAll ?
            in_array($section_id,  $this->checked) :
            in_array($section_id, $this->checked);
    }

    public function updatedSelectAll($value_in_array)
    {

        $value_in_array ? $this->checked =  ModelsSection::pluck('id') : $this->checked = [];
    }

    public function ConfirmBulkDeleted()
    {
        $this->dispatchBrowserEvent('swal:DeletedRecord', [
            'title' => "Are you sure you want to delete All ? ",
            'id'  => $this->checked
        ]);
    }

    // Delete Dialog Show

    public function ConfirmDelete($section_id, $section_name)
    {

        $this->dispatchBrowserEvent('swal:DeletedRecord', [
            'title' => "Are you sure you want to delete <span class='text-danger'> $section_name </span>",
            'id'  => $section_id
        ]);
    }


    // Delete Section

    public function RecordDeleted($section_id)
    {
        if ($this->checked) {
            ModelsSection::whereIn('id', $this->checked)->delete();
            $this->checked = []; $this->selectAll = false;
        }else {
            $section = ModelsSection::find($section_id); //Single Delete
            $section->delete();
        }

    }

    public function FormReset()
    {
        $this->section_name = '';
        $this->section_status = '';
        $this->addMore = [1];

        $this->dispatchBrowserEvent("closeModel");
    }

    public function SwalMessageDialog($message)
    {
        $this->dispatchBrowserEvent(
            'MSGSuccessfull',
            [
                'title' => $message,
            ]
        );
    }

    public function render()
    {
        return view('livewire.section', ['sections' => ModelsSection::all()]);
    }
}
