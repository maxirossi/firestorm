    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-code" aria-hidden="true"></i> <?=$lang['panel-de-control']?> </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4><i class="fa fa-list-alt" aria-hidden="true"></i> <?=$lang['add-element']?> (<?=$module?>)</h4>
                        </div>

<div class="alert alert-info alert-dismissable" id="gridListMessage">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<a href="<?=$this->config->item('appResourcesURLlist')?><?=$module?>"><i class="fa fa fa-navicon"></i> <?=$lang['view-list']?> <strong></strong></a>
</div>


  <div class="alert alert-success edit-messages" id="add-success-message"><?=$lang['add-success-message']?></div>
  <div class="alert alert-danger edit-messages" id="add-error-message"><?=$lang['add-error-message']?></div>

  <form role="form" class="form-horizontal" id="add-form">
  <?php
  	if ($htmlForm){
  		echo $htmlForm;
  	}
  ?>
<div style='position:relative;left:-15px;'>
  <button type='submit' class='btn btn-success' style='padding:0px !imporant;margin:0px important;' id="btn-submit"><?=$lang['guardar']?></button>
</div>

<!-- hidden controls -->
<input type="hidden" id="moduleID" name="moduleID" value="<?=$moduleID?>">
<input type="hidden" id="table" name="table" value="<?=$table?>">
<input type="hidden" id="submit" name="submit" value="true">
<!-- .hidden controls -->

</form>

<!-- /.col-lg-8 -->
</div></div>
<?php
/* upload image, only enabled in edit in this version 
<div class="col-lg-4">
<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="fa fa-file-image-o"></i> <?=$lang['media-panel-title']?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
       
    </div>
    <!-- /.panel-body -->
</div>
*/?>
<!-- /.panel -->


</div>
</div>
</div>
