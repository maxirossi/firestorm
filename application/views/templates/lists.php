  <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('<?=$backgroundImg?>')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="page-heading">
                        <h1><?=$data['title']?></h1>
                        <hr class="small">
                        <span class="subheading"><?=$data['subtitle']?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
              <h1>FrontEnd</h1>
              <?php
                /* frontEnd */
                if (isset($frontEnd)){
                    $html = '<ul>';
                        foreach($frontEnd as $i=>$v){
                            if ($v['title']){
                                 $html .= '<li>' . $v['title'] . '</li>';
                            } 
                        }
                     $html .= '</ul>';
                     echo($html);
                }
                ?>
                <h2>BackEnd</h1>
                <?php
                /* .frontEnd */
                 if (isset($backEnd)){
                    $html = '<ul>';
                        foreach($backEnd as $i=>$v){
                            if ($v['title']){
                                 $html .= '<li>' . $v['title'] . '</li>';
                            } 
                        }
                     $html .= '</ul>';
                     echo($html);
                }
              ?>
              <h2>Database</h2>
              <ul>
                <li>MySQL</li>
              </ul>
            </div>
        </div>
    </div>

    <hr>