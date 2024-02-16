document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const replyLinks = document.querySelectorAll('.reply-link');
    const replyForms = document.querySelectorAll('.reply-form');

    replyLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const commentId = this.getAttribute('data-comment-id');
            document.querySelectorAll('.reply-form').forEach(form => {
                form.style.display = 'none';
            });

            const replyForm = document.querySelector(`.reply-form[data-comment-id="${commentId}"]`);

            if (replyForm) {
                replyForm.style.display = 'block';
            }
        });
    });

    document.querySelectorAll(".like-button").forEach(button => {
        button.addEventListener('click', function () {
            console.log('Like button clicked!');

            const commentId = this.getAttribute('data-comment-id');
            const replyId = this.getAttribute('data-reply-id');

            const apiUrl = replyId ? `/api/like/reply/${replyId}` : `/api/like/comment/${commentId}`;

            fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': csrfToken,
                },
                body: JSON.stringify({
                    _token: csrfToken,
                }),
            })
            .then(response => {
                // Check if the response status is OK (status code 2xx)
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
            
                // Parse the JSON data from the response
                return response.json();
            })
            .then(data => {
                // Handle the parsed JSON data
                console.log(data);
            
                // Update the like count in the UI
                const likeCountSpan = this.nextElementSibling;
                const currentLikeCount = parseInt(likeCountSpan.innerText) || 0;
            
                this.classList.toggle('liked');
                likeCountSpan.innerText = this.classList.contains('liked') ? currentLikeCount + 1 : currentLikeCount - 1;
            })
            .catch(error => {
                // Handle any errors that occurred during the fetch
                console.error('Fetch error:', error);
            
                // Log the response text if available
                if (error instanceof SyntaxError && error.message.includes('JSON')) {
                    console.error('Response is not a valid JSON');
                } else {
                    console.error('Response Text:', error.message);
                }
            });
            
            
        });
    });

        // New code for submitting reply form
replyForms.forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const commentId = this.getAttribute('data-comment-id');
        const replyText = this.querySelector('textarea[name="reply_text"]').value;

        // Add logic to submit the reply to the server and store it in the database
        fetch(`/comments/${commentId}/replies`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': csrfToken,
            },
            body: JSON.stringify({
                reply_text: replyText,
                _token: csrfToken,
            }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Handle the server response if needed
            console.log(data);

            // Reload the page after successfully submitting a reply
            window.location.reload();
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });

        // Reset the form
        this.querySelector('textarea[name="reply_text"]').value = '';
        this.style.display = 'none';
    });
});

});

