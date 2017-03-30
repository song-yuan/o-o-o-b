<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title">Modal title</h4>
    <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
</div>
<div class="modal-body">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>物流编码 </th>
                <th>地点</th>
                <th>日期</th>
                <th>时间</th>
                <th>描述 </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($billLogs as $log):?>
            <tr>
                <td><?php echo $log->bill_sn;?></td>
                <td><?php echo $log->location;?></td>
                <td><?php echo $log->date;?></td>
                <td><?php echo $log->time;?></td>
                <td><?php echo $log->description;?></td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
</div>


