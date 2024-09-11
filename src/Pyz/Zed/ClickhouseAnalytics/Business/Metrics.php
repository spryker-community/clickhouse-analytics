<?php

namespace Pyz\Zed\ClickhouseAnalytics\Business;

use ClickHouseDB\Client;

class Metrics
{
    public function __construct(private Client $client)
    {
    }

    public function getAllUserJourneys(int $interval): array
    {
        $query = "select * from Event where timestamp > now() - interval $interval minute order by timestamp;";
        $result = $this->client->select($query);

        $userJourneys = [];
        foreach ($result->rows() as $row) {
            $userJourneys[$row['user_id']][] = $row;
        }

        return $userJourneys;
    }

    public function getMetrics(int $intervalMinutes = 60): array
    {
        $onlineUsers = 'select count(*) from Event where timestamp > now() - interval 10 minute group by user_id;'; // online users
        $totalUsers = "select count(*) from Event where timestamp > now() - interval $intervalMinutes minute;";

        $result = $this->client->select($onlineUsers);
        return $result->rows();
    }
}
