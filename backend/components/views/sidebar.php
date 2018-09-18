<?php
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;
use yii\helpers\Url;
AdminAsset::register($this);
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     <ul class="sidebar-menu">
       <?php 
       foreach ($menus as $key) {
          
        foreach ($key as $menu) {
            //echo $menu['id'];
            ?>
            <li class="treeview" id="<?php echo $menu['id']; ?>">
                <?php if ($menu['href']) { ?>
                <a href="<?php echo $menu['href']; ?>"><i class="fa <?php echo $menu['icon']; ?> fw"></i>
                    <span><?php echo $menu['name']; ?></span>
                </a>
                <?php } else { ?>
                <a class="parent"><i class="fa <?php echo $menu['icon']; ?> fw"></i>
                    <span><?php echo $menu['name']; ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <?php } ?>
                <?php if ($menu['children']) { ?>
                <ul class="treeview-menu">
                    <?php foreach ($menu['children'] as $children_1) { ?>
                    <li class="treeview">
                        <?php if ($children_1['href']) { ?>
                        <a href="<?php echo $children_1['href']; ?>"><?php echo $children_1['name']; ?></a>
                        <?php } else { ?>
                        <a class="parent"><?php echo $children_1['name']; ?></a>
                        <?php } ?>
                        <?php if ($children_1['children']) { ?>
                        <ul class="treeview-menu">
                            <?php foreach ($children_1['children'] as $children_2) { ?>
                            <li class="treeview">
                                <?php if ($children_2['href']) { ?>
                                <a href="<?php echo $children_2['href']; ?>"><?php echo $children_2['name']; ?></a>
                                <?php } else { ?>
                                <a class="parent"><?php echo $children_2['name']; ?></a>
                                <?php } ?>
                                <?php if ($children_2['children']) { ?>
                                <ul>
                                    <?php foreach ($children_2['children'] as $children_3) { ?>
                                    <li><a href="<?php echo $children_3['href']; ?>"><?php echo $children_3['name']; ?></a></li>
                                    <?php } ?>
                                </ul>
                                <?php } ?>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </li>
                    <?php } ?>
                </ul>
                <?php } ?>
            </li>
            <?php  }
        }
        ?>
    </ul>
</section>
</aside>