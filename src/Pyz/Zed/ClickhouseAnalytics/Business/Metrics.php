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
        $onlineUsers = "select count(*) from Event where timestamp > now() - interval $intervalMinutes minute group by user_id;"; // online users
        $events = "select count(*) from Event where timestamp > now() - interval $intervalMinutes minute;";

        return [
            'onlineUsers' => $this->client->select($onlineUsers)->rows(),
            'events' => $this->client->select($events)->rows(),
        ];
    }

    public function getEventsByInterval(int $hours = 24): array
    {
        $query = "select count(*) as count, toStartOfHour(timestamp) as hour from Event where timestamp > now() - interval $hours hour group by hour order by hour;";
        $result = $this->client->select($query);

        $eventsPerInterval = [];
        foreach ($result->rows() as $row) {
            $eventsPerInterval[$row['hour']] = $row['count'];
        }

        return $eventsPerInterval;
    }
}
