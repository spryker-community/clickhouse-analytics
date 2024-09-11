# Hackathon Project

## Short Project Description:
Use an own Clickhouse instance to to track customer actions in a GDPR friendly way and visualize it in the Zed Backend.

## General information:
- Clickhouse server is included via `deploy.dev.yml` with an extra docker-compose file
  - All configs are located in the `.clickhouse` subdirectory and the `deploy.dev.yml`
- There is a small node-server (also included via docker-compose) which acts as an endpoint for data-colelction
  - Logic is found in `.clickhouse/ingest`
- during boot, build, and up everything is setup automatically and the migrations found in `.clickhouse/migrations` are applied
  - Clickhouse migration can be run manually via `npm run clickhouse:migrate`

## Setup:
1. clone the repository in your local
   ```php
   git clone git@github.com:spryker-community/clickhouse-analytics.git
   ```
2. clone docker sdk
    ```php
     git clone https://github.com/spryker/docker-sdk.git --single-branch docker
    ```
3. bootstrap the project
    ```php
    docker/sdk bootstrap deploy.dev.yml
    ```
4. start the project
    ```php
    docker/sdk up
    ```
   clickhouse-migration is done automatically during the boot process in `init-storages-per-region` section but can manually run via `npm run clickhouse:migrate`

### Capabilities:
- Track customer interactions in Yves
- Store the data in Clickhouse
- Visualize the data in Zed

