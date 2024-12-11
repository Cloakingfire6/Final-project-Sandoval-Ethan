<?php
class RestaurantDatabase {
    private $host = "localhost";
    private $port = "3306";
    private $database = "restaurant_reservations";
    private $user = "root";
    private $password = "YourPassword";
    private $connection;
    private $connection;

    public function __construct($host, $username, $password, $database) {
        $this->connection = new mysqli($host, $username, $password, $database);

        if ($this->connection->connect_error) {
            die("Database connection failed: " . $this->connection->connect_error);
        }
    }

    public function closeConnection() {
        $this->connection->close();
    }

    public function addCustomer($customerName, $contactInfo) {
        $stmt = $this->connection->prepare(
            "INSERT INTO Customers (CustomerName, ContactInfo) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $CustomerName, $ContactInfo);

        if ($stmt->execute()) {
            return $this->connection->insert_id;
        } else {
            return false;
        }
    }

    public function addReservation($CustomerName, $ReservationTime, $NumberOfGuests, $SpecialRequests) {
        $CustomerId = $this->getCustomerIdByName($CustomerName);

        if (!$customerId) {
            $customerId = $this->addCustomer($CustomerName, null);
            if (!$CustomerId) {
                return false;
            }
        }
        $stmt = $this->connection->prepare(
            "INSERT INTO Reservations (CustomerId, ReservationTime, NumberOfGuests, SpecialRequests)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("isis", $CustomerId, $ReservationTime, $NumberOfGuests, $SpecialRequests);

        return $stmt->execute();
    }

    private function getCustomerIdByName($CustomerName) {
        $stmt = $this->connection->prepare(
            "SELECT CustomerId FROM Customers WHERE CustomerName = ?"
        );
        $stmt->bind_param("s", $CustomerName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['CustomerId'];
        } else {
            return false;
        }
    }

    public function viewReservations() {
        $query = "SELECT Reservations., Customers.CustomerName
                  FROM Reservations
                  JOIN Customers ON Reservations.CustomerId = Customers.CustomerId";
        $result = $this->connection->query($query);

        $reservations = [];
        while ($row = $result->fetch_assoc()) {
            $reservations[] = $row;
        }

        return $reservations;
    }

    public function getCustomerPreferences($customerId) {
        $stmt = $this->connection->prepare(
            "SELECT FROM DiningPreferences WHERE customerId = ?"
        );
        $stmt->bind_param("i", $CustomerId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function addSpecialRequest($ReservationId, $favoriteTable) {
        $stmt = $this->connection->prepare(
            "UPDATE Reservations SET specialRequests = ? WHERE reservationId = ?"
        );
        $stmt->bind_param("si", $requests, $reservationId);

        return $stmt->execute();
    }
}
?>
