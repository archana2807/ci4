

<?php $page_session = \Config\Services::session(); ?>
<?=$this->extend("layout/master")?>

<?=$this->section("content")?>
 
<div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col">
            <div class="card">
                <div class="card-body">
                <h2>login activity  
                 
				 
                </h2> 
				<?php if(count($logininfo)>0){ 
				?>
				<table class="table">
                     <tr>
                       <th>agent</th>
                       <th>uniid</th>
                       <th>ip</th>
					   <th>login_time</th>
					   <th>logout_time</th>
                     </tr>
					 <?php
					 foreach($logininfo as $val){
					 ?>
                      <tr>
                         <td><?= $val->agent; ?></td>
                          <td><?= $val->uniid; ?></td>
                         <td><?= $val->ip; ?></td>
						 <td><?= $val->login_time; ?></td>
						 <td><?= $val->logout_time; ?></td>
                      </tr>
					  <?php
					  }
					  ?>
                </table>
				
				<?php
				} else {
					echo "data not avaliable";
				}
				?>
				
              </div>
              
        </div>
    </div>
</div>

<?=$this->endSection()?>