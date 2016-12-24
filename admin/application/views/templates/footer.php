</div></div></div></div>
<div class="clearfix"></div>

<footer>
<div class="container">
<center>
	<strong> <i class="fa fa-code" aria-hidden="true"> </i> <?=$titleAdmin?></strong> its a modern and very flexible CMS made in PHP. <br/>
	Its Open Source, ( <i class="fa fa-linux" aria-hidden="true"></i> ) you can use, modify or what you want. <br/>
	Only remember: <strong> May the Force be with you </strong>

</center>
</div>
</footer>

<!-- Scripts
============================================= -->

<!-- jQuery -->
<script src="<?=$appPublic?>/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?=$appPublic?>/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?=$appPublic?>/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<!--
<script src="<?=$appPublic?>/vendor/raphael/raphael.min.js"></script>
<script src="<?=$appPublic?>/vendor/morrisjs/morris.min.js"></script>
<script src="<?=$appPublic?>/data/morris-data.js"></script>
-->

<!-- Custom Theme JavaScript -->
<script src="<?=$appPublic?>/js/dist/sb-admin-2.js"></script>

<script src="<?=$appPublic?>/vendor/ckeditor/ckeditor.js"></script>
<script src="<?=$appPublic?>/vendor/ckeditor/config.js"></script>
<script src="<?=$appPublic?>/vendor/ckeditor/styles.js"></script>
<script src="<?=$appPublic?>/vendor/ckfinder/ckfinder.js"></script>

<!-- jquery ui -->
<script src="<?=$appPublic?>/vendor/jquery-ui/js/jquery-ui.js"></script>


<script type="text/javascript">
$(document).ready(function(){
	$( "textarea" ).each(function( index ) {
		if ($(this).attr('class') != 'simple'){
			var name=$(this).attr("id");
			var editor = CKEDITOR.replace(name);
			CKFinder.setupCKEditor( editor, 'plugins/ckfinder/' ) ;
		}
	});
});

function searchModules() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById('searchModules');
    filter = $("#searchModules").val().toUpperCase();
    //console.log(filter);
    ul = document.getElementById("side-menu");
    li = ul.getElementsByTagName('li');

    if (filter === ''){
    	$("a.modules").fadeIn("fast");
    }else{
    	$("a.modules").each(function( index ) {
	  		if ($(this).attr("rel").toUpperCase() === filter){
	    		$(this).fadeIn("fast");
	    	}else{
	    		$(this).fadeOut("fast");
	    	}
		});
    }
}
</script>



