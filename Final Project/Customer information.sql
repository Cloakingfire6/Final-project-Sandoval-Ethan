INSERT INTO Customers (customerName, contactInfo) VALUES ('Bobby Darude', 'Bobby.Darude@email.com');
INSERT INTO Customers (customerName, contactInfo) VALUES ('Wesson Smith', 'Wesson.Smith@email.com');
INSERT INTO Customers (customerName, contactInfo) VALUES ('Adam Smash', 'Adam.Smash@mail.com');

INSERT INTO Reservations (customerId, reservationTime, numberOfGuests, specialRequests)
VALUES (1, '2025-1-12 10:00:00', 4, 'Birthday celebration');
INSERT INTO Reservations (customerId, reservationTime, numberOfGuests, specialRequests)
VALUES (2, '2024-12-25 08:00:00', 2, 'Window seat');
INSERT INTO Reservations (customerId, reservationTime, numberOfGuests, specialRequests)
VALUES (3, '2024-12-11 05:30:00', 3, 'Vegetarian menu');

INSERT INTO DiningPreferences (customerId, favoriteTable, dietaryRestrictions)
VALUES (1, 'Table 5', 'Shellfish Allergy');
INSERT INTO DiningPreferences (customerId, favoriteTable, dietaryRestrictions)
VALUES (2, 'Table 10', 'Gluten-free');
INSERT INTO DiningPreferences (customerId, favoriteTable, dietaryRestrictions)
VALUES (3, 'Table 3', 'Vegetarian');