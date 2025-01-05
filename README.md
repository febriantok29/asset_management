# Asset Management System

## Overview

This project is an Asset Management System designed to help organizations manage their assets efficiently. It provides features for tracking, maintaining, and reporting on assets.

## Table of Contents

-   [Overview](#overview)
-   [Table of Contents](#table-of-contents)
-   [Features](#features)
-   [Installation](#installation)
-   [Usage](#usage)
-   [Contributing](#contributing)
-   [License](#license)
-   [Acknowledgements](#acknowledgements)

## Features

-   Asset tracking
-   Maintenance scheduling
-   Reporting and analytics
-   User management
-   Role-based access control

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/febriantok29/asset_management.git
    ```
2. Navigate to the project directory:
    ```bash
    cd asset_management
    ```
3. Install dependencies:
    ```bash
    composer install
    ```
4. Set up the environment file:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
5. Set up the database:
    ```bash
    php artisan migrate
    ```

## Usage

To start the development server, run:

```bash
php artisan serve
```

Then, open your browser and navigate to `http://localhost:8000`.

## Contributing

Contributions are welcome! Please fork the repository and create a pull request with your changes. Ensure your code follows the project's coding standards and includes appropriate tests.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.

## Acknowledgements

This project was built for the "Final Exam of the 5th semester, Informatics Engineering" course "Advanced Web Programming" taught by Mr. Muchamad Sandy, S.Kom., M.M.SI. It was completed by Group 3, with members:
| Name                  | Student ID    |
|-----------------------|---------------|
| Fadel Muhamad Rifai   | 411221027     |
| Febrianto Kabisatullah| 411221029     |
| Aprianti Nuban        | 411221174     |

This project was developed at Universitas Dian Nusantara, for the academic year 2024/2025, during the first semester.
