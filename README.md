# URL Shortner with Laravel

In this project we will try to achieve the requested functionality in the PDF file provided as a task.

## Functionalities to Achieve

- User seeders (no login/signup needed so we try to make users manually)
- Users have profile, which there they can add their desired links
- The entered url should be formatted and made short by the desired logic
- The logic goes like this:

1. The user enters a url
2. What gets returned to the user as result is, `host-address/unique-four-to-five-char-string` 
3. This shortened url is mapped to the main link which the user provided in the profile
4. Times which the short form url is clicked should be also accessible
5. Redis should be used as the persistence approach for the urls and clicks

## Routes

- Create URL and receive the short form
- Read most clicked urls in descending order (with `take` url param)
- Get all created urls by user with all the related info to each one
- Search links by value

## Commands

```bash
# adding predis library to achieve redis functionality
composer require predis/predis:^2.0

# getting redis up and running using docker
docker compose up -d

# stopping the redis container from running
docker compose down
```
