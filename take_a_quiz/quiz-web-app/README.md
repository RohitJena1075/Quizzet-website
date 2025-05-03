# Quiz Web Application

## Overview
This project is a responsive quiz web application that fetches live multiple-choice questions from an API. It features a user-friendly interface with a categories menu, a home link, and a result popup after quiz submission. The application is built with a PHP backend and a JavaScript frontend.

## Features
- Fetches live multiple-choice questions based on categories.
- Responsive design for optimal viewing on various devices.
- User-friendly navigation with a sidebar menu.
- Result popup displaying the user's score and feedback after submission.
- Home link that redirects to the main quiz page.

## Project Structure
```
quiz-web-app
├── backend
│   ├── api
│   │   ├── fetch_questions.php
│   │   └── submit_answers.php
│   └── db
│       └── connection.php
├── public
│   ├── css
│   │   └── styles.css
│   ├── js
│   │   └── app.js
│   ├── take_a_quiz.html
│   ├── index.html
│   └── result_popup.html
├── README.md
└── .gitignore
```

## Setup Instructions
1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   cd quiz-web-app
   ```

2. **Set Up the Database**
   - Create a database and import the necessary schema for storing quiz questions and answers.

3. **Configure Database Connection**
   - Update the `connection.php` file in the `backend/db` directory with your database credentials.

4. **Run the Application**
   - Ensure your PHP server is running.
   - Access the application via your web browser at `http://localhost/quiz-web-app/public/index.html`.

## Usage
- Navigate to the home page to select a quiz category.
- Start the quiz and answer the questions.
- Submit your answers to view your score in the result popup.

## Technologies Used
- PHP for backend development.
- MySQL for database management.
- HTML, CSS, and JavaScript for frontend development.

## License
This project is licensed under the MIT License. See the LICENSE file for more details.