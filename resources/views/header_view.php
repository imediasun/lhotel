
<!-- Bpooking Modal -->
<div class="md-modal md-effect-11" id="modal-11">
    <div class="md-content">

        <div class="md-header">
            <div class="md-logo">
                <a href="/"><img src="/img/Logo_small.svg" alt=""></a>
            </div>

            <div class="md-close">
                <img src="/img/hamburger_close_gold.svg" alt="" class="show-hover">
                <img src="/img/hamburger_close_light.svg" alt="" class="">
            </div>
        </div>

        <div class="md-text">
            <h2 class="title">
                Бронирование
            </h2>

            <div class="booking-form">
                <form action="/reserve" method="post">
                    <div>
                        Здравствуйте, меня зовут <span>
                        <!--<span class="input-booking-name">Ваше имя</span>-->
                        <input type="text" class="fluid-input" id="booking-name" name="name" value="" placeholder="Ваше имя">
                    </span>,
                        я планирую отдохнуть в вашей гостинице , дата
                        прибытия <span class="event-date">
                    <input id="event-date" name="date" class="hidden-xs-inline" type="text" placeholder="дд.мм.гггг">
                    <input class="visible-xs-inline" name="date1" id="event-date" type="date" placeholder="дд.мм.гггг"></span> в
                        <span><input name="time" type="time" placeholder="18:00" id="event-time"></span>, необходим номер на
                        <span><input name="count_of_person" type="number" min="1" placeholder="100" class="fluid-input" id="event-people"></span> персон.
                    </div>
                    <div class="contact-info">
                        Со мной можно связаться по эл. почте <span><input name="email" type="email" placeholder="info@fresh-d.net" value="" class="fluid-input" id="event-email"></span>, или позвонив по телефону
                        <span><input name="phone" type="text" class="fluid-input" placeholder="+38 (ххх) ххх-хх-хх" id="event-phone"></span>.
                    </div>
                    <div class="advanced">
                        <label for="">Дополнительную информация</label>
                        <textarea name="additional_info" id="" cols="30" rows="10"></textarea>
                        <div class="form-submit btn-default ujarak">
                            <button  type="submit">Отправить заявку</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>


    </div>
</div>
<!-- Bpooking Modal -->

<header id="header">

    <div class="header-top">
        <div class="container">

            <div class="left hidden-sm">
                <div class="phone">+38 (067) 582-7404</div>
                <div class="address"><a href="">Украина, г. Черноморск, <br>
                        ул. Александрийская, 89</a></div>
            </div>

            <div class="burger visible-sm">

                <span class="si-icon si-icon-hamburger-cross" data-icon-name="hamburgerCross"></span>

            </div>

            <div class="logo">
                <a href="/"><img class="hidden-sm" src="/img/Logo_big.svg" alt=""><img class="visible-sm" src="/img/Logo_small.svg" alt=""></a>
            </div>
            <div class="booking">

                <a href="#booking-form" class="visible-sm md-trigger" data-modal="modal-11">
                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="10.5834mm" height="10.4843mm" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                         viewBox="0 0 56 55"
                         xmlns:xlink="http://www.w3.org/1999/xlink">
                     <defs>
                         <style type="text/css">
                             <![CDATA[
                        .fil0 {fill:#FEFEFE}
                             ]]>
                         </style>
                         <clipPath id="id0">
                             <path d="M54 55l-52 0c-1,0 -2,0 -2,-1l0 -47c0,-1 1,-2 2,-2l9 0 0 -1c0,-2 1,-4 3,-4l3 0c2,0 4,2 4,4l0 1 14 0 0 -1c0,-2 1,-4 4,-4l3 0c2,0 3,2 3,4l0 1 9 0c1,0 2,1 2,2l0 47c0,1 -1,1 -2,1zm-35 -52l-6 0 0 6 6 0 0 -6zm24 0l-6 0 0 6 6 0 0 -6zm11 6c0,-1 -1,-2 -2,-2l-7 0 0 1c0,2 -1,4 -3,4l-3 0c-3,0 -4,-2 -4,-4l0 -1 -14 0 0 1c0,2 -2,4 -4,4l-3 0c-2,0 -3,-2 -3,-4l0 -1 -7 0c-1,0 -2,1 -2,2l0 9 52 0 0 -9zm0 11l-52 0 0 31c0,1 1,2 2,2l48 0c1,0 2,-1 2,-2l0 -31zm-29 25l-6 -7 2 -2 5 5 11 -11 1 2 -11 11 -2 2z"/>
                         </clipPath>
                     </defs>
                        <g id="Слой_x0020_1">
                            <metadata id="CorelCorpID_0Corel-Layer"/>
                            <g style="clip-path:url(#id0)">

                            </g>
                            <path class="fil0" d="M54 55l-52 0c-1,0 -2,0 -2,-1l0 -47c0,-1 1,-2 2,-2l9 0 0 -1c0,-2 1,-4 3,-4l3 0c2,0 4,2 4,4l0 1 14 0 0 -1c0,-2 1,-4 4,-4l3 0c2,0 3,2 3,4l0 1 9 0c1,0 2,1 2,2l0 47c0,1 -1,1 -2,1zm-35 -52l-6 0 0 6 6 0 0 -6zm24 0l-6 0 0 6 6 0 0 -6zm11 6c0,-1 -1,-2 -2,-2l-7 0 0 1c0,2 -1,4 -3,4l-3 0c-3,0 -4,-2 -4,-4l0 -1 -14 0 0 1c0,2 -2,4 -4,4l-3 0c-2,0 -3,-2 -3,-4l0 -1 -7 0c-1,0 -2,1 -2,2l0 9 52 0 0 -9zm0 11l-52 0 0 31c0,1 1,2 2,2l48 0c1,0 2,-1 2,-2l0 -31zm-29 25l-6 -7 2 -2 5 5 11 -11 1 2 -11 11 -2 2z"/>
                        </g>
                    </svg>

                </a>

                <a class="btn-default ujarak hidden-sm md-trigger" data-modal="modal-11"><span>Бронирование</span></a>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <nav>
            <ul>
                <li class="parent">
                    <a href="">Номера</a>
                    <div class="dropdown-container" style="height:auto;width:200px">
                        <ul class="dropdown clearfix" >


                            <?php
                            foreach($rooms as $room){
                             ?>
                            <a href="/room/<?php echo $room->id ?>"><li><?php echo $room->name ?></li></a>

                            <?php


                            }

                            ?>


                        </ul>
                    </div>

                </li>
                <li>
                    <a href="/article">Информация</a>
                   
                </li>

                <li><a href="photos_">Фотографии</a></li>
                <li><a href="">Видео</a></li>
                <li><a href="/contacts">Контакты</a></li>
            </ul>
        </nav>
    </div>
</header>