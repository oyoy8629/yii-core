<?php
/**
 * @author oba.ou
 */
$this->title = 'Hello , '.yii::$app->user->identity->username;
?>
<div class="box box-danger">
    <div class="box-header with-border"><h3 class="box-title">当前服务器部分信息如下：</h3><h1></h1></div>
    <div class="box-body">
        <table class="table table-bordered table-hover">
            <tr>
                <td width="200">服务器操作系统</td>
                <td><?php $os = explode(" ", php_uname()); echo $os[0];?>&nbsp;内核版本：<?php if('/'==DIRECTORY_SEPARATOR){echo $os[2];}else{echo $os[1];} ?></td>
            </tr>
            <tr>
                <td>服务器软件</td>
                <td><?= $_SERVER['SERVER_SOFTWARE'];?></td>
            </tr>
            <tr>
                <td width="200">PHP版本（php_version）</td>
                <td><?=PHP_VERSION?></td>
            </tr>
            <tr>
                <td width="200">PHP已编译模块检测</td>
                <td>
                    <?php
                    $able=get_loaded_extensions();
                    foreach ($able as $key=>$value) {
                        if ($key!=0 && $key%13==0) {
                            echo '<br />';
                        }
                        echo "<span class=\"badge bg-green\">$value&nbsp;&nbsp;</span>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="200">被禁用的函数（disable_functions）</td>
                <td>
                    <?php
                    $disFuns=get_cfg_var("disable_functions");
                    if($disFuns) {
                        $disFunsArray =  explode(',',$disFuns);
                        foreach ($disFunsArray as $key=>$value)
                        {
                            if ($key!=0 && $key%5==0) {
                                echo '<br />';
                            }
                            echo "<span class=\"badge bg-yellow\">$value&nbsp;&nbsp;</span>";
                        }
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="200">脚本占用最大内存（memory_limit）</td>
                <td><?php echo get_cfg_var("memory_limit");?></td>
            </tr>
            <tr>
                <td>POST方法提交最大限制（post_max_size）</td>
                <td><?php echo get_cfg_var("post_max_size");?></td>
            </tr>
            <tr>
                <td>上传文件最大限制（upload_max_filesize）</td>
                <td><?php echo get_cfg_var("upload_max_filesize");?></td>
            </tr>
            <tr>
                <td>Mysql版本</td>
                <td><?= yii::$app->db->createCommand("SELECT VERSION()")->queryScalar()?></td>
            </tr>
            <tr>
                <td>追踪代码</td>
                <td>
                    <pre>
                        <?php

$str = <<<CODE


<input type="hidden" id="RegisterSuccess" value="aaaabbbb" />
<input type="hidden" id="RegisterReferrer" value="1" />

乐宝 = 1
永利会 = 2

落地
<script  type="text/javascript" src="//tj.sasa8.com/ld.js"></script>




推广
<script  type="text/javascript" src="//tj.sasa8.com/tg.js"></script>





注册
<script  type="text/javascript" src="//tj.sasa8.com/zc.js"></script>
CODE;
?>

                        <?=\kartik\helpers\Html::encode($str)?>
                    </pre>
                </td>
            </tr>
        </table>
    </div>
</div>
