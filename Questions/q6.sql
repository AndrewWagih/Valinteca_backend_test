SELECT CONCAT(first_name, ' ', last_name) AS full_name
FROM users
WHERE first_name LIKE 'A%';