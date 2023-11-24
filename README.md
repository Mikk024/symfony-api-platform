
# Symfony API Platform Project

## Setup Instructions

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/Mikk024/symfony-api-platform.git
   
2. **Install Dependencies:**
   ```bash
   composer install
3. **Setup database:**
    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate

4. **Serve project**
    ```bash
    symfony server:start


## API Endpoints

### 1. Create a New Job Application
- **Endpoint:** POST /api/job_applications
- **Description:** Create a new job application.
- **Request Body:** {
    
    "firstName": "John",
    
    "lastName": "Doe",
    
    "email": "john.doe@example.com",
    
    "phoneNumber": 123456789,

    "expectedSalary": 8000,
    
    }

### 2. Get Job Application by ID
- **Endpoint:** GET /api/job_applications/{id}
- **Description:**  Retrieve details of a job application by ID.

### 3. Get Collection of New Job Applications
- **Endpoint:** GET /api/job_applications/new
- **Description:**  Retrieve a collection of new job applications.

### 4. Get Collection of Displayed Job Applications
- **Endpoint:** GET /api/job_applications/displayed
- **Description:**  Retrieve a collection of displayed job applications.

### 4. Get Collection of all Job Applications
- **Endpoint:** GET /api/job_applications
- **Description:**  Retrieve a collection of all job applications.

## Validation
- All fields are validated before saving the job application.

## Automatic Level Assignment
  The level field is automatically assigned based on the expected salary:
 - Below 5,000: Junior
 - 5,000 - 9,999: Regular
 - 10,000 and above: Senior


