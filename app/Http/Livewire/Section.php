<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Section extends Component
{

    public $addMore = [1];
    public $count = 0;

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

    public function render()
    {
        return view('livewire.section');
    }
}
