<?php
/**
 * @param function mapc_file_skin_include($file_arr, $data_arr)
 * @param string $_SESSION['mapc_user_id'] user ID
 * @param string $_SESSION['mapc_user_type'] user Type (nor, adm, mng)
 * @param string $_SESSION['mapc_user_status'] (normal, vip, banned, etc...)
 */
if($_SESSION['mapc_user_id']) {
	$sign_inout_title = _('나가기');
	$sign_inout_url   = $URL['user']['sign_out'];
} else {
	$sign_inout_title = _('들어가기');
	$sign_inout_url   = $URL['user']['sign_in'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            foreach($publish_data['headhook'] as $key => $var) {
                include($var . $key);
            }

            if(is_array($publish_data['head']['css'])) {

                foreach($publish_data['head']['css'] as $file => $dir) {

                    echo '<link href="', $dir, $file, '" rel="stylesheet" type="text/css" media="screen" />', "\n";

                }

            }

            if(is_array($publish_data['head']['js'])) {

                foreach($publish_data['head']['js'] as $file => $dir) {

                    echo '<script type="text/javascript" src="', $dir, $file, '"></script>', "\n";

                }

            }
        ?>
        <style type="text/css">
            body {
                padding-top: 58px;
            }
            .credit {
                text-align: center;
            }
            .col-lg-4 {
                padding-top: 10px;
            }
        </style>
    </head>
    <body class="pre-scrollable">

    <!-- Fixed navbar -->
    <header class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= $URL['core']['main']; ?>"><?= $CONFIG['meta']['title']; ?></a>
        </div>
        <div class="navbar-collapse collapse">

            <?= $publish_data['head']['menu']; ?>

            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="<?= $sign_inout_url; ?>"><?= $sign_inout_title; ?></a></li>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </header>


    <div class="container">

        <div class="col-lg-8">

<!-- 본문:H -->
<?php
    include($section_file);
?>
<!-- 본문:T -->

        </div>

            <div class="col-lg-4 panel panel-info" id="sidebar" role="navigation">

                <?= $publish_data['head']['menu_sub']; ?>

                <p>
                    <?php
                    if(is_array($publish_data['side1_files'])) {

                        foreach($publish_data['side1_files'] as $side1_file) {

                            if(is_file($side1_file)) {

                                include($side1_file);

                            }

                        }

                    }
                    ?>
                </p>

        </div><!--/.panel -->

    </div><!--/.container-->

    <div id="footer" class="navbar-inverse">
      <div class="well">
        <p class="text-muted credit">Copyright <?= $CONFIG['meta']['copyright']; ?></p>
      </div>
    </div>

    </body>

</html>
