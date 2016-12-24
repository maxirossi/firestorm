<?php
    if (!empty($dataTables)){  
?>
<!-- DataTables JavaScript -->
<script src="<?=$appPublic?>/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?=$appPublic?>/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="<?=$appPublic?>/vendor/datatables-responsive/dataTables.responsive.js"></script>
<!--Jquery UI -->
<script src="<?=$appPublic?>/vendor/jquery-ui/js/jquery-ui.js"></script>
<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: true,
        order: [[ '<?=$list['listDataOrder'][2]?>', '<?=$list['listDataOrder'][1]?>' ]]
    });
});
</script>

<!-- Modal -->
<div id="deleteItem" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa fa-trash-o"></i> <?=$lang['dialog-delete-item']?></h4>
      </div>
      <div class="modal-body">
        <p><?=$lang['dialog-delete-item-text']?></p>
        <p><a class="btn btn-danger" href="javascript:confirmDelete()"><?=$lang['gdelete-this-item']?></a></p>
        <p id="message-error-delete-item" class="hide alert alert-error"><?=$lang['error-delete-item']?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- deta -->
<div id="item-id" class="hide"></div>
<div id="item-table" class="hide"></div>
<div id="item-table-row" class="hide"></div>
<!-- end of data -->

<script>

function deleteItem(id, table, row){
	$("#item-id").html(id);
	$("#item-table").html(table);
	$("#item-table-row").html(row);
	$('#deleteItem').modal('show');
}

function confirmDelete(){

	var id = $("#item-id").html();
	var table = $("#item-table").html();
	var row = $("#item-table-row").html();

	$.post("<?=$appGridDelete?><?=$module?>",{id:id,table:table}, function(data) {

		var data = JSON.parse(data);

		if (data.status == 1){
			$('#deleteItem').modal('toggle');
			$('#' + row).fadeOut("slow");
		}else{
			$('#message-error-delete-item').fadeIn("fast");
		}
	});
}
</script>
<?php
	}
?>
</body>
</html>
