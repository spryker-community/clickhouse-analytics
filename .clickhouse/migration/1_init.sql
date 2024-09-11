SET allow_experimental_json_type = 1;
CREATE TABLE IF NOT EXISTS Event
(
    id UInt64,
    name String,
    timestamp DateTime('UTC'),
    user_id String,
    value Double,
    content JSON,
)
ENGINE=MergeTree
ORDER BY (user_id)
SETTINGS index_granularity = 8192;
