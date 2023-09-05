<?php $page_session = \Config\Services::session(); ?>
<?=$this->extend("layout/master")?>

<?=$this->section("content")?>
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
<div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col">
            <div class="card">
                <div class="card-body">
                <h2>Forgot Password</h2>
                
                
                <form action="<?php echo base_url('forgot-password'); ?>" method="post">
                    <div class="form-group mb-3">
                        <input type="email" name="email" placeholder="Email" value="" class="form-control" >
						<?php if(isset($validation)):?>
						<span id="messages" style="" class="text-danger"><?= display_error($validation,'email'); ?></span>
						 <?php endif;?>
                    </div>
                    
                     <div class="d-grid">
                      <button  type="submit" class="btn btn-success">Submit</button>
                    </div>  					
                </form>
            </div>
              
        </div>
    </div>
</div>

<?=$this->endSection()?>