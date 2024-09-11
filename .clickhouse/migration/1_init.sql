CREATE TABLE IF NOT EXISTS Event
(
    name String,
    timestamp DateTime('UTC'),
    user_id String,
    value Double,
    content String
)
ENGINE=AggregatingMergeTree
PARTITION BY toYYYYMM(timestamp)
ORDER BY (user_id)
SETTINGS index_granularity = 8192;
