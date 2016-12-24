<?php

function select_flag($row,$campo,$label,$esAjax=0,$necesario=0,$disabled=false,$valor1="SI",$valor2="NO") {

$html = '<div class="form-group">';
//$claz = explode('__',$contenedor_pre_name.'contenedor_'.$campo);
//$claz2 = explode('__',$campo);

if($disabled) $disabled = ' disabled="disabled" ';



$html.='<label for="' .$campo . '">'.ucfirst($label).'</label>';
$html.= '<select '.$disabled.' name="'.$campo.'" id="'.$campo.'" class="form-control">';

//die("row es $row");
if ($row == 0 ){
	$html.= '<option '.$disabled.' value="0" selected="selected">No</option>';
	$html.= '<option '.$disabled.' value="1">Yes</option>';
} else{
	$html.= '<option '.$disabled.' value="1" selected="selected">Yes</option>';
	$html.= '<option '.$disabled.' value="0">No</option>';
}

$html.= '</select>';
$html.= '</div>';

return $html;

}

?>
