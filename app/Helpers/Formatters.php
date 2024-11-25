<?php

use Illuminate\Support\Carbon;

if (!function_exists('dateSQLformat')) {
    
    function dateSQLformat($formatted_date)
    {
        if ($formatted_date == "") {
            return null;
        }
        
        $mysql_date = Carbon::parse($formatted_date)->format('Y-m-d H:i:s');

        return $mysql_date;
    }

    function moneySQLformat($formatted_money)
    {
        $mysql_money = preg_replace('/[$,]/', '', $formatted_money);

        if ($mysql_money == null) {
            $mysql_money = 0;
        }

        return $mysql_money;
    }

    function moneyFormat($value) {
        if (is_null($value)) {
            return '$0.00'; // Default to zero if the value is null
        }

        // Remove non-numeric characters except for the decimal point
        $amount = preg_replace('/[^\d\-.]/', '', $value);

        // Ensure only one decimal point is present
        $parts = explode('.', $amount);
        if (count($parts) > 2) {
            $amount = $parts[0] . '.' . implode('', array_slice($parts, 1));
        } else {
            $amount = implode('.', $parts);
        }

        // Convert to float to ensure proper formatting
        if (is_numeric($amount)) {
            $amount = (float) $amount;
            return '$' . number_format($amount, 2, '.', ',');
        } else {
            return '$0.00'; // Default to zero if the amount is invalid
        }
    }

    function formatAccountNumber($account_number)
    {
        if (!$account_number) {
            return NULL;
        }

        $replaced = str_repeat('*', strlen($account_number) - 4) . substr($account_number, -4);

        return  $replaced;
    }
}