const bcrypt = require('bcryptjs');
const mysql = require('mysql');

// Setup MySQL connection
const db = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "safex"
});

// New user details
const email = 'dinalfernando43@gmail.com'; // Replace with the desired email
const password = 'Dinalfernando2005'; // Replace with the desired password

// Hash the password
bcrypt.hash(password, 10, (err, hashedPassword) => {
    if (err) {
        console.error('Error hashing password:', err);
        return;
    }

    // SQL query to insert new user
    const sql = "INSERT INTO Login (Username, Password) VALUES (?, ?)";
    db.query(sql, [email, hashedPassword], (dbErr, result) => {
        if (dbErr) {
            console.error('Error adding user:', dbErr);
            return;
        }
        console.log('User added successfully:', result);
        db.end(); // Close the database connection
    });
});
