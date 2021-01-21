<!DOCTYPE html>
<html>
<head>
    <title>mailchat</title>
    <meta charset="'utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/css.css">
</head>
<body>
    <header class="d-none-700">
        <div class="container">
            <div class="user-icone">
                <img src="img/private.svg" alt="">
            </div>
        </div>
    </header>
    <section class="d-none-700">
        <div class="container">
            <div class="chats">
                <h3>Чаты</h3>

                <?php
                $link = "https://api.mailchat.net/test/chat.get";

                $ch = curl_init($link);

                curl_setopt($ch, CURLOPT_URL, $link);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_NOBODY, false);
                $response = curl_exec($ch);
                $err = curl_error($ch);

                curl_close($ch);

                if($response){
                    $data = json_decode($response);
//                    var_dump($data);
                    foreach($data as $row){
                        foreach($row->subjects as $item){
    //                        var_dump($item);
    ?>
                            <div class="user-chats-block" data-id="<?php echo $item->id ?>">
                                <div class="title-block">
                                    <h2><?php echo (strlen($item->title)>45)? substr($item->title,0,45).'...':$item->title; ?> </h2>
                                    <span class="time"><?php echo date('h:m',$item->message_date)?></span>
                                </div>
                                <div class="content-block">
                                    <p>
                                        <img src="img/ok.svg" alt="" style="<?php echo($item->message_read)?'':'filter: invert(32%) sepia(60%) saturate(6858%) hue-rotate(209deg) brightness(104%) contrast(103%);'?>">
                                        <?php echo (strlen($item->message_content)>100)? substr($item->message_content,0,100).'...':$item->message_content;  ?>
                                    </p>
                                </div>
                            </div>
                    <?php

                        }
                    }
                }
                ?>
<!--                <div class="user-chats-block">-->
<!--                    <div class="title-block">-->
<!--                        <h2>Первый чат и это очень кр...</h2>-->
<!--                        <span class="time">09:45</span>-->
<!--                    </div>-->
<!--                    <div class="content-block">-->
<!--                        <p>-->
<!--                            <img src="img/ok.svg" alt="">-->
<!--                            Мой первый текст в этом чате и я очень-->
<!--                            доволен что он у меня получился и теперь люд...-->
<!--                        </p>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="user-chats-block">-->
<!--                    <div class="title-block">-->
<!--                        <h2>Первый чат и это очень кр...</h2>-->
<!--                        <span class="time">09:45</span>-->
<!--                    </div>-->
<!--                    <div class="content-block">-->
<!--                        <p>-->
<!--                            <img src="img/ok.svg" alt="">-->
<!--                            Мой первый текст в этом чате и я очень-->
<!--                            доволен что он у меня получился и теперь люд...-->
<!--                        </p>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="user-chats-block">-->
<!--                    <div class="title-block">-->
<!--                        <h2>Первый чат и это очень кр...</h2>-->
<!--                        <span class="time">09:45</span>-->
<!--                    </div>-->
<!--                    <div class="content-block">-->
<!--                        <p>-->
<!--                            <img src="img/ok.svg" alt="">-->
<!--                            Мой первый текст в этом чате и я очень-->
<!--                            доволен что он у меня получился и теперь люд...-->
<!--                        </p>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
            <div class="content-chat">
                <div class="content">
                    <?php
                    $link = "https://api.mailchat.net/test/message.get?id=".$data->response->subjects[0]->id;

                    $ch = curl_init($link);

                    curl_setopt($ch, CURLOPT_URL, $link);
                    curl_setopt($ch, CURLOPT_HEADER, false);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_NOBODY, false);
                    $response1 = curl_exec($ch);
                    $err = curl_error($ch);

                    curl_close($ch);
                    if($response1){
                        $data1 = json_decode($response1);
                        $date=time();
                        foreach($data1 as $row){
                            foreach ($row as $cont){
                                foreach ($cont as $item){
//                                    var_dump($item);
                                    if (date('Ymd',$date)>date('Ymd',$item->date))
                                        echo '<div class="date"><span>'.date('j F',$item->date).'</span></div>';
                                    $date=$item->date;
                                    ?>
                    <?php if(!$item->you){
                        ?>
                    <div class="user1">
                        <div>
                            <h5><?php echo $data->response->subjects[0]->title ?></h5>
                            <div>
                                <p><?php echo $item->content ?><span class="message-date"><?php echo date('h:m',$item->date)?></span></p>
                            </div>
                        </div>
                    </div>
                    <?php
                    }else{
                    ?>
                    <div class="user2">
                        <div>
                            <div>
                                <p><?php echo $item->content ?></p><span class="message-date"><?php echo date('h:m',$item->date)?></span>
                            </div>
                        </div>
                    </div>

                                    <?php
                                }
                                }
                            }
                        }
                    }
                    ?>
                </div>
                <div class="message-send-block">
                    <div class="textarea-block" contenteditable></div>
<!--                    <div class="send"></div>-->
                    <img src="img/send.svg" alt="" class="send">
                </div>
            </div>
        </div>
    </section>
    <section class="d-block-700">
        <div>
            <h3>
                Простите но для
                мобильных телефонов
                у нас есть мобильное
                приложение
            </h3>
        </div>
    </section>
</body>
</html>
