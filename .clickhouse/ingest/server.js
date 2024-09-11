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

    let messages = "start \n";
    try {
        const response = await clickhouse.insert('INSERT INTO Event(name, user_id, value, content, timestamp) VALUES', [
            'page_view',
            '1',
            0,
            '{"name": "Product Detail Page"}',
            '2024-09-11T13:48:08Z',
        ]).toPromise();

        messages += JSON.stringify(response) + "\n";
    } catch(error) {
        messages += error.message;
    }

    messages += " end";
    res.end(messages);
});
server.listen(8888, '0.0.0.0', () => {
});
