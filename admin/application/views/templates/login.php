<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"> <i class="fa fa-user fa-fw"></i> <?=$lang['please-log-in']?></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="<?=$appUrlLogin?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="<?=$lang['usuario']?>" name="user" type="text" autofocus required="required">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="pwd" type="password" value="" required="required">
                                </div>
                                <!--
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">
                                        <?=$lang['recordarme-login']?>
                                    </label>
                                </div>
                                -->
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block"><?=$lang['entrar']?></button>
                                <?php
                                	if (!empty($this->input->get('err'))){
                                		echo('<div class="alert alert-danger" style="margin-top:5px">' . $lang['login-error'] . '</div>');
                                	}
                                ?>
                            </fieldset>
                        </form>

                        <div id="clientLogo">
                            <i class="fa fa-code" aria-hidden="true" style="font-size:36px"></i> 
                            <!--<img src="<?=$this->config->item('appClientLogo')?>" alt="" height="70" />-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>