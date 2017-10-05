var app   = require('express')();
var http  = require('http').Server(app);
var io    = require('socket.io')(6001);
var Redis = require('ioredis');
var redis = Redis();

io.on('connection', function (socket) {
    // console.log('io connected on : 6001');
});

redis.psubscribe('quiz', function (error, count) {
    // console.log('redis subscribed on : quiz')
});

http.listen(6001, function() {
    // console.log('listening on 6001')
});

redis.on('pmessage', function(subscribed, channel, message) {
    message = JSON.parse(message);
    io.send(message);
    // console.log('\n' + message.event);
});
