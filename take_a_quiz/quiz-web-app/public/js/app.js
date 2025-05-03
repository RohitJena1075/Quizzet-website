// JavaScript logic for the quiz application

document.addEventListener("DOMContentLoaded", () => {
    const quizContainer = document.querySelector(".quiz-container");
    const timerElement = document.getElementById("time-left");
    const resultPopup = document.getElementById("result-popup");
    const resultMessage = document.getElementById("result-message");
    const submitButton = document.getElementById("submit-btn");
    let timeLeft = 1800; // 30 minutes
    let currentQuestionIndex = 0;
    let questions = [];
    let userAnswers = [];

    // Fetch questions from the API
    async function fetchQuestions() {
        const response = await fetch('/api/fetch_questions.php');
        questions = await response.json();
        loadQuestion();
        startTimer();
    }

    // Load the current question
    function loadQuestion() {
        const question = questions[currentQuestionIndex];
        document.getElementById("question").innerText = `${currentQuestionIndex + 1}. ${question.question}`;
        const optionsContainer = document.querySelector(".options");
        optionsContainer.innerHTML = "";
        question.options.forEach((option, index) => {
            optionsContainer.innerHTML += `<label class="option"><input type="radio" name="q${currentQuestionIndex}" value="${option}"> ${option}</label>`;
        });
        updateProgressBar();
    }

    // Update the progress bar
    function updateProgressBar() {
        const progress = ((currentQuestionIndex + 1) / questions.length) * 100;
        document.querySelector(".progress").style.width = `${progress}%`;
    }

    // Start the timer
    function startTimer() {
        const timer = setInterval(() => {
            timeLeft--;
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            timerElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            if (timeLeft <= 0) {
                clearInterval(timer);
                alert("Time's up!");
                submitQuiz();
            }
        }, 1000);
    }

    // Handle next and previous question navigation
    document.getElementById("next-btn").addEventListener("click", () => {
        if (currentQuestionIndex < questions.length - 1) {
            currentQuestionIndex++;
            loadQuestion();
        }
    });

    document.getElementById("prev-btn").addEventListener("click", () => {
        if (currentQuestionIndex > 0) {
            currentQuestionIndex--;
            loadQuestion();
        }
    });

    // Submit the quiz
    submitButton.addEventListener("click", submitQuiz);

    async function submitQuiz() {
        const answers = {};
        questions.forEach((question, index) => {
            const selectedOption = document.querySelector(`input[name="q${index}"]:checked`);
            answers[`q${index}`] = selectedOption ? selectedOption.value : null;
        });

        const response = await fetch('/api/submit_answers.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(answers)
        });

        const result = await response.json();
        showResult(result);
    }

    // Show the result in a popup
    function showResult(result) {
        resultMessage.innerText = `Your score: ${result.score} out of ${questions.length}`;
        resultPopup.style.display = "block";
    }

    // Close the result popup
    document.getElementById("close-popup").addEventListener("click", () => {
        resultPopup.style.display = "none";
    });

    // Initialize the quiz
    fetchQuestions();
});