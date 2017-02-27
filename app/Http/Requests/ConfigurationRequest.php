<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ConfigurationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'currency' => 'required',
            'gender' => 'required'
        ];
        /*
            $table->enum('active',['yes','no'])->default('yes');
            $table->string('currency');
            $table->string('currency_code');
            $table->string('sender_email');
            $table->string('sender_name');
            $table->string('receiver_email');
            damas, caballeros, ambos = 0, 1 y 2
            */
    }
}
