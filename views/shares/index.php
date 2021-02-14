<div class="container m">
    <?php if(isset($_SESSION['is_logged_in'])):?>
    <a href="<?php echo ROOT_PATH;?>shares/add" class="btn btn-success btn-share mt-4 mb-4">Share Something</a>
    <?php endif;?>
    <?php foreach($viewmodel as $item) : extract($item);?>
        <div class=" bg-light col p-4 mt-4 mb-4 border rounded">
            <h3><?php echo $title?></h3>
            <small><?php echo $create_date?></small>
            <hr>
            <p><?php echo $body?></p>
            <a class="btn btn-light border border-dark roundede" href="<?php echo $link?>" target="_blank">Go to website</a>


        </div>
    <?php endforeach;?>
</div>