<?php $__env->startSection('title', '录入快递单'); ?>
<?php $__env->startSection('styles'); ?>
@parent
<link rel="stylesheet" href="<?php echo asset('css/datepicker/datepicker3.css'); ?>" />
<?php echo $__env->make('UEditor::head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;
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
                <a class="btn btn-xs btn-primary" href="<?php echo url('category');?>"><span class="fa fa-backward"></span> 返 回</a>
            </div>
        </div>
        
        <div class="ibox-content">
            <form class="form-horizontal" method="POST">
                <input type="hidden" name="_token" value="<?php echo csrf_token();?>"/>
                <div class="form-group <?php if($errors->first('title')) echo 'has-error';?>">
                    <label class="col-lg-2 control-label">标题</label>
                    <div class="col-lg-10">
                        <input type="text" name="article[title]" placeholder="标题" class="form-control" value="<?php echo $article->title;?>"> 
                        <span class="help-block m-b-none"><?php echo $errors->first('title');?></span>
                    </div>
                </div>
                
                <div class="form-group <?php if($errors->first('category_id')) echo 'has-error';?>">
                    <label class="col-lg-2 control-label">分类</label>
                    <div class="col-lg-10">
                        <select class="form-control" name="article[category_id]">
                            <?php foreach($categories as $id => $name):?>
                            <option value="<?php echo $id;?>" <?php echo $id == $article->category_id?'selected':'';?>><?php echo $name;?></option>
                            <?php endforeach;?>
                        </select>
                        <span class="help-block m-b-none"><?php echo $errors->first('category_id');?></span>
                    </div>
                </div>

                <div class="form-group <?php if($errors->first('sub_head')) echo 'has-error';?>">
                    <label class="col-lg-2 control-label">副标题</label>
                    <div class="col-lg-10">
                        <input type="text" name="article[sub_head]" placeholder="副标题" class="form-control" value="<?php echo $article->sub_head;?>"> 
                        <span class="help-block m-b-none"><?php echo $errors->first('sub_head');?></span>
                    </div>
                </div>

                <div class="form-group <?php if($errors->first('content')) echo 'has-error';?>">
                    <label class="col-lg-2 control-label">内容</label>
                    <div class="col-lg-10">
                        <script id="article_content" name="article[content]" type="text/plain">
                            <?php echo $article->content;?>
                        </script>
                        <span class="help-block m-b-none"><?php echo $errors->first('content');?></span>
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
<script type="text/javascript">
    var ue = UE.getEditor('article_content');
        ue.ready(function() {
        ue.execCommand('serverparam', '_token', '<?php echo e(csrf_token()); ?>');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.    
    });
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>