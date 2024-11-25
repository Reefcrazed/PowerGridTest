<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Payment;

class QuarterSelect extends Component
{
    public $quarter;
    public $year;
    


    public function saveState($control, $val) 
    {
        $this->dispatch('change-dropdown', quarter: $this->quarter, year: $this->year)->to(PaymentTable::class);
    }

    public function render()
    {
        return view('livewire.quarter-select');
    }
}
