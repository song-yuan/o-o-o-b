@extends('layouts.app')
@section('title', '录入快递单')
@section('styles')
@parent
<link rel="stylesheet" href="{!! asset('css/datepicker/datepicker3.css') !!}" />
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>录入快递单</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo url('/');?>">首页</a>
            </li>
            <li class="active">
                <strong>录入快递单</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>录入快递单</h5>
        </div>
        
        <div class="ibox-content">
            <form class="form-horizontal" method="POST">
                <input type="hidden" name="_token" value="<?php echo csrf_token();?>"/>
                <div class="form-group <?php if($errors->first('bill_sn')) echo 'has-error';?>">
                    <label class="col-lg-2 control-label">物流编号</label>
                    <div class="col-lg-10">
                        <input type="text" name="bill[bill_sn]" placeholder="物流编号" class="form-control"> 
                        <span class="help-block m-b-none"><?php echo $errors->first('bill_sn');?></span>
                    </div>
                </div>
                <div class="form-group <?php if($errors->first('sender_name')) echo 'has-error';?>">
                    <label class="col-lg-2 control-label">发货人</label>
                    <div class="col-lg-10">
                        <input type="text" name="bill[sender_name]" placeholder="发货人" class="form-control"> 
                        <span class="help-block m-b-none"><?php echo $errors->first('sender_name');?></span>
                    </div>
                </div>
                <div class="form-group <?php if($errors->first('sender_address')) echo 'has-error';?>">
                    <label class="col-lg-2 control-label">发货地址</label>
                    <div class="col-lg-10">
                        <input type="text" name="bill[sender_address]" placeholder="发货地址" class="form-control"> 
                        <span class="help-block m-b-none"><?php echo $errors->first('sender_address');?></span>
                    </div>
                </div>
                <div class="form-group <?php if($errors->first('receiver_name')) echo 'has-error';?>">
                    <label class="col-lg-2 control-label">收货人</label>
                    <div class="col-lg-10">
                        <input type="text" name="bill[receiver_name]" placeholder="收货人" class="form-control"> 
                        <span class="help-block m-b-none"><?php echo $errors->first('receiver_name');?></span>
                    </div>
                </div>
                <div class="form-group <?php if($errors->first('receiver_address')) echo 'has-error';?>">
                    <label class="col-lg-2 control-label">收货地址</label>
                    <div class="col-lg-10">
                        <input type="text" name="bill[receiver_address]" placeholder="收货地址" class="form-control"> 
                        <span class="help-block m-b-none"><?php echo $errors->first('receiver_address');?></span>
                    </div>
                </div>
                <div class="form-group <?php if($errors->first('sended_at')) echo 'has-error';?>">
                    <label class="col-lg-2 control-label">发货日期</label>
                    <div class="col-lg-10">
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" id="bill_sended_at" name="bill[sended_at]" class="form-control" placeholder="发货日期" value="<?php echo date('Y-m-d');?>">
                        </div>
                        <span class="help-block m-b-none"><?php echo $errors->first('sended_at');?></span>
                    </div>
                </div>
                <div class="form-group <?php if($errors->first('signed_at')) echo 'has-error';?>">
                    <label class="col-lg-2 control-label">签收日期</label>
                    <div class="col-lg-10">
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" id="bill_signed_at" name="bill[signed_at]" class="form-control" placeholder="签收日期" value="<?php echo date('Y-m-d');?>">
                        </div>
                        <span class="help-block m-b-none"><?php echo $errors->first('signed_at');?></span>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <a class="btn btn-white" href="javascript:history.go(-1);">返 回</a>
                        <button class="btn btn-primary" type="submit" style="margin-left:20px;">提 交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script src="{!! asset('js/datapicker/bootstrap-datepicker.js') !!}" type="text/javascript"></script>
<script>
$('#bill_sended_at').datepicker({
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true,
    format:'yyyy-mm-dd',
    todayHighlight: true,
});

$('#bill_signed_at').datepicker({
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true,
    format:'yyyy-mm-dd',
    todayHighlight: true,
});
</script>
@endsection
@endsection