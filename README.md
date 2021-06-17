<a href="https://github.com/rainzoneg/proyek-SBD/">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/61/HTML5_logo_and_wordmark.svg/180px-HTML5_logo_and_wordmark.svg.png" alt="HTML" title="HTML" align="right" height="90" />
</a>

# Money Management
[![Website shields.io](https://img.shields.io/website-up-down-green-red/http/shields.io.svg)](https://cow-7a.web.app/)
[![Website shields.io](https://img.shields.io/badge/made%20with-bootstrap-orange?&style=plastic)](https://cow-7a.web.app/)

## Created By
* Ronald Grant 1906355655

## About
Money Management's Website to note your income or outcome. Integrated with PostgreSQL database and made by HTML, CSS, and JavaSciprt, can help you managed your financial based on date and category. Equipped with SignIn and SignUp feature to ensure your safety.

## Requirement
1. [XAMPP Web Server](https://www.apachefriends.org/download.html)
2. [PostgreSQL](https://www.postgresql.org/download/)

## Import SQL
1. Open **Command Prompt** and **PostgreSQL**
2. In PostgreSQL, create database **moneymanagement** first and connect it with moneymanagement by using:
`CREATE DATABASE moneymanagement;`
`\c moneymanagement`
3. In Command Prompt, find **.sql** location file that already downloaded and type
`psql -U postgres -d moneymanagement -f db_moneymanagement.sql`
4. Database is ready to used.

## Used Database
Used Database is PostgreSQL, with specification:

*.) Database Name: **moneymanagement**

*.) Digunakan 4 tabel/relasi:

<img src="/assets/images/readme">]

- **User Table**

![image](https://raw.githubusercontent.com/dlanooor/money-management/main/assets/images/readme/user.jpg)

```SQL

```

- **Moneytable Table**

![image](https://raw.githubusercontent.com/dlanooor/money-management/main/assets/images/readme/moneytable.jpg)

```SQL
CREATE TABLE moneytable (
	id serial,
	transaction varchar(50) NOT NULL,
	amount bigint NOT NULL,
	date date,
	category varchar(15),
	inout varchar(8),
	email character varying(250)
);
```

## How To Start Web Application

1. Open **XAMPP** and start **Apache**
2. Create Account or Sign Up
3. Application is Ready To Used