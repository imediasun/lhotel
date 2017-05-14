



    <div class="boxed">

        <!--CONTENT CONTAINER-->
        <!--===================================================-->
        <div id="content-container">

            <div class="pageheader">
                <h3><i class="fa fa-home"></i> Datatable Table </h3>
                <div class="breadcrumb-wrapper"> <span class="label">You are here:</span>
                    <ol class="breadcrumb">
                        <li> <a href="#"> Home </a> </li>
                        <li class="active"> datatable Table </li>
                    </ol>
                </div>
            </div>

            <!--Page content-->
            <!--===================================================-->
            <div id="page-content">

                <!-- Basic Data Tables -->
                <!--===================================================-->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Основна таблиця управління товарами</h3>
                    </div>
                    <div class="panel-body">
                        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Найменування товару</th>
                                <th>Ціна</th>
                                <th class="min-desktop">Видалити</th>
                                
                            </tr>
                            </thead>
                            <tbody>

                            <?php

                            foreach($goods as $good){

                              ?>
                                <tr>
                                    <td><?php echo $good['original']['name'];?></td>
                                    <td><?php echo $good['original']['price'];?></td>
                                    
                                    
                                    <td>
                                        <input type="hidden" class="good_id" name="good_id" value="<?php echo $good['original']['id'];?>">
                                        <button class="delete_btn btn btn-danger btn-icon icon-lg fa fa-times"></button></td>
                              

                                </tr>



                              <?

                            }
                            ?>


                            </tbody>
                        </table>
                    </div>
                </div>
                <!--===================================================-->
                <!-- End Striped Table -->





            </div>
            <!--===================================================-->
            <!--End page content-->


        </div>
        <!--===================================================-->
        <!--END CONTENT CONTAINER-->
        <script>
        
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            })
          

            $('.delete_btn').click(function(){

                var txt;
                var r = confirm("Видалити товар ?");
                if (r == true) {
                    var good = $(this).parent('td').find('.good_id').val();

                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        url: '/admin/func_delete_good',
                        data: {good: good}, // serializes the form's elements.
                        success: function (data) {

                            if (data == 'deleted') {
                                alert('товар видален'); // show response from the php script.}
                            } else {
                                alert('помилка !')
                            }
                            location.reload();
                        }

                    });
                } else {
                    txt = "Ви вибрали відмінити видалення";
                }

            });

        </script>





