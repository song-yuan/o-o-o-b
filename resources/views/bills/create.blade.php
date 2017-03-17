@extends('layouts.app')
@section('title', '录入快递单')
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
    <div class="col-lg-8">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Inline form</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <form role="form" class="form-inline">
                    <div class="form-group">
                        <label for="exampleInputEmail2" class="sr-only">Email address</label>
                        <input type="email" placeholder="Enter email" id="exampleInputEmail2"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2" class="sr-only">Password</label>
                        <input type="password" placeholder="Password" id="exampleInputPassword2"
                               class="form-control">
                    </div>
                    <div class="checkbox m-r-xs">
                        <input type="checkbox" id="checkbox1">
                        <label for="checkbox1">
                            Remember me
                        </label>
                    </div>
                    <button class="btn btn-white" type="submit">Sign in</button>
                </form>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
$("#bill_log").on("hidden.bs.modal",function(e){$(this).removeData();}); 
</script>
@endsection
@endsection