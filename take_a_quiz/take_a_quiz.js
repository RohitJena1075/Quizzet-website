// Fetch questions from the API
fetch('/take_a_quiz/api/fetch_questions.php')
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            console.log('Questions:', data.questions);
            // Render questions on the page
        } else {
            console.error('Error fetching questions:', data.message);
        }
    })
    .catch(error => console.error('Fetch error:', error));

// Submit quiz results
function submitResults(username, score) {
    fetch('/api/submit_results.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, score }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Results submitted successfully!');
            } else {
                console.error('Error submitting results:', data.message);
            }
        })
        .catch(error => console.error('Submission error:', error));
}

