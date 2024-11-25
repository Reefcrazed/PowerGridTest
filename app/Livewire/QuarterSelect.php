<?php

namespace App\Livewire;

use Illuminate\Support\Carbon;
use Livewire\Component;
use App\Models\Payment;

class QuarterSelect extends Component
{
    public $quarter;
    public $year;
    
    public function mount()
    {
        session()->get('quarter') == "" ? $this->quarter = Carbon::now()->quarter : $this->quarter = session()->get('quarter');
        session()->get('year') == "" ? $this->year = Carbon::now()->year : $this->year = session()->get('year');
    }


    public function saveState($control, $val) 
    {
        $this->dispatch('change-dropdown', quarter: $this->quarter, year: $this->year)->to(PaymentTable::class);
    }

    public function render()
    {
        return view('livewire.quarter-select');
    }
}
