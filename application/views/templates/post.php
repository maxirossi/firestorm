
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('<?=$backgroundImg?>')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <h1><?=$post['title']?></h1>
                        <h2 class="subheading"><?=$post['summary']?></h2>  
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="pull-right">
                    <?php
                        if (isset($htmlImages)){
                            echo($htmlImages);
                        }
                    ?>
                </div>
                    <?=$post['description']?>
                </div>
            </div>
        </div>
    </article>

    <hr>
