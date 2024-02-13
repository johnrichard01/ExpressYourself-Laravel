document.addEventListener('DOMContentLoaded', function () {
    // Get the comment form and add a submit event listener
    var commentForm = document.getElementById('commentForm');
    if (commentForm) {
        commentForm.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Get the comment body from the text area
            var commentBody = document.getElementById('commentBody').value;

            // Assuming you have the blogId available dynamically
            var blogId = getBlogIdDynamically(); // Replace this with your logic to get the blogId

            // Make an AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/blogs/' + blogId + '/comments', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', "{{ csrf_token() }}"); // Include CSRF token

            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    // Handle success (update the UI, show a message, etc.)
                    console.log(xhr.responseText);
                    // You can update the UI with the new comment without reloading the page
                } else {
                    // Handle error (show an error message, log the error, etc.)
                    console.error(xhr.statusText);
                }
            };

            // Example data to send with the POST request (adjust as needed)
            var postData = {
                body: commentBody,
            };

            // Convert the data to JSON format
            var jsonData = JSON.stringify(postData);

            // Send the request with the comment body
            xhr.send(jsonData);
        });
    }
});

