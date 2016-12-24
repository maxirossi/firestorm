<?php

function select_multiple($table, $row,$titulo,$label,$tabla,$campo,$cant=0,$where='',$orden='orden',$array='',$esAjax=0,$necesario=0,$disabled=false) {


$html = '<div class="form-group">';
$CI =& get_instance();

if($disabled) $disabled = ' disabled="disabled" ';

//$claz = explode('__',$contenedor_pre_name.'contenedor_'.$titulo);
$claz2 = explode('__',$titulo);
$count = array();
//if($esAjax==0) sl('<div id="'.$contenedor_pre_name.'contenedor_'.$titulo.'" class="'.$claz[0].'">');

// EXPLODE CAMPO
$trozos = explode(',',$campo);

// EXPLODE ROW
$row = explode(',',$row);

$i=0;

//print_r($row);die();

foreach($row as $combined){
	$count[$i] = $i;
	$i++;
}

$row = array_combine($row,$count);

if(is_array($array)) {
	$sql = $array;
}else {
	$sql = $CI->modules->getDataCombo($table, $where, $orden);
}

$cantidad = count($sql);

if ($necesario==1) {
	$html.= '<label for="' . $campo . '">'.ucfirst($label).'</label>';
}else {
	$html.= '<label for="' . $campo . '">'.ucfirst($label).'</label>';	
}

//if ($cant) $conteo = 'onchange="countSelected(this,'.$cant.')" onkeyup="countSelected(this,'.$cant.')"';
$conteo = 0;
$html.= '<select '.$disabled.' class="multiple-select form-control '.$claz2[0].' "  name="'.$titulo.'" id="'.$titulo.'" multiple title="- Seleccione '.$label.' -">';

	foreach ($sql as $i=>$values) {
		if (!empty($values->id)){
		$html.='<option '.$disabled.' value="'. $values->id .'"';
		if(is_array($row)) {
		if (array_key_exists($values->id,$row)) {
		$html.= ' selected="selected"';
		}else {
		$html.= '';	
		}
		}else {
		if(strpos($row,$sql['id']) === false){
  		$html.= '';
		}else {
		$html.= ' selected="selected"';
		}
		}
		$html.= '>';
		foreach($trozos as $item) {
		$html.= ucfirst(html_entity_decode($values->nombre)).'. ';
		}
		}
		$html.= '</option>';
	}

$html.= '</select>';
$html.= '</div>';


return $html;

}

?>