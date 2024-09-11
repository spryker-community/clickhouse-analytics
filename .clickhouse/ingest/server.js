const {createServer} = require('node:http');
const { ClickHouse } = require('clickhouse');

const clickhouse = new ClickHouse({
    url: `http://${process.env.CLICKHOUSE_HOST}`,
    port: process.env.CLICKHOUSE_CLICKHOUSE_HTTP_PORT,
    basicAuth: {
        username: process.env.CLICKHOUSE_USER,
        password: process.env.CLICKHOUSE_PASSWORD
    },
    config: {
        database: process.env.CLICKHOUSE_DB,
    }
});

const server = createServer(async (req, res) => {
    res.statusCode = 200;
    res.setHeader('Content-Type', 'text/plain');

    let messages = '';
    try {
        const body = await parseBody(req);
        await clickhouse.insert('INSERT INTO Event(name, user_id, value, content, timestamp)', [
            {
                name: body.name,
                user_id: body.user_id,
                value: body.value,
                referer: req.headers.referer,
                content: body.content,
                timestamp: (new Date()).toISOString().replace('T', ' ').slice(0, 19),
            }
        ]).toPromise();
    } catch(error) {
        messages = error.message;
        res.statusCode = 400;
    }

    res.end(messages);
});

// Helper function to parse the request body
const parseBody = (req) => {
    return new Promise((resolve, reject) => {
        let body = '';
        req.on('data', chunk => {
            body += chunk.toString();
        });
        req.on('end', () => {
            try {
                resolve(JSON.parse(body));
            } catch (error) {
                reject(new Error('Invalid JSON'));
            }
        });
        req.on('error', (error) => {
            reject(error);
        });
    });
};

server.listen(8888, '0.0.0.0', () => {
});
