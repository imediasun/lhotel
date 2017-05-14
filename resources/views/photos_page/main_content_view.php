
       <!--CONTENT CONTAINER-->
        <!--===================================================-->
        <div id="content-container">

            <div class="pageheader">
                <h3><i class="fa fa-home"></i> Gallery </h3>
                <div class="breadcrumb-wrapper"> <span class="label">You are here:</span>
                    <ol class="breadcrumb">
                        <li> <a href="#"> Home </a> </li>
                        <li class="active"> Gallery </li>
                    </ol>
                </div>
            </div>

            <!--Page content-->
            <!--===================================================-->
            <div id="page-content">



                <div class="gamma-container gamma-loading" id="gamma-container">

                    <ul class="gamma-gallery">

                        <?php foreach($photos as $photo){

                            ?>
                            <li>
                                <div data-alt="img03" data-description="<h3>Lhotel</h3>" data-max-width="1800" data-max-height="1350">
                                    <div data-src="photos/<?php echo $photo->image_large?>" data-min-width="1300"></div>
                                    <div data-src="photos/<?php echo $photo->image_large?>" data-min-width="1000"></div>
                                    <div data-src="photos/<?php echo $photo->image_large?>" data-min-width="700"></div>
                                    <div data-src="photos/<?php echo $photo->image_large?>" data-min-width="300"></div>
                                    <div data-src="photos/<?php echo $photo->image_large?>" data-min-width="200"></div>
                                    <div data-src="photos/<?php echo $photo->image_large?>" data-min-width="140"></div>
                                    <div data-src="photos/<?php echo $photo->image_large?>"></div>
                                    <noscript>
                                        <img src="photos/<?php echo $photo->image_large?>" alt="img03" />
                                    </noscript>
                                </div>
                            </li>
                            <?php
                        }?>



                    </ul>

                    <div class="gamma-overlay"></div>

                   <!-- <div id="loadmore" class="loadmore btn btn-default btn-block">loading more items...</div>-->

                </div>


            </div>
            <!--===================================================-->
            <!--End page content-->


        </div>
        <!--===================================================-->
        <!--END CONTENT CONTAINER-->





