document.addEventListener("DOMContentLoaded", function() {
    const questions = document.querySelectorAll(".question");

    questions.forEach(function(question) {
        question.addEventListener("click", function() {
            const answer = this.nextElementSibling;
            if (answer.classList.contains("visible")) {
                answer.classList.remove("visible");
            } else {
                answer.classList.add("visible");
            }
        });
    });
});