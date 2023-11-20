const http = require('http');
const fs = require('fs/promises');

http.createServer(async function (req, res) {

    let data = await fs.readFile('/data/data.txt');
    data = data + "\nHurray!";
    await fs.writeFile('/data/data.txt', data);

    res.writeHead(200, {'Content-Type': 'text/plain'});
    res.end(data);

}).listen(5000);

console.log('Server running at http://localhost:5000/');
