const http = require('http');

http.createServer(async function (req, res) {

    res.writeHead(200, {'Content-Type': 'application/json'});
    res.end(JSON.stringify({message: 'Hello World'}));

}).listen(5000);

console.log('Server running at port 5000');
