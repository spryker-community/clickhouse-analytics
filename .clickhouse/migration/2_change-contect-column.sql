SET allow_experimental_json_type = 1;
ALTER  TABLE analytics.Event MODIFY COLUMN content String;
