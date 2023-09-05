<?php $page_session = \Config\Services::session(); ?>
<?=$this->extend("layout/master")?>

<?=$this->section("content")?>
 <?php if($page_session->getTempdata('error')):?>
                <div id="messages" class="alert alert-warning">
                   <?= $page_session->getTempdata('error'); ?>
                </div>
                <?php endif;?>
<div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col">
            <div class="card">
                <div class="card-body">
                <h2>Change Your Password</h2>
                
                
                <form action="<?php echo base_url('change-password'); ?>" method="post">
                    
                    <div class="form-group mb-3">
                        <input type="password" name="old-password" placeholder="Enter Old Password" class="form-control" >
						<?php if(isset($validation)):?>
						<span id="messages" style="" class="text-danger"><?= display_error($validation,'old-password'); ?></span>
						 <?php endif;?>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="new-password" placeholder="Password" class="form-control" >
						<?php if(isset($validation)):?>
						<span id="messages" class="text-danger"><?= display_error($validation,'new-password'); ?></span>
						 <?php endif;?>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="confirmpassword" placeholder="Confirm Password" class="form-control" >
						<?php if(isset($validation)):?>
						<span id="messages" class="text-danger"><?= display_error($validation,'confirmpassword'); ?></span>
						 <?php endif;?>
                    </div>
                    <div class="d-grid">
                         <button type="submit" class="btn btn-success">Signin</button>
                    </div>     
                </form>
            </div>
              
        </div>
    </div>
</div>

<?=$this->endSection()?>