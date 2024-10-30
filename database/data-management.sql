CREATE TABLE IF NOT EXISTS water_management (
    id INT PRIMARY KEY AUTO_INCREMENT,
    uid INT,
    Cdate DATE,
    water_consumed DECIMAL(5,2),
    FOREIGN KEY (uid) REFERENCES tbluser(id)
);

CREATE TABLE IF NOT EXISTS weight_management (
    id INT PRIMARY KEY AUTO_INCREMENT,
    uid INT,
    Wdate DATE,
    weightKG DECIMAL(5,2),
    FOREIGN KEY (uid) REFERENCES tbluser(id)
);

CREATE TABLE IF NOT EXISTS exercise_management (
    id INT PRIMARY KEY AUTO_INCREMENT,
    uid INT,
    Edate DATE,
    exercise_type VARCHAR(255),
    FOREIGN KEY (uid) REFERENCES tbluser(id)
);
