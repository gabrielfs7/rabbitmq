#!/bin/bash
#
# The first parameter representes an unique subject message for the queue,
# so if is there the same subject pending. It wont be sent again
#
# Se second parameter represents the message. In this case is the time in seconds to simulate an delay
#
# As soon the message was processed It will disocupy the queue and allow a similar message to be sent
#
php send.php A 2
php send.php A 1

php send.php B 2
php send.php B 1

php send.php C 2
php send.php C 1

php send.php D 2
php send.php D 1

php send.php A 5
php send.php A 4
php send.php A 3

php send.php B 5
php send.php B 4
php send.php B 3

php send.php C 5
php send.php C 4
php send.php C 3

php send.php D 5
php send.php D 4
php send.php D 3

php send.php A 8
php send.php A 7
php send.php A 6

php send.php B 8
php send.php B 7
php send.php B 6

php send.php C 8
php send.php C 7
php send.php C 6

php send.php D 8
php send.php D 7
php send.php D 6