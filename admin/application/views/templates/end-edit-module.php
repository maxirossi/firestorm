<script>
var orderCall = 0;

$(document).ready(function(){

// sortable imageUpload
$( ".thumbnails" ).sortable({
  activate: function( event, ui ) {
  	 setTimeout(function(){
	 orderImage(0);
  }, 100);
  }
});

function orderImage(post){

	var ids = "";

	if (post == 0){
		setTimeout(function(){
		 orderImage(1);
	  }, 1500 );

		$( ".thumbnail" ).each(function( index ) {
			ids += $( this ).attr("data-id");
			ids += ",";
		});

	}else{

		$( ".thumbnail" ).each(function( index ) {
			ids += $( this ).attr("data-id");
			ids += ",";
		});

	ids = ids.substring(0, ids.length - 1);
	
	var url = '<?=$this->config->item("reOrderImgList")?>';

	$.post(url, {id:ids}, function(response) {
			
		var data = JSON.parse(response);
	
		$("#order-img-success-message").fadeIn("slow");

		if (data.status == 1){
			$("#order-img-success-message").fadeIn("slow");
		}else{
			$("#order-error-img-message").fadeIn("slow");
		}

		fadeOutMessages();

	});

	}

}

$("#edit-form").on( "submit", function( event ) {

  event.preventDefault();
  var dataForm = $(this).serialize();
  var url = '<?=$appGridEdit?>';
  saveData(dataForm,url,0);
  // fix to ckfinder textarea data problem
  setTimeout(function(){
	dataForm = $("#edit-form").serialize();
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
				$("#edit-success-message").fadeIn("slow");
			}else{
				$("#edit-error-message").fadeIn("slow");
			}

			$("html, body").animate({ scrollTop: 0 }, "slow");

			fadeOutMessages();

		});
	}
}

function getImages(id, module_id){

	$.post("<?=$this->config->item('urlGetImages')?>", {id:id, module:module_id, mode:'html'}, function(response) {
		
		var data = JSON.parse(response);

		if (data.status == 1){
			$("#images-list").html(data.data);
		}else{
			$("#edit-error-message").fadeIn("slow");
		}

		fadeOutMessages();

	});
}

function deleteImage(id, module_id , element_id){

		$.post("<?=$this->config->item('deleteImage')?>", {id:id, module:module_id}, function(response) {
			
			var data = JSON.parse(response);

			if (data.status == 1){
				$("#" + element_id).fadeOut("slow");
			}else{
				$("#image-delete-error-message").fadeIn("slow");
				fadeOutMessages();
			}

		});
}

function fadeOutMessages(){
		setTimeout(function(){
			$(".edit-messages").fadeOut("fast");
		}, 3000 );
}

function makeSortable(){

}

</script>
 

</body>
</html>
