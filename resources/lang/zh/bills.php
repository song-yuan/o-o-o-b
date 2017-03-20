<?php
return array(
    'bill_sn.required' => '快递编号必须填写',
    'bill_sn.between' => '单号长度在5-20位之间',
    'sender_name.required' => '发货人必须填写',
    'sender_name.between' => '发货人姓名长度在2-20位之间',
    'sender_address.required' => '发货人地址必须填写',
    'sender_address.between' => '发货人地址长度在6-50位之间',
    
    'receiver_name.required' => '收货人必须填写',
    'receiver_name.between' => '收货人姓名长度在2-20位之间',
    'receiver_address.required' => '收货人地址必须填写',
    'receiver_address.between' => '收货人地址长度在6-50位之间',

    'sended_at.date' => '发货时间格式不正确',
    'signed_at.date' => '签收时间格式不正确',
    'signed_at.after' => '签收时间必须晚于发货时间',


    'remark.required' => '备注必须填写',
    'remark.between' => '备注长度在4-50之间',
    'arrived_at.date' => '时间格式不正确',
);