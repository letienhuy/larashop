<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Trường following language lines contain Trường default error messages used by
    | Trường validator class. Some of Trườngse rules have multiple versions such
    | as Trường size rules. Feel free to tweak each of Trườngse messages here.
    |
    */

    'accepted'             => 'Trường :attribute must be accepted.',
    'active_url'           => 'Trường :attribute is not a valid URL.',
    'after'                => 'Trường :attribute must be a date after :date.',
    'after_or_equal'       => 'Trường :attribute must be a date after or equal to :date.',
    'alpha'                => 'Trường :attribute may only contain letters.',
    'alpha_dash'           => 'Trường :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'Trường :attribute may only contain letters and numbers.',
    'array'                => 'Trường :attribute must be an array.',
    'before'               => 'Trường :attribute must be a date before :date.',
    'before_or_equal'      => 'Trường :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'Trường :attribute must be between :min and :max.',
        'file'    => 'Trường :attribute must be between :min and :max kilobytes.',
        'string'  => 'Trường :attribute must be between :min and :max characters.',
        'array'   => 'Trường :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'Trường :attribute field must be true or false.',
    'confirmed'            => 'Trường :attribute confirmation does not match.',
    'date'                 => 'Trường :attribute is not a valid date.',
    'date_format'          => 'Trường :attribute does not match Trường format :format.',
    'different'            => 'Trường :attribute and :oTrườngr must be different.',
    'digits'               => 'Trường :attribute must be :digits digits.',
    'digits_between'       => 'Trường :attribute must be between :min and :max digits.',
    'dimensions'           => 'Trường :attribute has invalid image dimensions.',
    'distinct'             => 'Trường :attribute field has a duplicate value.',
    'email'                => 'Vui lòng nhập email hợp lệ.',
    'exists'               => 'Trường selected :attribute is invalid.',
    'file'                 => 'Trường :attribute must be a file.',
    'filled'               => 'Trường :attribute field must have a value.',
    'image'                => 'Vui lòng chọn hình ảnh hợp lệ.',
    'in'                   => 'Trường selected :attribute is invalid.',
    'in_array'             => 'Trường :attribute field does not exist in :oTrườngr.',
    'integer'              => 'Trường :attribute phải là số.',
    'ip'                   => 'Trường :attribute must be a valid IP address.',
    'ipv4'                 => 'Trường :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'Trường :attribute must be a valid IPv6 address.',
    'json'                 => 'Trường :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'Trường :attribute không được vượt quá :max.',
        'file'    => 'Trường :attribute không được vượt quá :max kilobytes.',
        'string'  => 'Trường :attributekhông được vượt quá :max kí tự.',
        'array'   => 'Trường :attribute không được có quá :max phần tử.',
    ],
    'mimes'                => 'Trường :attribute must be a file of type: :values.',
    'mimetypes'            => 'Trường :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'Trường :attribute có độ dài ít nhất :min.',
        'file'    => 'Trường :attribute phải ít nhất :min kilobytes.',
        'string'  => 'Trường :attribute phải ít nhất :min kí tự.',
        'array'   => 'Trường :attribute phải có ít nhất :min phần tử.',
    ],
    'not_in'               => 'Trường selected :attribute is invalid.',
    'numeric'              => 'Trường :attribute phải là số.',
    'present'              => 'Trường :attribute field must be present.',
    'regex'                => 'Trường :attribute format is invalid.',
    'required'             => 'Trường :attribute là bắt buộc.',
    'required_if'          => 'Trường :attribute field is required when :oTrườngr is :value.',
    'required_unless'      => 'Trường :attribute field is required unless :oTrườngr is in :values.',
    'required_with'        => 'Trường :attribute field is required when :values is present.',
    'required_with_all'    => 'Trường :attribute field is required when :values is present.',
    'required_without'     => 'Trường :attribute field is required when :values is not present.',
    'required_without_all' => 'Trường :attribute field is required when none of :values are present.',
    'same'                 => 'Trường :attribute and :oTrườngr must match.',
    'size'                 => [
        'numeric' => 'Trường :attribute must be :size.',
        'file'    => 'Trường :attribute must be :size kilobytes.',
        'string'  => 'Trường :attribute must be :size characters.',
        'array'   => 'Trường :attribute must contain :size items.',
    ],
    'string'               => 'Trường :attribute must be a string.',
    'timezone'             => 'Trường :attribute must be a valid zone.',
    'unique'               => 'Trường :attribute has already been taken.',
    'uploaded'             => 'Trường :attribute failed to upload.',
    'url'                  => 'Trường :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using Trường
    | convention "attribute.rule" to name Trường lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'fullname' => [
            'required' => 'Họ và tên là bắt buộc!',
        ],
        'name' => [
            'required' => 'Trường tên là bắt buộc!',
        ],
        'phone' => [
            'required' => 'Số điện thoại là bắt buộc!',
        ],
        'city' => [
            'required' => 'Tỉnh, thành phố là bắt buộc!',
        ],
        'district' => [
            'required' => 'Quận, huyện là bắt buộc!',
        ],
        'commune' => [
            'required' => 'Xã, phường, thị trấn là bắt buộc!',
        ],
        'street' => [
            'required' => 'Địa chỉ chi tiết là bắt buộc!',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | Trường following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
