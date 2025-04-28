1.Add a New Member
2.Add General loan
3.Add Special loan
4.Add Extra paid amount
5.Display all the members info
6.Payments Reciept or information
7.display loan balance of all
8.update member information
9.Delete a  member
loan takers information
Balance sheet
12.Create file for next month
13.view previous records
14.exit.


CREATE TABLE members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    mobile VARCHAR(15),
    address TEXT,
    join_date DATE DEFAULT CURRENT_DATE,
    status ENUM('Active', 'Inactive') DEFAULT 'Active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
REATE TABLE loans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT NOT NULL,
    loan_type ENUM('General', 'Special'.'fine') DEFAULT 'General',
    amount DECIMAL(10,2) NOT NULL,
    interest_rate DECIMAL(5,2) DEFAULT 0.00,
    term_months INT DEFAULT 12,
    start_date DATE DEFAULT CURRENT_DATE,
    status ENUM('Ongoing', 'Closed') DEFAULT 'Ongoing',
    FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE
);

CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT NOT NULL,
    loan_id INT,
    paid_amount DECIMAL(10,2) NOT NULL,
    payment_date DATE DEFAULT CURRENT_DATE,
    payment_mode ENUM('Cash', 'Online') DEFAULT 'Cash',
    remarks TEXT,
    FOREIGN KEY (member_id) REFERENCES members(id),
    FOREIGN KEY (loan_id) REFERENCES loans(id)
);

CREATE TABLE extra_payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    date DATE DEFAULT CURRENT_DATE,
    note TEXT,
    FOREIGN KEY (member_id) REFERENCES members(id)
);

CREATE TABLE monthly_files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    month_year VARCHAR(10), -- format like '04-2025'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);