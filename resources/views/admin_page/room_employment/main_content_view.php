

    <div class="boxed">

        <!--CONTENT CONTAINER-->
        <!--===================================================-->
        <div id="content-container">

            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div class="pageheader">
                <h3><i class="fa fa-home"></i> Поселить в номер </h3>
                <div class="breadcrumb-wrapper"> <span class="label">Вы здесь:</span>
                    <ol class="breadcrumb">
                        <li> <a href="#"> Главная </a> </li>
                        <li class="active"> Поселить в номер </li>
                    </ol>
                </div>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->

            <!--Page content-->
            <!--===================================================-->
            <div id="page-content">

             <div class="row">

                 <div class="col-sm-6">
                     <h3>Поселить в номер</h3>
                     <select class="sel_room_pref form-control" name="type" placeholder="Виберите номер" />
                     <?php
                     foreach($rooms as $key=>$val){
                         ?>
                         <option value="<?php echo $val['original']['id'];?>"><?php echo $val['original']['number']; echo $val['original']['name']; ?></option>
                         <?
                     }
                     ?>

                     </select>
                 </div>

                 <div class="col-sm-6">
                     <h3>Информация о занятости и цене</h3>
                     <select class="sel_room form-control" name="type" placeholder="Виберите номер" />
                     <?php
                     foreach($rooms as $key=>$val){
                         ?>
                         <option value="<?php echo $val['original']['id'];?>"><?php echo $val['original']['number']; echo $val['original']['name']; ?></option>
                         <?
                     }
                     ?>

                     </select>
                 </div>
             </div>



            </div>
            <!--===================================================-->
            <!--End page content-->

        </div>
        <!--===================================================-->
        <!--END CONTENT CONTAINER-->




    </div>

    <script>

        $('.sel_room option').click(function(){
          var room=$(this).val()
          location.href="/admin/view_room/"+room

        })
        $('.sel_room_pref option').click(function(){
            var room=$(this).val()
            location.href="/admin/employ_room/"+room

        })
    </script>


   

