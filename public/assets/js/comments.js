document.addEventListener('DOMContentLoaded', function () {
    const replyLinks = document.querySelectorAll('.reply-link');

    replyLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const commentId = this.getAttribute('data-comment-id');
            const parentReplyId = this.getAttribute('data-parent-reply-id');

            // Hide all reply forms
            document.querySelectorAll('.nested-reply-form, .reply-form').forEach(form => {
                form.style.display = 'none';
            });

            let replyForm;

            if (parentReplyId) {
                // If there is a parent reply id, select the nested reply form
                replyForm = document.querySelector(`.nested-reply-form[data-comment-id="${commentId}"][data-parent-reply-id="${parentReplyId}"]`);
            } else {
                // If there is no parent reply id, use data-parent-reply-id="0" for the main reply form
                replyForm = document.querySelector(`.reply-form[data-comment-id="${commentId}"][data-parent-reply-id="0"]`);
            }

            if (replyForm) {
                // Toggle the display of the reply form
                replyForm.style.display = (replyForm.style.display === 'none') ? 'block' : 'none';
            }
        });
    });
});




