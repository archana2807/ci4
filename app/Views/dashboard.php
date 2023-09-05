<?php $page_session = \Config\Services::session(); ?>
<?=$this->extend("layout/master")?>

<?=$this->section("content")?>
 
<div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col">
            <div class="card">
                <div class="card-body">
                <h2>Welcome to  
                <?=
				$userdata->name;
				?>
                </h2> 
                
              </div>
              
        </div>
    </div>
</div>

<?=$this->endSection()?>