<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Учет обработки сельскохозяйственных полей</title>
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/styles/main.css">
    </head><!--/head-->

    <body>
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div id="header" class="col-xs-12">
                        <div class="page-header">
                          <h2>Учет обработки сельскохозяйственных полей</h2>
                        </div>
                    </div><!-- header -->
                </div><!-- .row -->
                <div class="row">
                    <div class="col-md-2 panel panel-default">
                        <div id="sidebar">
                            <div class="row">
                                <div id="menu">
                                    <?php 
                                     $links = [
                                        'stages'    => 'Этапы обработки',
                                        'employees' => 'Сотрудники (механизаторы)',
                                        'machines'  => 'Агрегаты',
                                        'fields'    => 'Обрабатываемые поля',
                                        'types'     => 'Виды обработки полей',
                                        'crops'     => 'Разводимые культуры',
                                     ]
                                     ?>
                                    <ul class="nav nav-pills nav nav-pills nav-stacked">
                                        <?php foreach ($links as $linkAlias => $linkName): ?>


                                            <?php $urlPattern = $_GET['route'];
                                            ?>
                                            <li class="<?= (preg_match("~$linkAlias~", $_GET['route'])) ? 'active' : '' ?>"><a href="<?= ROUTE_METHOD ?><?= $linkAlias ?>"><?= $linkName ?></a></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div><!-- #menu -->
                            </div>
                        </div><!-- #sidebar -->
                    </div>
                    <div class="col-md-10">
                        <div id="main-content" class="panel panel-default col-xs-12">

