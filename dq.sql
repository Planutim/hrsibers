CREATE TABLE IF NOT EXISTS users(
  id int(10) AUTO_INCREMENT,
  login VARCHAR(50) NOT NULL,
  password BINARY(60) NOT NULL,
  firstName VARCHAR(50) NOT NULL,
  lastName VARCHAR(50) NOT NULL,
  sex ENUM("male","female") NOT NULL,
  birthDate DATE NOT NULL,
  PRIMARY KEY(id)
)
