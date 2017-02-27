<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentsAccount extends Model
{
    use SoftDeletes;

    protected $table = "payments_accounts";
    
    protected $fillable = ['bank_name', 'bank_account_number', 'bank_account_type', 'owner_name', 'owner_id', 'owner_email', 'active'];

    protected $dates = ['deleted_at'];
 

}
