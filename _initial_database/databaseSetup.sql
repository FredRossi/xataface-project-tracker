
DROP DATABASE IF EXISTS Tracker;
CREATE DATABASE Tracker;
USE Tracker;


CREATE TABLE IF NOT EXISTS LookupTypes
(
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	name VARCHAR(50),
	PRIMARY KEY (id)
);
INSERT INTO LookupTypes(name) VALUES ('ITEM STATUS');
INSERT INTO LookupTypes(name) VALUES ('DEV STATUS');
INSERT INTO LookupTypes(name) VALUES ('QA STATUS');
INSERT INTO LookupTypes(name) VALUES ('ACC STATUS');
INSERT INTO LookupTypes(name) VALUES ('PORTFOLIOS');
INSERT INTO LookupTypes(name) VALUES ('DEPARTMENTS');
INSERT INTO LookupTypes(name) VALUES ('COMPLEXITY');
INSERT INTO LookupTypes(name) VALUES ('PRIORITY');
INSERT INTO LookupTypes(name) VALUES ('ROLES');

CREATE TABLE IF NOT EXISTS LookupTable
(
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	name VARCHAR(50),
	description VARCHAR(50),
	lookup_type INT,
	PRIMARY KEY (id),
	FOREIGN KEY (lookup_type) REFERENCES LookupTypes(id)
);

CREATE VIEW ItemStatusTypes AS SELECT id, name, description FROM LookupTable WHERE lookup_type = 1;
CREATE VIEW DevStatusTypes AS SELECT id, name, description FROM LookupTable WHERE lookup_type = 2;
CREATE VIEW QAStatusTypes AS SELECT id, name, description FROM LookupTable WHERE lookup_type = 3;
CREATE VIEW ACCStatusTypes AS SELECT id, name, description FROM LookupTable WHERE lookup_type = 4;
CREATE VIEW Portfolios AS SELECT id, name, description FROM LookupTable WHERE lookup_type = 5;
CREATE VIEW Departments AS SELECT id, name, description FROM LookupTable WHERE lookup_type = 6;
CREATE VIEW Complexities AS SELECT id, name, description FROM LookupTable WHERE lookup_type = 7;
CREATE VIEW Priorities AS SELECT id, name, description FROM LookupTable WHERE lookup_type = 8;
CREATE VIEW Roles AS SELECT id, name, description FROM LookupTable WHERE lookup_type = 9;

INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Open','Item has been entered into the system and is awaiting action',1);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('In Progress','Work has started on the item',1);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Blocked','Work is blocked by forces outside Offshore''s control',1);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('On Hold','Further development has been put on hold by management',1);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('PH Qualified','Offshore work has completed',1);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('AU UAT','Work is currently undergoing UAT',1);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Complete','Item has been migrated',1);

INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Business Rule Design','',2);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Development','',2);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Documentation','',2);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Layouting','',2);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('PDF Generation','PDF generated for testing by developers and qa',2);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Peer Review','Item is being checked for completion by peers',2);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Requirements Analysis','Initial analysis of requirements and assets',2);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Test Data Creation','Create test data for QA',2);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Rework','Item has been tested but errors were found',2);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Complete','Development work is Complete',2);

INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Data Processing','',3);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Documentation','',3);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('PDF Output','',3);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('QA Checklist','',3);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Test Case and Planning','',3);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Test Data Creation','',3);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Complete','QA work is Complete',3);

INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Documentation','',4);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Asset Retrieval','',4);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Complete','No item issues being followed up',4);

INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Migration','',5);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Adhoc','',5);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Regular','',5);

INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Mailhouse','',6);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Reports','',6);

INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Simple','',7);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Medium','',7);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Complex','',7);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Very Complex','',7);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Extreme Complexity','',7);

INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Low','',8);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Medium','',8);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('High','',8);

INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Administrator','Super User',9);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Visitor','Read Only',9);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Portfolio Manager','',9);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Point of Contact','',9);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Developer','Update dev status, comment, attach files',9);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Quality Assurance','Update qa status, comment, attach files',9);
INSERT INTO LookupTable(name, description, lookup_type) VALUES ('Asset Collection Coordinator','',9);



CREATE TABLE IF NOT EXISTS Employees
(
    id INT NOT NULL UNIQUE AUTO_INCREMENT,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    email VARCHAR(150),
    personal_email VARCHAR(150),
    local_no VARCHAR(6),
    mobile_no VARCHAR(50),
    phone_no VARCHAR(12),
    street_address VARCHAR(150),
    city VARCHAR(50),
    skype_id VARCHAR(50),
    yahoo_id VARCHAR(50),
    domain_id VARCHAR(50),
    department INT,	
    PRIMARY KEY (id),
    FOREIGN KEY (department) REFERENCES LOOKUPTABLE(id)
);

INSERT INTO Employees(firstname, lastname, email, department) VALUES ('Erik Troy', 'Uy', 'erik.uy@semagroup.com.au',31);


CREATE TABLE IF NOT EXISTS Principals
(
    id INT NOT NULL UNIQUE AUTO_INCREMENT,
    username VARCHAR(50),
    password VARCHAR(50),    
    employee INT,
    role INT,     
    PRIMARY KEY (id),
    FOREIGN KEY (role) REFERENCES LOOKUPTABLE(id),
    FOREIGN KEY (employee) REFERENCES LOOKUPTABLE(id)
);

INSERT INTO Principals(username, password, employee, role) VALUES ('admin', 'admin', 1, 41);
INSERT INTO Principals(username, password, employee, role) VALUES ('visitor', 'visitor', 1, 42);
INSERT INTO Principals(username, password, employee, role) VALUES ('pm', 'pm', 1, 43);
INSERT INTO Principals(username, password, employee, role) VALUES ('poc', 'poc', 1, 44);
INSERT INTO Principals(username, password, employee, role) VALUES ('dev', 'dev', 1, 45);
INSERT INTO Principals(username, password, employee, role) VALUES ('qa', 'qa', 1, 46);
INSERT INTO Principals(username, password, employee, role) VALUES ('acc', 'acc', 1, 47);


CREATE TABLE IF NOT EXISTS Iterations
(
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	name VARCHAR(20) UNIQUE,
	description VARCHAR(50),
	kickoff_date DATE,
	PRIMARY KEY (id)
);


CREATE TABLE IF NOT EXISTS Items
(
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	landesk_number INT,
	portfolio INT,
	client_name VARCHAR(30),
	system_name VARCHAR(30),
	csr VARCHAR(50),
	sme VARCHAR(50),
	complexity INT,
	priority INT,
	item_status INT,
	iteration INT,
  target_date DATE,
  created_date DATE,
  landesk_created_date DATE,
  completion_date DATE,  
	assigned_acc INT,
	PRIMARY KEY (id),
	FOREIGN KEY (portfolio) REFERENCES LOOKUPTABLE(id),
	FOREIGN KEY (complexity) REFERENCES LOOKUPTABLE(id),
	FOREIGN KEY (priority) REFERENCES LOOKUPTABLE(id),
	FOREIGN KEY (item_status) REFERENCES LOOKUPTABLE(id),
	FOREIGN KEY (assigned_acc) REFERENCES Employees(id)
);

CREATE TABLE IF NOT EXISTS ItemTasks
(
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	item INT,
	description VARCHAR(50),
	assigned_dev INT,
	assigned_qa INT,
	estimated_dev_hours DECIMAL(6,2),
	estimated_qa_hours DECIMAL(6,2),
  dev_hours_spent DECIMAL(6,2),
  qa_hours_spent DECIMAL(6,2),
  dev_status INT,
	qa_status INT,	
	acc_status INT,	
	PRIMARY KEY (id),
	FOREIGN KEY (item) REFERENCES Items(id),
	FOREIGN KEY (dev_status) REFERENCES LOOKUPTABLE(id),
	FOREIGN KEY (qa_status) REFERENCES LOOKUPTABLE(id),
	FOREIGN KEY (acc_status) REFERENCES LOOKUPTABLE(id),
	FOREIGN KEY (assigned_dev) REFERENCES Employees(id),
	FOREIGN KEY (assigned_qa) REFERENCES Employees(id)
);

#CREATE TABLE IF NOT EXISTS MailingLists
#(
#  id INT NOT NULL UNIQUE AUTO_INCREMENT,
#  name VARCHAR(50),
#  PRIMARY KEY (id) 
#);

#CREATE TABLE IF NOT EXISTS MailingListMembers
#(
#  id INT NOT NULL UNIQUE AUTO_INCREMENT,  
#  employee INT,
#  mailing_list INT,
#  PRIMARY KEY (id),
#  FOREIGN KEY (mailing_list) REFERENCES MailingLists(id),
#  FOREIGN KEY (employee) REFERENCES Employees(id)
#);

#CREATE VIEW DevCompleteItems AS SELECT items.* FROM items INNER JOIN itemtasks ON items.id = itemtasks.item WHERE dev_status = (SELECT id FROM devstatustypes WHERE name='Complete' );
#CREATE VIEW QACompleteItems AS SELECT items.* FROM items INNER JOIN itemtasks ON items.id = itemtasks.item WHERE qa_status = (SELECT id FROM qastatustypes WHERE name='Complete' );
#CREATE VIEW CompletedItems AS SELECT items.* FROM items WHERE item_status = (SELECT id FROM itemstatustypes WHERE name='Complete' );
#CREATE VIEW UnassignedItems AS SELECT id, name, description FROM LookupTable WHERE lookup_type = 1;
#CREATE VIEW ItemsCompleted AS SELECT id, name, description FROM LookupTable WHERE lookup_type = 1;
#CREATE VIEW ItemsInQA AS SELECT id, name, description FROM LookupTable WHERE lookup_type = 1;

#DROP VIEW EfficiencyByDeveloperAndIteration;
CREATE VIEW EfficiencyByDeveloperAndIteration AS
    SELECT
        concat_ws('',itemtasks.assigned_dev, ':',  items.iteration) AS id,
        (SELECT concat_ws('',e.lastname,', ',e.firstname) FROM employees AS e WHERE id = itemtasks.assigned_dev) AS employee, 
        (SELECT department FROM employees e WHERE e.id = itemtasks.assigned_dev) AS department, 
        items.iteration AS Iteration,
        SUM(dev_hours_spent) AS HoursSpent, 
        SUM(estimated_dev_hours) AS EstimatedHours, 
        (SUM(estimated_dev_hours)/SUM(dev_hours_spent)) AS Efficiency        
        FROM itemtasks as itemtasks        
        INNER JOIN items ON items.id = itemtasks.item        
        WHERE itemtasks.dev_status = (SELECT id FROM DevStatusTypes WHERE name='Complete')
        GROUP BY assigned_dev, items.iteration ;
        
#DROP VIEW GMCMigrationJobStatus;
CREATE VIEW GMCMigrationJobStatus AS
SELECT
        items.item_status AS id,        
        (SELECT name FROM ItemStatusTypes WHERE id = items.item_status) AS itemstatus,
        items.portfolio,        
        count(id) as count        
        FROM items
        WHERE items.portfolio = (SELECT id FROM portfolios WHERE name='Migration')
            AND NOT items.item_status = (SELECT id FROM ItemStatusTypes WHERE name='Complete')
        GROUP BY items.item_status ;
        
#DROP VIEW PortfolioJobAllocation;      
CREATE VIEW PortfolioJobAllocation AS
SELECT
        portfolio AS id,        
        items.portfolio,
        count(id) as count
        FROM items
        WHERE NOT items.item_status = (SELECT id FROM ItemStatusTypes WHERE name='Complete')
        GROUP BY items.portfolio;
        
#DROP VIEW CompletedItemsCountByClient;
CREATE VIEW CompletedItemsCountByClient AS
SELECT
        items.client_name AS id,        
        items.client_name,
        items.portfolio,
        count(id) as count        
        FROM items
        WHERE items.item_status = (SELECT id FROM ItemStatusTypes WHERE name='Complete')
        GROUP BY items.iteration, items.client_name ;
        
        
        
#CREATE VIEW EfficiencyByQA AS SELECT id, name, description FROM LookupTable WHERE lookup_type = 1;
#CREATE VIEW EfficiencyByResource AS SELECT id, name, description FROM LookupTable WHERE lookup_type = 1;

