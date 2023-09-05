<?=$this->extend("layout/master")?>
<?=$this->section("content")?>
<div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col">
            <div class="card card-body">
			 <h1 >Activation Process</h1>
			 <?php
			 if($error){
			 ?>
				<h5 class="text-danger"><?= $error ?></h4> 
			<?php
			 }
			 ?>
			
			</div>
		</div>
	</div>
</div>
<?=$this->endSection()?>