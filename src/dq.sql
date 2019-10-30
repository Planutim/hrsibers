

  -- INSERT INTO users(UID, login, password, firstName, lastName, sex, birthdate) 
  --       VALUES( 1234, 'test', '1234', 'vasya', 'pupkin', 'female', '1996-01-01');

  CREATE TABLE IF NOT EXISTS Admins (
    id INT AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL;
  )