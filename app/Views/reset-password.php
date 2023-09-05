<?php $page_session = \Config\Services::session(); 
 ?>
<?=$this->extend("layout/master")?>
<?=$this->section("content")?>
<div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col">
            <div class="card card-body">
			 <h1 >Reset password</h1>
			 <?php
			 if(!empty($error)){
			 ?>
				<h5 class="text-danger"><?= $error ?></h4> 
			<?php
			 }
			 ?>
			 <?php if($page_session->getTempdata('error')):?>
                <div id="messages" class="alert alert-warning">
                   <?= $page_session->getTempdata('error'); ?>
                </div>
                <?php endif;?>
				 <?php if($page_session->getTempdata('success')):?>
                <div id="messages" class="alert alert-warning">
                   <?= $page_session->getTempdata('success'); ?>
                </div>
                <?php endif;?>
			<?php	if(empty($error)){ ?>
			 <form action="<?=current_url(); ?>" method="post">
                    
                   
                    <div class="form-group mb-3">
                        <input type="password" name="new-password" placeholder="New Password" class="form-control" >
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
			<?php } ?>
			</div>
		</div>
	</div>
</div>
<?=$this->endSection()?>