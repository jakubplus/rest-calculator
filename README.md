Calculator REST Api
=============

This simple REST application allows calculating simple numbers.

Setup
-----
1. Clone the repository and enter the app directory
2. Run ``composer install``
3. Run ``php bin/console lexik:jwt:generate-keypair``

Running
-------
1. Run ``symfony server:start -d``

Register user for authentication
--------------------------------
You need to authenticate a newly created user. With ``login_check`` method call for JWT token.

1. Run ``POST: http://127.0.0.1:44907/api/register`` with:

```json
{
  "email": "email@example.com",
  "password": "password"
}
```
Response:
```json
{
  "message": "User has been registered!"
}
```

2. Run ``POST: http://127.0.0.1:8000/api/login_check``

```json
{
  "username": "email@example.com",
  "password": "password"
}
```
Response:
```json
{
  "token": "token for rest api use"
}
```

3. You are ready to use the app!

Calculator Tool
---------------

Each request requires 2 values as a json object to return a json result. The Authorization header has to contain Bearer token received earlier.

**Examples**

a) Addition 

``POST: http://127.0.0.1:8000/api/add``
```json
{
  "arg1": 2,
  "arg2": 2
}
```
Response:
```json
{
  "result": 4
}
```

b) Subtraction 

``POST: http://127.0.0.1:8000/api/subtract``
```json
{
  "arg1": 2,
  "arg2": 2
}
```
Response:
```json
{
  "result": 0
}
```

c) Multiplication 

``POST: http://127.0.0.1:8000/api/multiply``
```json
{
  "arg1": 2,
  "arg2": 2
}
```
Response:
```json
{
  "result": 4
}
```

d) Division 

``POST: http://127.0.0.1:8000/api/divide``
```json
{
  "arg1": 2,
  "arg2": 2
}
```
Response:
```json
{
  "result": 1
}
```