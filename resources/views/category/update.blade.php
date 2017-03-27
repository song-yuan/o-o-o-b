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
            <div class="pull-right">
                <a class="btn btn-xs btn-primary" href="<?php echo url('category');?>"><span class="fa fa-backward"></span> 返 回</a>
            </div>
        </div>
        
        <div class="ibox-content">
            <form class="form-horizontal" method="POST">
                <input type="hidden" name="_token" value="<?php echo csrf_token();?>"/>
                <div class="form-group <?php if($errors->first('name')) echo 'has-error';?>">
                    <label class="col-lg-2 control-label">分类名称</label>
                    <div class="col-lg-10">
                        <input type="text" name="category[name]" value="<?php echo $category->name;?>" placeholder="分类名称" class="form-control"> 
                        <span class="help-block m-b-none"><?php echo $errors->first('name');?></span>
                    </div>
                </div>
                <div class="form-group <?php if($errors->first('alias')) echo 'has-error';?>">
                    <label class="col-lg-2 control-label">别名</label>
                    <div class="col-lg-10">
                        <input type="text" name="category[alias]" value="<?php echo $category->alias;?>" placeholder="别名" class="form-control"> 
                        <span class="help-block m-b-none"><?php echo $errors->first('alias');?></span>
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
@endsection
@endsection