<?php
    //print_r($list);die();
?>
<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-code" aria-hidden="true"></i> <?=$lang['panel-de-control']?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php
    if( $list['listStatus'] == 1){
?>
 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4><i class="fa fa-list-alt" aria-hidden="true"></i> <?=$lang['listado-de']?> <?=$list['items']?></h4>
                        </div>
                        <div class="alert alert-info alert-dismissable" id="gridCreate">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <a href="<?=$appGridAdd?><?=$module?>"><i class="fa fa fa-plus-circle"></i> <?=$lang['crear-nuevo']?> <strong><?=$list['items']?></strong></a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <?php
                                        $html = '';
                                            foreach ($list['listData-fields'] as $i=>$v){
                                                $html .= 
                                                '
                                                    <th>' . $v . '</th>
                                                ';
                                            }
                                            $html .=
                                            '
                                                 <th>' . $lang['actions'] . '</th>
                                            ';
                                        ?>
                                        <?=$html?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $html = '';
                                        for ($i=0; $list['nRows'] > $i; $i++) { 
                                            $id = 0;
                                            $rowID = 'row-' . $i;
                                            $html .=  '<tr class="odd gradeX" id="' . $rowID. '"> ';
                                            $editable = '';
                                                foreach ($list['listData-fields'] as $i2=>$v){
                                                $col = $list['listData-fields'][$i2];
                                                if ($col == 'id'){
                                                    $id = $list[$i][$v];
                                                }
                                                if (in_array($col, $list['listData-editableFields'])){
                                                    $editable = 'contenteditable';
                                                }else{
                                                    $editable = '';
                                                }
                                                $html.=
                                                '
                                                    <td><div ' . $editable . '>' . $list[$i][$v] . '</div></td>
                                                ';
                                                }
                                                $html .='
                                                <!-- add more, edit, delete buttons -->
                                                    <th>
                                                    <div class="grid-edit-buttons">
                                                        <a href="' . $appGridEdit . $module . '/id/' . $id . '"  class="btn btn-success"><i class="fa fa-pencil-square-o"></i></a>
                                                        <a href="javascript:deleteItem(\'' . $id . '\',\'' . $list['table'] . '\',\'' . $rowID . '\');"  class="btn btn-danger"><i class="fa fa fa-trash-o"></i></a>
                                                        <!--<a href="#" ng-click="grid-edit" data-id="' . $id . '" data-module="' . $module . ' data-action="" class="btn btn-warning"><i class="fa fa fa-check-square-o"></i></a>-->
                                                    </div>
                                                    </th>
                                                ';
                                            $html .= '</tr>';
                                        }
                                    ?>
                                    <?=$html?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            </div>

<?php
    }else{
        echo $list['dataMessage'];
    }
?>