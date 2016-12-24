<!-- Modal -->
<div id="addItem" class="modal fade" role="dialog">
  <div class="modal-dialog">
<div class="panel panel-success">
                    <div class="panel-heading">
                        <h4><i class="fa fa-check-square-o" aria-hidden="true"></i> <?=$lang['add-success-message']?></h4>
                    </div>
    <!-- Modal content-->
    <div class="modal-content moda-content-success">
     
      <div class="modal-body">
        <p><strong><?=$lang['add-success-message-redirect']?></strong></p>
      </div>
      
    </div>
	</div>
</div>
<div id="countClick">0</div>
<script>

$(document).ready(function(){

$("#add-form").on( "submit", function( event ) {
	  event.preventDefault();		
	  dataForm = $(this).serialize();
	  var url = '<?=$appGridAdd?>';
	  saveData(dataForm,url,0);
	  // fix to ckfinder textarea data problem
	  setTimeout(function(){
			dataForm = $("#add-form").serialize();
			saveData(dataForm,url,1);
	  }, 100 );
});
});


function saveData(dataForm,url,post){

	if (post){
	
	var strMultiple = '';

	$( ".multiple-select" ).each(function( index ) {
		id = $(this).attr("name");
		val = $(this).val();
		strMultiple += '&' + id + '=' + val;
	});

	dataForm += strMultiple;

	 $.post(url, {data:dataForm}, function(response) {

			var data = JSON.parse(response);

			if (data.status == 1){
				$("#addItem").modal("toggle");
				var urlItem = '<?=$this->config->item('appResourcesURLedit')?><?=$module?>/id/' + data.id;
				
			}else{
				$("#add-error-message").fadeIn("slow");
			}

			$("html, body").animate({ scrollTop: 0 }, "slow");


			setTimeout(function(){
				window.location = urlItem;
			}, 2000 );
			
			setTimeout(function(){
				$(".edit-messages").fadeOut("fast");
			}, 3000 );

		});
	}
}

</script>
 

</body>
</html>
