

  <div class="boxed">

        <div id="content-container">

            <div class="pageheader">
                <h3><i class="fa fa-home"></i> Установка цен на номера </h3>
                <div class="breadcrumb-wrapper"> <span class="label">Вы здесь:</span>
                    <ol class="breadcrumb">
                        <li> <a href="#"> Главная </a> </li>
                        <li class="active"> Установка цен на номера </li>
                    </ol>
                </div>
            </div>

            <div id="page-content">
            <form method="post" action="/admin/rooms_prices_">
             <div class="row">

                 <div class="col-sm-4">



                 </div>

                 <div class="col-sm-8">
                     <h3>Информация о занятости и цене</h3>



                 </div>
             </div>

            </form>

            </div>


        </div>





    </div>




    <div class="boxed">

        <!--CONTENT CONTAINER-->
        <!--===================================================-->
        <section id="content-container">


            <!--Page content-->
            <!--===================================================-->
            <section id="page-content">
            <form method="post" action="/admin/setting_room_price">
                <div class="row">
                    <div class="col-lg-4">

                        <div class="panel">
                            <div class="panel-heading">

                                <h3 class="panel-title">Вобор номеров для установки цены на период</h3>
                            </div>

                            <?php foreach ($rooms as $room) {
                         ?>
                            </br>
                            <label class="form-checkbox form-icon btn btn-success btn-labeled active form-text">
                                <input name="check_<?php echo $room['original']['id'];?>" type="checkbox" value="<?php echo $room['original']['id'];?>"> <?php echo $room['original']['number']; echo $room['original']['name']; ?>

                            </label>
                            <?

                     }?>

                        </div>







                    </div>

                    <div class="col-lg-8">


                        <div class="panel">
                            <div class="panel-heading">

                                <h3 class="panel-title">Установить цену</h3>
                            </div>
                            <div class="panel-body">
                                <h4 class="text-thin">Horizontal</h4>
                                <div class="row">
                                    <div style="display:none" class="col-xs-6">
                                        <p class="text-thin mar-btm">Default</p>

                                        <!--Default Range Slider-->
                                        <!--===================================================-->
                                        <div id="demo-range-def"></div>
                                        <!--===================================================-->

                                        <br>
                                        <div> <strong>Value : </strong> <span id="demo-range-def-val"></span> </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <p class="text-thin mar-btm"></p>

                                        <!--Range Slider : Steps-->
                                        <!--===================================================-->
                                        <div id="demo-range-step"></div>
                                        <!--===================================================-->

                                        <br>
                                        <div> <strong>Грн : </strong> <input name="price_per_day" type="text" id="demo-range-step-val"> </div>
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <br>
                                <h4 style="display:none" class="text-thin">Vertical</h4>
                                <p style="display:none" class="text-thin mar-btm">Fixed Drag</p>
                                <div style="display:none" class="mar-rgt box-inline">

                                    <!--Vertical Range Slider-->
                                    <!--===================================================-->
                                    <div id="demo-range-ver1" class="range-vertical"></div>
                                    <div id="demo-range-ver2" class="range-vertical"></div>
                                    <div id="demo-range-ver3" class="range-vertical"></div>
                                    <div id="demo-range-ver4" class="range-vertical"></div>
                                    <div id="demo-range-ver5" class="range-vertical"></div>
                                    <!--===================================================-->

                                </div>
                                <div style="display:none" id="demo-range-vpips" class="demo-pips range-vertical pips"></div>
                                <br>
                                <hr>
                                <br>
                                <h4 style="display:none" class="text-thin">Slider behaviour</h4>
                                <div style="display:none" class="row">
                                    <div class="col-xs-6">
                                        <p class="text-thin mar-btm">Drag</p>

                                        <!--Range Slider : Drag -->
                                        <!--===================================================-->
                                        <div id="demo-range-drg"></div>
                                    </div>
                                    <div style="display:none" class="col-xs-6">
                                        <p class="text-thin mar-btm">Fixed Drag</p>

                                        <!--Range slider : Fixed Drag -->
                                        <!--===================================================-->
                                        <div id="demo-range-fxt"></div>
                                    </div>
                                    <div style="display:none" class="col-xs-6">
                                        <p style="display:none" class="text-thin mar-btm">Combinate</p>

                                        <!--Range Slider : Combinate -->
                                        <!--===================================================-->
                                        <div style="display:none" id="demo-range-com"></div>
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <br>
                                <h4 style="display:none" class="text-thin mar-btm">Pips</h4>

                                <!--Range Slider : Pips -->
                                <!--===================================================-->
                                <div style="display:none" id="demo-range-hpips" class="demo-pips pips"></div>
                                <!--===================================================-->

                            </div>
                        </div>





                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-control">
                                    <button class="btn btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></button>
                                    <button class="btn btn-default" data-click="panel-reload"><i class="fa fa-refresh"></i></button>
                                    <button class="btn btn-default" data-click="panel-collapse"><i class="fa fa-chevron-down"></i></button>
                                    <button class="btn btn-default" data-dismiss="panel"><i class="fa fa-times"></i></button>
                                </div>
                                <h3 class="panel-title">Bootstrap Datepicker</h3>
                            </div>
                            <div class="panel-body">

                                <!--===================================================-->

                                <br>
                                <hr>
                                <br>
                                <p class="text-thin mar-btm">Range</p>

                                <!--Bootstrap Datepicker : Range-->
                                <!--===================================================-->
                                <div id="demo-dp-range">
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="form-control" name="start" />
                                        <span class="input-group-addon">to</span>
                                        <input type="text" class="form-control" name="end" />
                                    </div>
                                </div>

                             <input style="margin-top:100px" type="submit" class="btn btn-success" value="Установить цену">
                            </div>
                        </div>



                    </div>
                </div>
            </form>
            </section>
            <!--===================================================-->
            <!--End page content-->


        </section>
        <!--===================================================-->
        <!--END CONTENT CONTAINER-->




    </div>

