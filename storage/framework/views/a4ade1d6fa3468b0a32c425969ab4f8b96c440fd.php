<?php $__env->startSection('title', '录入快递单'); ?>
<?php $__env->startSection('styles'); ?>
@parent
<link rel="stylesheet" href="<?php echo asset('css/datepicker/datepicker3.css'); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
            <div class="pull-right">
                <a class="btn btn-xs btn-primary" href="<?php echo url('partner');?>"><span class="fa fa-backward"></span> 返 回</a>
            </div>
        </div>
        
        <div class="ibox-content">
            <form class="form-horizontal" method="POST">
                <input type="hidden" name="_token" value="<?php echo csrf_token();?>"/>
                <div class="form-group <?php if($errors->first('partner_name')) echo 'has-error';?>">
                    <label class="col-lg-2 control-label">公司名称</label>
                    <div class="col-lg-10">
                        <input type="text" name="partner[partner_name]" value="<?php echo $partner->partner_name;?>" placeholder="公司名称" class="form-control"> 
                        <span class="help-block m-b-none"><?php echo $errors->first('partner_name');?></span>
                    </div>
                </div>
                <div class="form-group <?php if($errors->first('home_page')) echo 'has-error';?>">
                    <label class="col-lg-2 control-label">公司主页</label>
                    <div class="col-lg-10">
                        <input type="text" name="partner[home_page]" value="<?php echo $partner->home_page;?>" placeholder="公司主页" class="form-control"> 
                        <span class="help-block m-b-none"><?php echo $errors->first('home_page');?></span>
                    </div>
                </div>
                <div class="form-group <?php if($errors->first('api_url')) echo 'has-error';?>">
                    <label class="col-lg-2 control-label">API网址</label>
                    <div class="col-lg-10">
                        <input type="text" name="partner[api_url]" value="<?php echo $partner->api_url;?>" placeholder="API网址" class="form-control"> 
                        <span class="help-block m-b-none"><?php echo $errors->first('api_url');?></span>
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
<?php $__env->startSection('scripts'); ?>
@parent
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>