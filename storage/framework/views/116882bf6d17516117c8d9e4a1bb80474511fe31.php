<?php $__env->startSection('title', '快递单'); ?>
<?php $__env->startSection('styles'); ?>
@parent
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
                    <div class="pull-right">
                        <a class="btn btn-xs btn-primary" href="<?php echo url('category/create');?>"><span class="fa fa-plus-square"></span> 新 增</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th width="6%">ID </th>
                                <th>名称 </th>
                                <th>别名</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($categories as $category):?>
                            <tr>
                                <td><?php echo $category->category_id;?></td>
                                <td><?php echo $category->name;?></td>
                                <td><?php echo $category->alias;?></td>
                                <td>
                                    <a href="<?php echo url('category/update', array($category->category_id));?>">编辑</a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="" style="text-align:right">
                        <?php echo $categories->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startSection('scripts'); ?>
@parent
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>