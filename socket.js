var server = require('http').Server();

var io = require('socket.io')(server);

var Redis = require('ioredis');
var redis = new Redis();

redis.subscribe('project-channel');

redis.on('message', function(channel, message){
    console.log(channel, message);
});

server.listen(3000);
