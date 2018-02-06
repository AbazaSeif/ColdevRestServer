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

`{ "Error" : "Reason for failure." }`

**Current Time**

Retrieve the current unix timestamp on this server.

| Endpoint | http://{hostname}/timestamp | 
| --- | --- |
| Input | None |
| Output | `{ "Timestamp" : <int> }` |
| File | `src/Controller/Timestamp.php` |

**Leaderboard Score Recording**

Accepts and records scores posted for a User and calculates their current rank in the specified Leaderboard. Returns the User and Leaderboard passed in with the Users highest score for the given Leaderboard.

| Endpoint | http://{hostname}/score/save | 
| --- | --- |
| Input | `{ "UserId" : <int>, "LeaderboardId" : <int>, "Score" : <int> }` |
| Output | `{ "UserId" : <int>, "LeaderboardId" : <int>, "Score" : <int>, "Rank" : <int> }` |
| File | `src/Controller/Score.php` |

**Leaderboard Score Query**

Returns a range of entries from the specified Leaderboard in order of rank, along with the score and rank of the specified User. Higher score is better, ranks start at 1.

| Endpoint | http://{hostname}/score/load | 
| --- | --- |
| Input | `{ "UserId" : <int>, "LeaderboardId" : <int>, "Offset" : <int>, "Limit" : <int>}` |
| Output | `{ "UserId" : <int>, "LeaderboardId" : <int>, "Score" : <int>, "Rank" : <int>, "Entries" : [ {"UserID" : <int>, "Score" : <int>, "Rank" : <int>}, ... ] }` |
| File | `src/Controller/Score.php` |

**Game Currency Transaction Recording**

Record simple user transactions involving game currency with hash verification. Duplicate transactions will respond with an error.

The Verifier parameter is a SHA-1 hash of the following values concatenated together:
`SecretKey+TransactionId+UserId+CurrencyAmount`

| Endpoint | http://{hostname}/transaction/save | 
| --- | --- |
| Input | `{ "TransactionId" : <int>, "UserId" : <int>, "CurrencyAmount" : <int>, "Verifier" : <string> }` |
| Output | `{ "Success" : true }` |
| File | `src/Controller/Transaction.php` |

**Game Currency Transaction Query**

Returns basic details of transactions recorded for the User specified.

| Endpoint | http://{hostname}/transaction/load | 
| --- | --- |
| Input | `{ "UserId" : <int> }` |
| Output | `{ "UserId" : <int>, "TransactionCount" : <int>, "CurrencySum" : <int> }` |
| File | `src/Controller/Transaction.php` |

**User Data Save**

Storage for arbitrary JSON data for User. If any key inside storage already exists for the User, the value will be overridden by the passed up value; otherwise the data will be assumed to be unchanged.

| Endpoint | http://{hostname}/user/save | 
| --- | --- |
| Input | `{ "UserId" : <int>, "Data" : { <JSON> } }` |
| Output | `{ "Success" : true }` |
| File | `src/Controller/User.php` |

**User Data Load**

Returns an aggregation of all previous data stored for User.

| Endpoint | http://{hostname}/user/load | 
| --- | --- |
| Input | `{ "UserId" : <int> }` |
| Output | `{ <JSON> }` |
| File | `src/Controller/User.php` |


 

### License

This project is licensed under the MIT License. This means you can use and modify it for free in private or commercial projects.
