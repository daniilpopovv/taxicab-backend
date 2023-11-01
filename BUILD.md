```shell
docker build . -f ./Dockerfile --target composer -t taxicab_composer
```

```shell
docker run --name taxicab_composer --rm --volume .:/app --workdir="/app" taxicab_composer composer install -n --no-progress --no-plugins --no-scripts --no-suggest
```

```shell
docker-compose -f ./docker-compose.dev.yaml up --build
```
