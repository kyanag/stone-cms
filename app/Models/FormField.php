<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Schema\ColumnDefinition;

class FormField extends Model
{
    //
    protected $guarded = [];

    protected $attributes = [
        'settings' => "[]",
        'rules' => "[]",
        'desc' => ""
    ];

    protected $casts = [
        'settings' => "json",
    ];

    public function form()
    {
        return $this->belongsTo(Form::class, "form_id", "id");
    }
}
