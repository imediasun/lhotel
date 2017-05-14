<html>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div style="font-size: 20px;" class="panel-heading">Вам пришла заявка</div>

                    Здравствуйте, меня зовут _<?php echo $post['name'];?>_, я планирую отдохнуть в вашей гостинице , дата прибытия _<?php echo $post['date'];?>_ ,
                    _в <?php echo $post['time']?>_ необходим номер на _<?php echo $post['count_of_person']?>_персон.
                    Со мной можно связаться по эл. почте <?php echo $post['email']?>, или позвонив по телефону <?php echo $post['phone']?>.
                    Дополнительная информация
                    <?php echo $post['additional_info']?>_

                    <div class="panel-body">

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>