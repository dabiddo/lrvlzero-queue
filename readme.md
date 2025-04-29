# Laravel Zero as a Queue Manager

This project demonstrates how [Laravel Zero](https://laravel-zero.com/) can be used as a lightweight queue manager, instead of running multiple instances of a full Laravel application. The idea is to deploy micro-instances of Laravel Zero to process queued jobs and shut them down when finished, improving resource efficiency.

## Folders

- **webapp**: A full Laravel 12 application containing a basic `Event` model, migration, and the main job creator.
- **worker**: A Laravel Zero instance that imports the `Event` model and job class from the webapp.

## The Good

- It works! Laravel Zero successfully picks up and processes queue jobs created by the Laravel webapp.

## The Bad

- Currently, the job class and model code are duplicated between the Laravel app and Laravel Zero. In a real-world application, this is not ideal and can lead to maintenance issues.


# How to Run

## Prerequisites

- Docker
- VSCode + Devcontainer extensions

## Run

I followed this guide for the folder structure and to share the same DB between projects. Once you have the Docker images built, VSCode will run all services and you can connect to them.

## Commands

In the **worker** project, open the terminal and run:

```bash
php worker queue:listen
```

This will activate the queue manager.
Then, use the normal POST `http://localhost/events` endpoint to generate a new Event, which will trigger the queue job for Laravel Zero.