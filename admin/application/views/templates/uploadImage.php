<script>
$(document).ready(function(){

    var uploadfiles = document.querySelector('#uploadfiles');
    uploadfiles.addEventListener('change', function () {
        var files = this.files;
        for(var i=0; i<files.length; i++){
            uploadFile(this.files[i]); // call the function to upload the file
        }
    }, false);

});

function uploadFile(file){
    var url = '<?=$this->config->item('urlUploadImg')?>id/<?=$itemID?>/module/<?=$moduleID?>/';
    var xhr = new XMLHttpRequest();
    var fd = new FormData();    
    xhr.open("POST", url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Every thing ok, file uploaded
            var response = xhr.responseText;
            response = JSON.parse(response);
          
            if (response.status == 1){
                $("#add-image-success-message").fadeIn("slow");
                getImages(<?=$itemID?>,<?=$moduleID?>);
                makeSortable();
            }else{
                $("#add-image-error-message").fadeIn("slow");
            }

            setTimeout(function(){
                $(".add-messages").fadeOut("fast");
            }, 3000 );

        }
    };
    fd.append("upload_file", file);
    xhr.send(fd);
}
</script>