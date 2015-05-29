<?php
//000000000000s:240:"SELECT COUNT(*) AS tp_count FROM ys_message_sender Message_sender  JOIN ys_message_receiver Message_receiver ON Message_sender.mid=Message_receiver.mid WHERE ( Message_receiver.to_uid = '33' ) OR ( Message_sender.from_uid = '33' ) LIMIT 1  ";
?>