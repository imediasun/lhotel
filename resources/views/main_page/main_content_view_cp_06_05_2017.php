


<div class="box-slider">
    <h1 style="" class="caption">L-hotel — <br>семейный отель с 2000 года</h1>
    <div class="items">
        <ul>
            <!-- item -->
            <li class="item active" data-slide="">
                <div class="img">
                    <i class="photo"  style="background-image:url(/img/slide_home.jpg)"></i>
                    <!--<i class="photo" class="parallax-window" data-parallax="scroll" data-image-src="img/Main.jpg"></i>-->
                </div>
            </li>
            <!-- item -->

            <!--<li class="item" data-slide="">-->
            <!--<div class="img">-->
            <!--<i class="photo" class="parallax-window" data-parallax="scroll" data-image-src="img/slide_home.jpg"></i>-->
            <!--</div>-->
            <!--</li>-->

        </ul>

    </div>
</div>
<div class="box-events">
    <h2 class="title">яркие события на любой случай</h2>
    <div class="description">LUCIA Banquet Hall — любимое многими место со своей историей и уникальным подходом к каждому
        <br class="hidden-sm">клиенту</div>
    <div class="content">
        <div class="event-slider clearfix">
            <div class="col-6">
                <div class="images">
                <?php
                $i=1;
                foreach($rooms as $room){
                 ?>
                 <!-- item -->
                 <div id="item-<?php echo $i;?>" class="item active"><img data-src-xs="/photos/<?php echo $room['original']['image_large']?>" src="/photos/<?php echo $room['original']['image_medium']?>" alt=""></div>
                 <!-- item -->
                    
                 <?    
                  $i++;
                }
                
                ?>

                
                
                
                </div>
                <div class="images-nav">
                    <div class="prev"><img class="show-hover" src="/img/arrow_next_light.svg" alt=""><img src="/img/arrow_prev_gold.svg" alt=""></div>

                    <div class="current">1</div>
                    <span>/</span>
                    <div class="all">9</div>

                    <div class="next"><img class="show-hover" src="/img/arrow_next_light.svg" alt=""><img src="/img/arrow_prev_gold.svg" alt=""></div>

                </div>
            </div>

            <div class="col-6">
                <div class="events-nav">
                    <ul>

                    <?php
                    $i=1;
                    foreach ($rooms as $room){

                    ?>
                        <li>
                            <a href="#item-<?php echo $i;?>" class="item-8">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="13.761mm" height="13.458mm" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                         viewBox="0 0 1376 1346"
                                         xmlns:xlink="http://www.w3.org/1999/xlink">
                                     <defs>
                                         <style type="text/css">
                                             <![CDATA[
                                        .fil0 {fill:#BC8C4A;fill-rule:nonzero}
                                             ]]>
                                         </style>
                                     </defs>
                                        <g id="Слой_x0020_1">
                                            <metadata id="CorelCorpID_0Corel-Layer"/>
                                            <path class="fil0" d="M221 178l65 0 20 0 104 0c3,-47 24,-90 56,-122l0 0 0 0c34,-35 82,-56 135,-56l174 0c53,0 101,21 135,56l0 0c32,32 53,75 56,122l104 0 20 0 65 0c61,0 116,25 156,65l0 0c40,40 65,95 65,156l0 725c0,61 -25,117 -65,157l0 0c-40,40 -95,65 -156,65l-65 0 -20 0 -764 0 -20 0 -65 0c-60,0 -116,-25 -156,-65l0 0c-40,-40 -65,-96 -65,-157l0 -725c0,-61 25,-116 65,-156l0 0c40,-40 96,-65 156,-65zm869 40l0 1088 65 0c50,0 95,-21 128,-53 33,-33 53,-79 53,-129l0 -725c0,-50 -20,-95 -53,-128 -33,-33 -78,-53 -128,-53l-65 0zm-804 1088l0 -1088 -65 0c-49,0 -95,20 -128,53l0 0c-33,33 -53,78 -53,128l0 725c0,50 20,96 53,129l0 0c33,32 79,53 128,53l65 0zm40 -1088l0 1088 724 0 0 -1088 -83 0 -20 0 -517 0 -20 0 -84 0zm124 -40l476 0c-3,-36 -19,-69 -44,-94l0 0c-27,-27 -65,-44 -107,-44l-174 0c-42,0 -80,17 -107,44l0 0c-25,25 -41,58 -44,94z"/>
                                        </g>
                                    </svg>
                                </div>

                                <h3><?php echo $room['original']['name']?></h3>
                                <div class="text"><?php echo $room['original']['slogan'];?>
                                </div>
                            </a>
                        </li>


                    <?php
                    $i++;
                    }
                    ?>


                    </ul>
                </div>
            </div>

        </div>
        <!-- event-slider -->
    </div>
    <!-- content -->
</div>
<!-- box-events -->
<div class="box-interiors">
    <h2>Наш парк</h2>
    <div class="description">К вашим услугам в Lhotel  большая территория для того чтобы скрыться от суеты больших городов
        и наслаждаться благоуханием множества цветов и деревьев, проводя время у пруда с журчащим ручьем у мостика
        на скамеечке общаясь в тиши со своими близкими или к примеру можно прочитать книгу.
    </div>


    <div class="container">

        <div id="interior-slider" class="anim-to">

            <div class="numbers">
                <span class="current">1</span>
                <span class="total">8</span>
            </div>

            <div class="slides">


                <div class="room slick-show-button room-0" data-index="1">
                    <div class="stripe"></div>
                    <div class="stripe right"></div>
                    <div class="text">
                        <h3 class="title title--bigger">Гостиный</h3>
                        <div class="content">
                            <p>Открыв двери в LUCIA Banquet Hall, Вы сразу попадаете в гостеприимный холл, где сможете
                                комфортно расположиться в ожидании яркого торжества или успеть пообщаться со своими коллегами
                                перед началом делового мероприятия.
                            </p>
                            <a href="" class="btn-default ujarak"><span>Подробнее</span></a>
                        </div>

                    </div>
                    <a class="filter" href="">
                        <img src="/img/gostinny.jpg" alt="">
                    </a>
                </div>


                <div class="room room-1" data-index="2">
                    <div class="stripe "></div>
                    <div class="stripe right"></div>
                    <div class="text">
                        <h3 class="title title--bigger">Банкетный</h3>
                        <div class="content">
                            <p>LUCIA Banquet Hall —  элегантное и изысканное заведение. Ряд функциональных преимуществ делают его одним из лучших мест для проведения банкетов в Днепре.</p>
                            <a href="" class="btn-default ujarak"><span>Подробнее</span></a>
                        </div>

                    </div>
                    <a href="" class="filter">
                        <img src="/img/interior_1.jpg" alt="">
                    </a>
                </div>


                <div class="room room-2" data-index="3">
                    <div class="stripe "></div>
                    <div class="stripe right"></div>
                    <div class="text">
                        <h3 class="title title--bigger">лаунж</h3>
                        <div class="content">
                            <p>Лаунж холл может быть использован и как самостоятельная площадка для проведения мероприятий.
                                Этот холл мы рекомендуем клиентам, чья цель — провести на высоком уровне день рождения,
                                небольшой корпоративный праздник, презентацию или обучение.
                            </p>
                            <a href="" class="btn-default ujarak"><span>Подробнее</span></a>
                        </div>

                    </div>
                    <a href="" class="filter">
                        <img src="/img/lounge.jpg" alt="">
                    </a>
                </div>



            </div>


            <a class="button-round button-round--compose button-round--dark arrow-left" href="javascript:;" data-stroke-color="#44504c"><img src="/img/slide_prev_circle.svg" alt=""></a>
            <a class="button-round button-round--compose button-round--dark arrow-right" href="javascript:;" data-stroke-color="#44504c"><img src="/img/slide_next_circle.svg" alt=""></a>
        </div>
        <!-- Slider -->

    </div>




</div>
<div class="box-lucia">
    <h2>Люс<span class="supper">и</span>я (Lucia)</h2>

    <div class="description">Она хотела быть лучшей во всём, начиная от сервиса, заканчивая кухней. Она всегда любила
        своих гостей, и её гости платили ей тем же. И теперь эти традиции продолжает её семья,
        в частности её дочь — это я Элеонора
    </div>
    <!--description-->

    <div class="content">

        <div class="container">
            <h2>Людмила Заворотняя</h2>
            <div class="hint">(Люс<span class="supper">и</span>я)</div>

            <ul>
                <li>Она – эксцентрична.</li>
                <li>Она – экстравагантна.</li>
                <li>Она – полна любви.</li>
                <li>Её душа поёт. Её зовут Люс<span class="supper">и</span>я (Людмила Заворотняя).</li>
            </ul>
        </div>

    </div>
    <!--content-->

</div>
<!--box-lucia-->
<div class="box-subscribe">
    <form action="#">
        <div class="container">

            <h3 class="title">Подписка на <br class="visible-sm">новости</h3>

            <div class="input-holder">
                <input type="text" value="" placeholder="Ваша эл. почта">
            </div>

            <div class="submit-holder">
                <button type="submit" class="btn-default ujarak"><span>подписаться</span></button>
            </div>


        </div>
    </form>
</div>
