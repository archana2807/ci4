<?php $page_session = \Config\Services::session(); ?>
<?=$this->extend("layout/master")?>

<?=$this->section("content")?>
            <?php if(isset($validation)):?>
                <div id="messages" class="alert alert-warning">
                   <?= $validation->listErrors() ?>
                </div>
                <?php endif;?>
	
            <?php if($page_session->getTempdata('success')):?>
                <div id="messages" class="alert alert-warning">
                   <?= $page_session->getTempdata('success'); ?>
                </div>
                <?php endif;?>	
             <?php if($page_session->getTempdata('error')):?>
                <div id="messages" class="alert alert-warning">
                   <?= $page_session->getTempdata('error'); ?>
                </div>
                <?php endif;?>					
				
<div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Register</h5>
                    <form action="<?= base_url('register') ?>" method="post" enctype='multipart/form-data'>
                    <div class="form-group mb-3">
                        <input type="text" name="name" placeholder="Name" value="<?php echo set_value('name'); ?>" class="form-control" >
						<?php if(isset($validation)):?>
						<span id="messages" style="" class="text-danger"><?= display_error($validation,'name'); ?></span>
						 <?php endif;?>
                    </div>
					 <div class="form-group mb-3">
                        <input type="number" name="mobile" placeholder="Mobile Number" value="<?php echo set_value('mobile'); ?>" class="form-control" >
						<?php if(isset($validation)):?>
						<span id="messages" class="text-danger"><?= display_error($validation,'mobile'); ?></span>
						 <?php endif;?>
                    </div>
                    <div class="form-group mb-3">
                        <input type="email" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" class="form-control" >
						<?php if(isset($validation)):?>
						<span id="messages" class="text-danger"><?= display_error($validation,'email'); ?></span>
						 <?php endif;?>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" placeholder="Password" class="form-control" >
						<?php if(isset($validation)):?>
						<span id="messages" class="text-danger"><?= display_error($validation,'password'); ?></span>
						 <?php endif;?>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="confirmpassword" placeholder="Confirm Password" class="form-control" >
						<?php if(isset($validation)):?>
						<span id="messages" class="text-danger"><?= display_error($validation,'confirmpassword'); ?></span>
						 <?php endif;?>
                    </div>
					 <div class="form-group mb-3">
                       <input type="file" name="userfile" size="20">
						<?php if(isset($validation)):?>
						<span id="messages" class="text-danger"><?= display_error($validation,'userfile'); ?></span>
						 <?php endif;?>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark">Signup</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
     
</div>

<?=$this->endSection()?>