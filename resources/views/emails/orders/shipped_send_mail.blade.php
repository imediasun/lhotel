<html>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div style="font-size: 20px;" class="panel-heading">Вам пришел вопрос</div>

                    Здравствуйте, меня зовут _<?php echo $post['name'];?>_, я хочу задать вопрос.
                    Со мной можно связаться по эл. почте <?php echo $post['email']?>.
                    Вопрос :
                    <?php echo $post['message']?>_

                    <div class="panel-body">

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>