Request

v1/auth, POST

with email/password

````json
{
    "password": "string",
    "email": "email|string"
}
````

with Google

````json
{
    "token": "string"
}
````

Response

````json
{
    "data": {
        "user": "User Object*",
        "token": "string"
    }
}
````

* [User Object](https://github.com/chirukinbb/evelts.local/blob/master/docs/objects/user.md)
