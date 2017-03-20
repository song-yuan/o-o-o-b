@extends('layouts.app')
@section('title', '快递单')
@section('styles')
@parent
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>快递单管理</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo url('/');?>">首页</a>
            </li>
            <li class="active">
                <strong>快递单管理</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>快递单列表</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-3 pull-right">
                            <form>
                            <div class="input-group">
                                <input type="text" name="bill_sn" value="<?php echo $billSn;?>" placeholder="Search" class="input-sm form-control">
                                <span class="input-group-btn">
                                    <input type="submit" class="btn btn-sm btn-primary"> 搜索 </button> 
                                </span>
                            </div>
                            </form>
                        </div>
                        <div class="">
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">录入快递单 <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo url('bill/create');?>">录入快递单</a></li>
                                    <li><a href="<?php echo url('bill/remark');?>">录入快递单进度</a></li>
                                </ul>
                            </div>
                            
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">导入 / 导出 <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" data-toggle="modal" data-target="#import_bill">导入快递单</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#import_bill_log">导入进度</a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo url('bill/billtpl');?>">导出快递模板</a></li>
                                    <li><a href="<?php echo url('bill/logtpl');?>">导出快递进度模板</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>ID </th>
                                <th>编码 </th>
                                <th>发货人</th>
                                <th>发货地址</th>
                                <th>收货人</th>
                                <th>收货地址</th>
                                <th>发货日期</th>
                                <th>签收日期</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($bills as $bill):?>
                            <tr>
                                <td><input type="checkbox" class="i-checks" name="input[]" value="<?php echo $bill->bill_id;?>"></td>
                                <td><?php echo $bill->bill_id;?></td>
                                <td><?php echo $bill->bill_sn;?></td>
                                <td><?php echo $bill->sender_name;?></td>
                                <td><?php echo $bill->sender_address;?></td>
                                <td><?php echo $bill->receiver_name;?></td>
                                <td><?php echo $bill->receiver_address;?></td>
                                <td><?php echo $bill->sended_at;?></td>
                                <td><?php echo $bill->signed_at;?></td>
                                <td>
                                    <a href="<?php echo url('bill/logs', array($bill->bill_sn));?>" class="show_log" data-toggle="modal" data-target="#bill_log">查看</a>
                                    <a href="<?php echo url('bill/update', array($bill->bill_id));?>" class="show_log">编辑</a>
                                    <a href="<?php echo url('bill/remark', array($bill->bill_id));?>" class="show_log">录入进度</a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="" style="text-align:right">
                        <?php echo $bills->appends(array('bill_sn' => $billSn))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="import_bill" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
                <form action="<?php echo url('bill/import');?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">导入快递单</h4>
                        <small class="font-bold">选择整理好的Excel表,导入到系统中</small>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <input type="file" name="bills">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-white" value="Close" data-dismiss="modal">
                        <input type="submit" class="btn btn-primary" value="上传">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal inmodal" id="import_bill_log" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Modal title</h4>
                    <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                </div>
                <div class="modal-body">
                    <p><strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                        printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
                        remaining essentially unchanged.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="bill_log" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeIn">

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