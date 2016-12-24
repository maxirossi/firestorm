    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-code" aria-hidden="true"></i> <?=$lang['panel-de-control']?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
 <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4><i class="fa fa-list-alt" aria-hidden="true"></i> <?=$lang['editar']?> <?=$module?></h4>
                        </div>
<div class="alert alert-info alert-dismissable" id="gridListMessage">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<a href="<?=$this->config->item('appResourcesURLlist')?><?=$module?>"><i class="fa fa fa-navicon"></i> <?=$lang['view-list']?> <strong></strong></a>
<strong>|</strong> <a href="<?=$appGridAdd?><?=$module?>"><?=$lang['crear-nuevo']?> Item</a>
</div>
  <div class="alert alert-success edit-messages" id="edit-success-message"><?=$lang['edit-success-message']?></div>
  <div class="alert alert-danger edit-messages" id="edit-error-message"><?=$lang['edit-error-message']?></div>
  <form role="form" class="form-horizontal" id="edit-form">
  <?php
  	if ($htmlForm){
  		echo $htmlForm;
  	}
  ?>
<div>
  <button type='submit' class='btn btn-success' style='position:relative;left:-13px'><?=$lang['modificar']?></button>
</div>
<!-- hidden controls -->
<input type="hidden" id="itemID" name="itemID" value="<?=$itemID?>">
<input type="hidden" id="moduleID" name="moduleID" value="<?=$moduleID?>">
<input type="hidden" id="table" name="table" value="<?=$table?>">
<input type="hidden" id="submit" name="submit" value="true">
<!-- .hidden controls -->
</form>
<!-- /.col-lg-8 -->
</div></div>
<div class="col-lg-4">
<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="fa fa-file-image-o"></i> <?=$lang['media-panel-title']?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
<!-- messages -->
  <div class="alert alert-success edit-messages" id="add-image-success-message"><?=$lang['add-image-success-message']?></div>
  <div class="alert alert-danger edit-messages" id="add-image-error-message"><?=$lang['add-image-error-message']?></div>
  <div class="alert alert-danger edit-messages" id="delete-image-error-message"><?=$lang['delete-image-error-message']?></div>
 <div class="alert alert-success edit-messages" id="order-img-success-message"><?=$lang['order-image-success-message']?></div>
  <div class="alert alert-danger edit-messages" id="order-img-error-message"><?=$lang['order-image-error-message']?></div>
<!-- .messages -->
    <form method="post" action="<?=$this->config->item('urlUploadImg')?>">
      <div class="form-group">
          <label for="uploadImage"></label>
          <span class="btn btn-default btn-file">
          <i class="fa fa-upload" aria-hidden="true"></i> <?=$lang['agregar']?> <input type="file" id="uploadfiles" accept="image/gif, image/jpeg, image/png" class="btn btn-primary" multiple/>
          </span>
      </div>
    </form>
    <div id="images-list"><?=$imageList?></div>
    </div>
    <!-- /.panel-body -->
</div>
<!-- /.panel -->
</div><!-- .panel -->
</div>
</div>
