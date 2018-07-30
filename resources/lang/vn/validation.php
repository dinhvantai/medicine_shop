<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ' :attribute cần được chấp nhận.',
    'active_url'           => ' :attribute không phải là địa chỉ chính xác.',
    'after'                => ' :attribute phải sau ngày :date.',
    'after_or_equal'       => ' :attribute phải sau hoặc trùng với ngày :date.',
    'alpha'                => ' :attribute chỉ chứa kí tự.',
    'alpha_dash'           => ' :attribute chỉ chứa kí tự, số, và dấu gạch dưới.',
    'alpha_num'            => ' :attribute chỉ chứa kí tự và số.',
    'array'                => ' :attribute phải là một mảng.',
    'before'               => ' :attribute phải trước ngày :date.',
    'before_or_equal'      => ' :attribute phải trước hoặc trùng với ngày :date.',
    'between'              => [
        'numeric' => ' :attribute phải trong khoảng :min và :max.',
        'file'    => ' :attribute phải trong khoảng :min và :max kilobyte.',
        'string'  => ' :attribute phải trong khoảng :min và :max kí tự.',
        'array'   => ' :attribute phải có trong khoảng :min và :max mục.',
    ],
    'boolean'              => ' :attribute phải ở dạng đúng hoặc sai.',
    'confirmed'            => ' :attribute xác nhận không đúng.',
    'date'                 => ' :attribute không phải là ngày hợp lệ.',
    'date_format'          => ' :attribute không đúng với định dạng :format.',
    'different'            => ' :attribute và :other phải khác nhau.',
    'digits'               => ' :attribute phải bao gồm :digits chữ số.',
    'digits_between'       => ' :attribute phải nằm trong khoảng :min và :max chữ số.',
    'dimensions'           => ' :attribute có kích thước hình ảnh không hợp lệ.',
    'distinct'             => ' trường :attribute chứa gía trị trùng lặp.',
    'email'                => ' :attribute phải là một địa chỉ email hợp lệ.',
    'exists'               => ' :attribute đã chọn không hợp lệ.',
    'file'                 => ' :attribute phải ở dạng tệp.',
    'filled'               => ' :attribute trường cần có gía trị.',
    'image'                => ' :attribute phải là ảnh hợp lệ.',
    'in'                   => ' :attribute đã chọn không hợp lệ.',
    'in_array'             => ' trường :attribute không tồn tại trong :other.',
    'integer'              => ' :attribute phải là số kiểu int.',
    'ip'                   => ' :attribute phải là địa chỉ IP hợp lệ.',
    'json'                 => ' :attribute phải là một chuỗi kiểu JSON hợp lê.',
    'max'                  => [
        'numeric' => ' :attribute không được phép lớn hơn :max.',
        'file'    => ' :attribute không được phép lớn hơn :max kilobyte.',
        'string'  => ' :attribute không được phép lớn hơn :max kí tự.',
        'array'   => ' :attribute không được phép quá :max mục.',
    ],
    'mimes'                => ' :attribute phải là tệp dạng: :values.',
    'mimetypes'            => ' :attribute mphải là tệp dạng: :values.',
    'min'                  => [
        'numeric' => ' :attribute phải ít nhất là :min.',
        'file'    => ' :attribute phải ít nhất là :min kilobyte.',
        'string'  => ' :attribute phải ít nhất là :min kí tự.',
        'array'   => ' :attribute phải ít nhất là :min mục.',
    ],
    'not_in'               => ' :attribute đã chọn không hợp lệ.',
    'numeric'              => ' :attribute phải ở dạng số.',
    'present'              => ' :attribute là trường bắt buộc.',
    'regex'                => ' :attribute định dạng không đúng.',
    'required'             => ' :attribute là trường bắt buộc.',
    'required_if'          => ' :attribute là trường bắt buộc khi :other là :value.',
    'required_unless'      => ' :attribute là trường bắt buộc trừ khi :other nằm trong :values.',
    'required_with'        => ' :attribute là trường bắt buộc khi :values tồn tại.',
    'required_with_all'    => ':attribute là trường bắt buộc khi :values tồn tại.',
    'required_without'     => ' :attribute là trường bắt buộc khi :values không tồn tại.',
    'required_without_all' => ' :attribute là trường bắt buộc khi không :values tồn tại.',
    'same'                 => ' :attribute và :other phải trùng khớp.',
    'size'                 => [
        'numeric' => ':attribute phải :size.',
        'file'    => ':attribute phải :size kilobyte.',
        'string'  => ':attribute phải :size kí tự.',
        'array'   => ':attribute phải chứa :size mục.',
    ],
    'string'               => ':attribute phải là một chuỗi.',
    'timezone'             => ':attribute phải là múi giờ hợp lệ.',
    'unique'               => ':attribute đã tồn tại.',
    'uploaded'             => ':attribute tải lên gặp sự cố.',
    'url'                  => ':attribute định dạng không đúng.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-mesage',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
