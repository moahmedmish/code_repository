# Code Repositories.

>* A list of the most popular repositories, sorted by number of stars.
>* An option to be able to view the top 10, 50, 100 repositories should be available.
>* Given a date, the most popular repositories created from this date onwards should be returned.
>* A filter for the programming language would be a great addition to have.

# Installation
## Run With Docker

```
docker.compose build
docker-compose up -d
```


List all of the running containers:
```
 docker ps
```
## Run by composer

Open the terminal command line and go inside the hotel folder, and launch this commands:
```
composer install
```


Access the api through [localhost]( http://127.0.0.1:8000/}api/repositories/github?created_at=2020-01-10&order=desc&language=JavaScript&limit=5)

# Run unit test
./vendor/bin/phpunit

# Tools
* PHP7.3
* Laravel
* Docker
* phpunit
* mysql 8


### Note
>Use factory design pattern because if we add new code repository and want get data from it 
