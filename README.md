# rabbitmq
Playground to test RabbitMQ

# Requirements

1) Install RabbitMQ server
2) Create a config.json file based on the config.json.dist file

# References:
https://www.rabbitmq.com/tutorials/tutorial-one-php.html
https://www.rabbitmq.com/tutorials/tutorial-two-php.html

# Playing

1) start as many consumers you want (locally). For example:

php receive.php (in a terminal window #1)
php receive.php (in a terminal window #2)
php receive.php (in a terminal window #3)

2) Run

sh send_multiple_unique.sh

It will send messages but avoiding repeated messages to be reprocessed while a previous one was not marked as acknowledge.