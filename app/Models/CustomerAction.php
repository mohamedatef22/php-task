<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAction extends Model
{
    use HasFactory;

    const CALL_ACTION = 'action';
    const VISIT_ACTION = 'visit';
    const FOLLOW_UP_ACTION = 'follow_up';

    protected $table = "customer_action";

    protected $fillable = [
        'employee_id',
        'customer_id',
        'action',
        'result'
    ];

}
