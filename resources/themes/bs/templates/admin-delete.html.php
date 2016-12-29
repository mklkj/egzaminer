<?php include '_head.html.php'; ?>

<div class="panel panel-default">
    <div class="panel-body">
        <?=$this->data['content'];?> 
    </div>
    <div class="panel-footer">
        <form action="" method="post">
            <input type="submit" name="confirm" value="Usuń" class="btn btn-danger">
        </form>
    </div>
</div>

<?php include '_foot.html.php'; ?>