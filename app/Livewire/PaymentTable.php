<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Column;
use App\Rules\CustomMoney;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use App\Models\Payment;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class PaymentTable extends PowerGridComponent
{
    public string $tableName = 'payment-table';
    public bool $showErrorBag = true;

    public $quarter;
    public $year;

    public $payment_date = [];
    public $payment_amount = [];

    public function setUp(): array
    {
        session()->get('quarter') == "" ? $this->quarter = Carbon::now()->quarter : $this->quarter = session()->get('quarter');
        session()->get('year') == "" ? $this->year = Carbon::now()->year : $this->year = session()->get('year');

        return [
            PowerGrid::footer()
                ->showRecordCount(),
        ];
    }

    #[\Livewire\Attributes\On('change-dropdown')]
    public function changeDropdown($quarter, $year)
    {
        $this->quarter = $quarter;
        $this->year = $year;
    }

    public function datasource(): Builder
    {
        $payment = Payment::query()->from('payment as p')
                    ->where(DB::raw('QUARTER(payment_date)'), $this->quarter)
                    ->where(DB::raw('YEAR(payment_date)'), $this->year);

        return $payment;
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('payment_date', fn (Payment $model) => $model->payment_date == null ? '' : Carbon::parse($model->payment_date)->format('m/d/Y'))
            ->add('payment_amount', fn (Payment $model) => '$' . number_format($model->payment_amount, 2));
    }

    public function columns(): array
    {
        return [
            Column::make('Payment date', 'payment_date', 'payment_date')
            ->editOnClick(hasPermission: true, saveOnMouseOut: True),
            Column::make('Payment amount', 'payment_amount')
            ->editOnClick(hasPermission: true, saveOnMouseOut: True),
        ];
    }

    protected function rules()
    {
        return [
            'payment_date.*' => [
                'nullable', 'date',
            ],
            'payment_amount.*' => [
                new CustomMoney(),
            ],
        ];
    }

    protected function validationAttributes()
    {
        return [
            'payment_date.*'       => 'Payment Date',
            'payment_amount.*'       => 'Payment Amount',
        ];
    }


    public function onUpdatedEditable(string|int $id, string $field, string $value): void
    {
        $this->validate();
 
        if (in_array($field, ['payment_date'])) {
            $value =  dateSQLformat($value);
        }

        if (in_array($field, ['payment_amount'])) {
            $value =  moneySQLformat($value);
        }

        $updated = Payment::query()->find($id)->update([
            $field => e($value),
        ]);

       
    }

}
