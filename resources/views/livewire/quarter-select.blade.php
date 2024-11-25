<div class="grid grid-cols-6 gap-2">
<div class="shadow-md rounded-lg grid grid-rows-2 grid-cols-2 grid-flow-col gap-y-1 p-2">
    <label class="form-label-left font-extrabold">Quarter:</label>
    <label class="form-label-left">Year:</label>
    <select wire:model.live="quarter" class="form-input-sm" wire:change="saveState('quarter', $event.target.value)">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>
    <select wire:model.live="year" class="form-input-sm" wire:change="saveState('year', $event.target.value)">
        @for ($val=date("Y")-10; $val<=date('Y')+1; $val++)
            <option>{{ $val }}</option>
        @endfor
    </select>
</div> 
@livewire('payment-table', ['quarter' => $quarter, 'year' => $year])
</div> 
