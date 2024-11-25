<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $fillable = ['payment_date', 'payment_amount'];
    protected $forcedDateNullFields = ['payment_date', 'payment_amount'];

    public $incrementing = true;

    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->forcedDateNullFields) && $value === '') {
            $value = null;
        }

        return parent::setAttribute($key, $value);
    }
}