<div class="box-event-detail">
    <div class="content">
        <div class="right-side">
            <h1>
                <?php echo $room_photos->name ;?>
            </h1>

            <div class="subcaption">
                <?php echo $room_photos->description ;?>
            </div>










































        </div>

        <div class="image-container">
            <div class="image">
                <img data-img-xs="/photos/<?php echo $room_photos->image_large ;?>" src="/photos/<?php echo $room_photos->image_medium ;?>" alt="">
            </div>
        </div>


    </div>

    <div class="clearfix"></div>









    <div class="event-offer">
        <h2><?php echo $room_photos->slogan ;?></h2>
        <div class="benefits">

            <ul>
                <li>

                    <?php
                    if($room_photos->shower=='on'){
                        ?>
                        <div class="icon">
                            <img src="/img/51-200.png" alt="">
                        </div>
                        Душ

                        <?


                    }
                    ?>

                </li>
                <li>
                    <?php
                    if($room_photos->wc=='on'){
                        ?>
                        <div class="icon">
                            <img src="/img/Clean-toilet-512.png" alt="">
                        </div>
                        Туалет

                        <?


                    }
                    ?>
                </li>
                <li>
                    <?php
                    if($room_photos->wc=='on'){
                        ?>
                        <div class="icon">
                            <img src="/img/tv-icon-13.png" alt="">
                        </div>
                        ТВ

                        <?


                    }
                    ?>
                </li>
                <li>
                    <?php
                    if($room_photos->ac=='on'){
                        ?>
                        <div class="icon">
                            <img src="/img/airconditioning-512.png" alt="">
                        </div>
                        Кондиционер

                        <?


                    }
                    ?>
                </li>
                <li>
                    <?php
                    if($room_photos->ac=='on'){
                        ?>
                        <div class="icon">
                            <img src="/img/mini_refrigerator-512.png" alt="">
                        </div>
                        Холодильник

                        <?


                    }
                    ?>
                </li>
                <li>
                    <?php
                    if($room_photos->ac=='on'){
                        ?>
                        <div class="icon">
                            <img src="/img/Microwave-512.png" alt="">
                        </div>
                        Микроволновка

                        <?


                    }
                    ?>
                </li>
                <li>
                    <?php
                    if($room_photos->ac=='on'){
                        ?>
                        <div class="icon">
                            <img src="/img/House and Appliances Electric teapot.png" alt="">
                        </div>
                        Чайник

                        <?


                    }
                    ?>
                </li>
            </ul>

        </div>
    </div>


    <!-- box-interior-view -->
    <div class="box-interior-view">

        <div class="container">

            <div id="interior-view-slider" class="anim-to">



                <div class="slides">

                    <?php
                    foreach ($room_photos->photos as $photo){

                        ?>
                        <div class="room slick-show-button room-0" data-index="1">
                            <a class="filter" href="/photos/<?php echo $photo->image_large?>">
                                <img src="/photos/<?php echo $photo->image_large?>" alt="">
                            </a>
                        </div>



                        <?

                    }
                    ?>





                </div>

                <div class="interior-view-nav">
                    <a class="arrow-left prev" href="javascript:;" data-stroke-color="#44504c">
                        <img class="show-hover" src="img/arrow_next_light.svg" alt="">
                        <img src="img/arrow_prev_gold.svg" alt="">
                    </a>

                    <div class="numbers">
                        <span class="current">1</span>
                        <span>/</span>
                        <span class="total all">6</span>
                    </div>

                    <a class="arrow-right next" href="javascript:;" data-stroke-color="#44504c">
                        <img class="show-hover" src="img/arrow_next_light.svg" alt="">
                        <img src="img/arrow_prev_gold.svg" alt="">
                    </a>

                </div>

            </div>
            <!-- Slider -->

        </div>



    </div>
    <!-- box-interior-view -->


















    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">


        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Занятость номера по датам</h3>
                        </div>
                        <div class="panel-body">
                            <!-- Timeline -->
                            <!--===================================================-->
                            <div class="timeline">






                                <div class="timeline-entry">

                                    <div class="timeline-label">

                                        <div class="panel">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Calendar</h3>
                                            </div>
                                            <div class="panel-body">
                                                <!-- Calendar placeholder-->
                                                <!-- ============================================ -->
                                                <div id="demo-calendar" class="fc fc-ltr fc-unthemed">

                                                </div>
                                                <!-- ============================================ -->

                                                <script>

                                                    // Misc-FullCalendar.js
                                                    // ====================================================================
                                                    // This file should not be included in your project.
                                                    // This is just a sample how to initialize plugins or components.
                                                    //
                                                    // - ThemeOn.net -
                                                    var dayModalEdited;
                                                    var mini_array = new Array();

                                                    $(document).ready(function () {

                                                        $.ajaxSetup({
                                                            headers: {
                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                            }
                                                        });
                                                        $.ajax({
                                                            type: "POST",
                                                            dataType: 'json',
                                                            url: '/get_calendar_data',
                                                            data: {room_id:<?php echo $room?>},
                                                            success: function (data_) {

                                                                var _data_ = data_;
                                                                // initialize the external events
                                                                // -----------------------------------------------------------------
                                                                $('#demo-external-events .fc-event').each(function () {
                                                                    // store data so the calendar knows to render an event upon drop
                                                                    $(this).data('event', {
                                                                        title: $.trim($(this).text()), // use the element's text as the event title
                                                                        stick: true, // maintain when user navigates (see docs on the renderEvent method)
                                                                        className: $(this).data('class'),
                                                                        type: $(this).data('type')
                                                                    });
                                                                    // make the event draggable using jQuery UI
                                                                    $(this).draggable({
                                                                        zIndex: 99999,
                                                                        revert: true,      // will cause the event to go back to its
                                                                        revertDuration: 0  //  original position after the drag
                                                                    });
                                                                });
                                                                // Initialize the calendar
                                                                // -----------------------------------------------------------------
//                                                                var massiv = new Array();
                                                                $.each(_data_, function (key, value) {
                                                                    mini_array.push({
                                                                        title: value.price_per_day + 'грн. ' + value.title,
                                                                        start: value.start_data,
                                                                        end: value.end_data,
                                                                        id: value.id,
                                                                        type: value.type,
                                                                        className: value.class_name,
                                                                        room_id: value.room_id,
                                                                        price_per_day: value.price_per_day
                                                                    });
                                                                });
//                                                                console.log(mini_array);
                                                                $('#demo-calendar').fullCalendar({
                                                                    header: {
                                                                        left: 'prev,next, today',
                                                                        center: 'title',
                                                                        right: 'month,agendaWeek,agendaDay'
                                                                    },
                                                                   /* editable: true,*/
                                                                   /* droppable: true,*/ // this allows things to be dropped onto the calendar
                                                                    defaultDate: '2017-04-04',
                                                                    selectable: true,
                                                                    allDayDefault: true,
                                                                    selectHelper: true,
                                                        /*            select: function (start, end) {
                                                                        clearModalData();
                                                                        dayModalEdited = {
                                                                            start: start,
                                                                            end: end
                                                                        };
                                                                        $("#dayEdit").modal("show");
                                                                        setTimeout(function () {
                                                                            $('input.event_title').get(0).focus()
                                                                        }, 1000);
                                                                    },*/
                                                    /*                eventClick: function (calEvent) {
                                                                        clearModalData();
                                                                        $('.event_id').val(calEvent.id);
                                                                        $('.event_title').val(calEvent.title);
                                                                        $('.event_price').val(calEvent.price_per_day);
                                                                        $('.event_status').each(function () {
                                                                            if ($(this).val() == calEvent.type) {
                                                                                $(this).prop('checked', true);
                                                                            }
                                                                        });
                                                                        $("#dayEdit").modal("show");
                                                                        setTimeout(function () {
                                                                            $('input.event_title').get(0).focus()
                                                                        }, 1000);
                                                                    },*/
                                                                        /*  eventDrop: function (event) {

                                                                        var update_event = {
                                                                            id: event.id,
                                                                            start_data: event.start,
                                                                            end_data: event.end,
                                                                            room_id: mini_array[0].room_id
                                                                        };*/
                                                  /*                      $.ajax({
                                                                            type: 'POST',
                                                                            url: '/admin/setting_room_price',
                                                                            contentType: "application/json",
                                                                            data: JSON.stringify(update_event),
                                                                            success: function (response) {
                                                                                if (response == 'true') {
                                                                                    $('#demo-calendar').fullCalendar('refetchEvents');
                                                                                    console.log('Сохранено!');
                                                                                }
                                                                                else {
                                                                                    console.log('Но нет, сохранить не удалось!');
                                                                                }
                                                                            }
                                                                        });
                                                                    },*/
                                                                    eventResize: function (event) {
                                                                        var update_event = {
                                                                            id: event.id,
                                                                            start_data: event.start,
                                                                            end_data: event.end,
                                                                            room_id: mini_array[0].room_id
                                                                        };
                                                     /*                   $.ajax({
                                                                            type: 'POST',
                                                                            url: '/admin/setting_room_price',
                                                                            contentType: "application/json",
                                                                            data: JSON.stringify(update_event),
                                                                            success: function (response) {
                                                                                if (response == 'true') {
                                                                                    $('#demo-calendar').fullCalendar('refetchEvents');
                                                                                    console.log('Сохранено!');
                                                                                }
                                                                                else {
                                                                                    console.log('Но нет, сохранить не удалось!');
                                                                                }
                                                                            }
                                                                        });*/
                                                                    },
                                                                    eventRender: function (event, element) {
                                                                        element.html(event.title + '<!--<span class="removeEvent glyphicon glyphicon-trash pull-right" data-action="delete"></span>--><div class="fc-resizer"></div>');
                                                                        element.find('.removeEvent').click(function () {
                                                                            $('#demo-calendar').fullCalendar('removeEvents', event._id);
                                                          /*                  $.ajax({
                                                                                type: 'POST',
                                                                                url: '/delete_calendar_data',
                                                                                data: {
                                                                                    id: event.id,
                                                                                    room_id: mini_array[0].room_id
                                                                                },
                                                                                success: function (response) {
                                                                                    if (response == 'true') {
                                                                                        $('#demo-calendar').fullCalendar('refetchEvents');
                                                                                        console.log('Удалено!');
                                                                                    }
                                                                                    else {
                                                                                        console.log('Но нет, удалить не удалось!');
                                                                                    }
                                                                                }
                                                                            });*/
                                                                        });
                                                                    },
                                                             /*       drop: function (date, jsEvent) {
                                                                        dayModalEdited = {
                                                                            start: date,
                                                                            end: date
                                                                        };
                                                                        clearModalData();
                                                                        $('.event_status').each(function () {
                                                                            if ($(this).val() == jsEvent.toElement.dataset.type) {
                                                                                $(this).prop('checked', true);
                                                                            }
                                                                        });
                                                                        $("#dayEdit").modal("show");
                                                                        setTimeout(function () {
                                                                            $('input.event_title').get(0).focus()
                                                                        }, 1000);
                                                                    },*/
//                                                                    eventAfterRender: function (event, element, view) {
//                                                                        $(element).attr("id", "event_id_" + event._id);
//                                                                    },
                                                                    eventLimit: false, // allow "more" link when too many events
                                                                    events: function (start, end, timezone, callback) {
                                                                        var events = [];
                                                                    $.ajax({
                                                                            type: "POST",
                                                                            dataType: 'json',
                                                                            url: '/get_calendar_data',
                                                                            data: {room_id:<?php echo $room?>},
                                                                            success: function (data_) {
                                                                                var _data_ = data_;
                                                                                $.each(_data_, function (key, value) {
                                                                                    events.push({
                                                                                        title: value.price_per_day + 'грн. ' + value.title,
                                                                                        start: value.start_data,
                                                                                        end: value.end_data,
                                                                                        id: value.id,
                                                                                        type: value.type,
                                                                                        className: value.class_name,
                                                                                        room_id: value.room_id,
                                                                                        price_per_day: value.price_per_day
                                                                                    });
                                                                                });
                                                                                callback(events);
                                                                            }
                                                                        });
                                                                    }
                                                                });
                                                            }

                                                        });

                                                        // Calendar
                                                        // =================================================================
                                                        // Require Full Calendar
                                                        // -----------------------------------------------------------------
                                                        // http://fullcalendar.io/
                                                        // =================================================================

//                                                        saveDay();

                                                  /*      $('#dayEdit').on('hidden.bs.modal', function () {
                                                            clearModalData();
                                                        });*/
                                                        $('.save_day').on('click', function () {
                                                            var start = dayModalEdited.start;
                                                            var end = dayModalEdited.end;
                                                            var title = $('.event_title').val();
                                                            var price_per_day = $('.event_price').val();
                                                            var status = $('input.event_status:checked').val();
                                                            var class_name;
                                                            if (status == 'free') {
                                                                class_name = 'purple';
                                                            } else {
                                                                if (status == 'booked') {
                                                                    class_name = 'mint';
                                                                } else {
                                                                    class_name = 'warning';
                                                                }
                                                            }
                                                            var new_event = {
                                                                title: title,
                                                                price_per_day: price_per_day,
                                                                start: start,
                                                                start_data: start,
                                                                end: end,
                                                                end_data: end,
                                                                type: status,
                                                                className: class_name,
                                                                room_id: mini_array[0].room_id
                                                            };
                                                            $('#demo-calendar').fullCalendar('renderEvent', new_event);
                                                            new_event.class_name = class_name;
                                                            /*
                                                            var id = $('.event_id').val();
                                                            if (id) {
                                                                new_event.id = id;
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: '/admin/update_room_info',
                                                                    contentType: "application/json",
                                                                    data: JSON.stringify(new_event),
                                                                    success: function (response) {
                                                                        if (response == 'true') {
                                                                            $('#demo-calendar').fullCalendar('refetchEvents');
                                                                            console.log('Сохранено!');
                                                                        }
                                                                        else {
                                                                            console.log('Но нет, сохранить не удалось!');
                                                                        }
                                                                    }
                                                                });
                                                            } else {
                                                              $.ajax({
                                                                    type: 'POST',
                                                                    url: '/admin/setting_room_price',
                                                                    contentType: "application/json",
                                                                    data: JSON.stringify(new_event),
                                                                    success: function (response) {
                                                                        if (response == 'true') {
                                                                            $('#demo-calendar').fullCalendar('refetchEvents');
                                                                            console.log('Сохранено!');
                                                                        }
                                                                        else {
                                                                            console.log('Но нет, сохранить не удалось!');
                                                                        }
                                                                    }
                                                                });
                                                            }
                                                            clearModalData();
                                                            $("#dayEdit").modal("hide");*/

                                                        });
                                                    });

                                       /*             function clearModalData() {
                                                        $('.event_id').val('');
                                                        $('.event_title').val('');
                                                        $('.event_price').val('');
                                                        $('.event_status').each(function () {
                                                            if ($(this).val() == 'free') {
                                                                $(this).prop('checked', true);
                                                            } else {
                                                                $(this).prop('checked', false);
                                                            }
                                                        });
                                                    }*/

                                                    function putting(start) {
                                                        $.ajaxSetup({
                                                            headers: {
                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                            }
                                                        });
                                                        alert(start)

                                                    }
                                                </script>

                                            </div>
                                        </div>


                                    </div>
                                </div>


                                <div class="timeline-entry">
                                    <div class="timeline-stat">
                                        <div class="timeline-icon bg-primary"><i class="fa fa-check fa-lg"></i></div>
                                    </div>
                                    <div class="timeline-label"> Номер свободен
                                    </div>
                                </div>
                                <div class="timeline-entry">
                                    <div class="timeline-stat">
                                        <div class="timeline-icon bg-mint"><i class="fa fa-check fa-lg"></i></div>
                                    </div>
                                    <div class="timeline-label"> Номер под бронью
                                    </div>
                                </div>
                                <div class="timeline-entry">
                                    <div class="timeline-stat">
                                        <div class="timeline-icon bg-danger"><i class="fa fa-check fa-lg"></i></div>
                                    </div>
                                    <div class="timeline-label"> Номер занят
                                    </div>
                                </div>

                            </div>
                            <!--===================================================-->
                            <!-- End Timeline -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--===================================================-->
        <!--End page content-->

    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->



























</div>


