<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 'position_number', 'subscription_number',
        'subscriber', 'address', 'counter_number',
        'previous_read','current_read', 'cups_consumption', 
        'shekels_consumption', 'counter_status', 'notes'
    ];
}
