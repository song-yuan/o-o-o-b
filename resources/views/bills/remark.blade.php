@extends('layouts.app')
@section('title', '录入快递单')
@section('styles')
@parent
<link rel="stylesheet" href="{!! asset('css/datepicker/datepicker3.css') !!}" />
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>录入快递单进度</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo url('/');?>">首页</a>
            </li>
            <li class="active">
                <strong>录入快递单进度</strong>
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
            <h5>录入快递单进度</h5>
        </div>
        
        <div class="ibox-content">
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-lg-2 control-label">物流编号</label>
                    <div class="col-lg-10">
                        <input type="text" name="bill_log[bill_sn]" value="<?php echo $bill->bill_sn;?>" placeholder="物流编号" class="form-control"> 
                        <span class="help-block m-b-none"><?php echo $errors->first('bill_sn');?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">备注</label>
                    <div class="col-lg-10">
                        <input type="text" name="bill_log[remark]" placeholder="备注" class="form-control"> 
                        <span class="help-block m-b-none"><?php echo $errors->first('remark');?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">日期</label>
                    <div class="col-lg-10">
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" id="bill_log_arrived_at" name="bill_log[arrived_at]" class="form-control" placeholder="日期" value="<?php echo date('Y-m-d');?>">
                        </div>
                        <span class="help-block m-b-none"><?php echo $errors->first('arrived_at');?></span>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-white" type="submit">返 回</button>
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
$('#bill_log_arrived_at').datepicker({
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