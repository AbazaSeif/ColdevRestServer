# ColdevRestServer
Game leaderboards, Player Login, currency, catalogs  and player data storage. REST API server in PHP 7



<img src="https://preview.ibb.co/hdf4vc/LOGO_CRS.jpg" alt="Super Score" />

### Main

Game leaderboards, Player Login, Game and Player Catalog, in-game currency, and player data storage.

Written by Colombian Developers.

### Features

* Unlimited score leaderboards with powerfull querying.
* Any Catalogs for Player and Game
* In-game currency transaction logging with secure hash system.
* Storage of miscellaneous User data.
* Tiny codebase which can be easily added to and security audited.
* Test suite.
* Post and Get methods supported

### Requirements

* PHP 7+ or 5.6+.


### Optional

* Local server as Wamp or Xamp for Testing

### Installation Notes

1. Copy all files in www server directory, 
   extract file "db   directory.rar" in db directory and overwrite directory content. 

2. Zero server setup (Sqlite) portable code.

2. Set up your database connection,  updating setup.php. all code 100% PDO php code.(Use MYSQL , Postgresql, etc)

3. All REST code in a simple server.php code, very server friendly.

### REST API Usage

**Any error will contain the following JSON response.**

`{ "rest" : "Reason for failure." }`

**Create APP**

Create a unique ID app .

| Endpoint | ("http://localhost/server.php?pp=1000&appid=XXXXQWQW&pass=123&email=info@swdsd.com") | 
| --- | --- |
| Input | None |
| Output | `{"rest":1}` OK  {"rest": 0} Error   {"rest":-1} Already exists |
| File | `server.php` |

**CREATE PLAYER **

Create a unique player.

| Endpoint | ("http://localhost/server.php?pp=4000&appid=XXXXQWQW&apppass=123&user=LAURA&userpass=1234&email=KJK@jhas.com") | 
| --- | --- |
| Input | None |
| Output | `{"rest":1}` OK  {"rest": 0} Error   {"rest":-1} Already exists |
| File | `server.php` |
 

**LIST PLAYERS **

List all player.

| Endpoint | ("http://localhost/server.php?pp=4100&appid=XXXXQWQW&apppass=123") | 
| --- | --- |
| Input | None |
| Output | `{"rest":1}` OK  {"rest": 0} Error    |
| File | `server.php` |


**SET PLAYER CATALOG **

set player catalog.

| Endpoint | ("http://localhost/server.php?pp=4300&appid=XXXXQWQW&apppass=123&user=LAURA&userpass=1234&cat_code=BVBAVVBAS5&data=POPSJK34345") | 
| --- | --- |
| Input | None |
| Output | `{"rest":1}` OK  {"rest": 0} Error    |
| File | `server.php` |



**GET PLAYER CATALOG **

get player catalog.

| Endpoint | ("http://localhost/server.php?pp=4400&appid=XXXXQWQW&apppass=123&user=LAURA&userpass=1234&cat_code=BVBAVVBAS5") | 
| --- | --- |
| Input | None |
| Output | `{"rest":1,"list":[{"data":"POPSJK34345"}]}` OK  {"rest": 0} Error    |
| File | `server.php` |



** PLAYER LOGIN **

 player login.

| Endpoint | ("http://localhost/server.php?pp=4200&appid=XXXXQWQW&apppass=123&user=LAURA&userpass=1234") | 
| --- | --- |
| Input | None |
| Output | `{"rest":1}` OK  {"rest": 0} Error    |
| File | `server.php` |




** SET GAME CATALOG  **

 Set game catalog.

| Endpoint | ("http://localhost/server.php?pp=3000&appid=XXXXQWQW&apppass=123&cat_code=ASASASEWRE34&data=23423DSFSDF") | 
| --- | --- |
| Input | None |
| Output | `{"rest":1}` OK  {"rest": 0} Error    |
| File | `server.php` |



** GET GAME CATALOG  **

 Get game catalog.

| Endpoint | ("http://localhost/server.php?pp=3000&appid=XXXXQWQW&apppass=123&cat_code=ASASASEWRE34") | 
| --- | --- |
| Input | None |
| Output | `{"rest":1,"list":[{"data":"23423DSFSDF"}]}` OK  {"rest": 0} Error    |
| File | `server.php` |





** SET SCORE BOARDS **

 Set score boards.

| Endpoint | ("http://localhost/server.php?pp=2000&appid=XXXXQWQW&apppass=123&user=LAURA&userpass=1234&boardcode=highscore10&score=20000") | 
| --- | --- |
| Input | None |
| Output | `{"rest":1}` OK  {"rest": 0} Error    |
| File | `server.php` |



** GET SCORE BOARDS **

 Get score boards.

| Endpoint | ("http://localhost/server.php?pp=2100&appid=XXXXQWQW&apppass=123&boardcode=highscore10&date1=2018-01-01&date2=2018-06-01&count=10") | 
| --- | --- |
| Input | None |
| Output | `{"rest":1,"list":[{"user":"LAURA","score":"20000.0","scoredate":"2018-05-04 02:00:00"}]}` OK  {"rest": 0} Error    |
| File | `server.php` |




### License

This project is licensed under the MIT License. This means you can use and modify it for free in private or commercial projects.
