var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http, {
    cors: {
        origin: '*',
    }
});
var Redis = require('ioredis');
var redis = new Redis();
redis.subscribe('laravel_database_common-connection', function(err, count) {
    console.log(err);
    console.log(count);
});

redis.on('message', function(channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    if((message.data.event.type === 'like') || (message.data.event.type === 'follow'))
    {
        io.emit(channel + "/" + message.data.event.toUserId, message.data);
    }
});

http.listen(3000, function(){
    console.log('Listening on Port 3000');
});
