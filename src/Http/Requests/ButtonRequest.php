<?php

namespace WireUi\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ButtonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'color'     => 'sometimes|string',
            'size'      => 'sometimes|string',
            'iconSize'  => 'sometimes|string',
            'label'     => 'sometimes|string',
            'rightIcon' => 'sometimes|string',
            'icon'      => 'sometimes|string',
            'rounded'   => 'sometimes|boolean',
            'squared'   => 'sometimes|boolean',
            'bordered'  => 'sometimes|boolean',
            'flat'      => 'sometimes|boolean',
        ];
    }
}
