# Case Study: 3D printing

A case study to demonstrate knowledge about Symfony4 and PHP. The following user story needed to be implemented:

*"As a customer I want to upload, view, update and delete a 3D print including print details. A customer can only add, modify and delete his/her prints."*

**Case study details**
> Your code will be reviewed with the following requirements in mind:
>
- Use the Symfony framework
- Write project documentation
- Write automated tests 
- Write code that is DRY
- Write self documenting code
- Write code that using a coding standard
- Write code that is secure

> Definitely a plus:
>
- Provide it in a docker container

## Context
The case study didn't had a real context aside 3D printing so I had to made up my own. 

The app is about a 3D printing design sharing platform. Users can upload their 3D print design so that other users can use these in their own projects.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine.

### Prerequisites

```
Git 2.18
Docker v18.06
Docker-Compose v1.22
```

### Installing

Follow the steps to setup and run the case study on your local machine.

**Step 1** Clone the project through Git onto your machine

```
$ git clone git@github.com:sven-achilles/case-3d-printing.git <destination folder>
```

**Step 2** Create the Docker .env file and fillin the details.

```
$ cd docker
$ cp .env.example .env
$ vi .env
```

**Step 4** Build project with Docker Compose

```
$ cd docker
$ docker-compose up -d
```

**Step 5** Install project dependencies through Composer

```
$ docker exec -it case-fpm.local bash
$ root@500c522e5454:/var/www# composer install
$ exit
```

**Step 6** Configure Doctrine

```
$ cd www
$ vi .env
```

Change the following line:

```
DATABASE_URL=mysql://<db user>:<db password>@127.0.0.1:3306/<db name>
```

**Step 7** Migrate and seed the database

```
$ docker exec -it case-fpm.local bash
$ root@500c522e5454:/var/www# php bin/console doctrine:migration:migrate
$ root@500c522e5454:/var/www# php bin/console doctrine:fixtures:load
$ exit
```

**Step 8** Navigate to ```http://localhost:8585``` to use the app.

## Built With

* [Symfony4](https://symfony.com/) - The web framework used
* [Composer](https://getcomposer.org/) - PHP dependency Management
* [Docker](https://www.docker.com/) - Container management


## Authors

* **Sven van Zoelen** - [LinkedIn profile](https://www.linkedin.com/in/svenvanzoelen/)
