function toggleAnswer(answerId) {
    const answer = document.getElementById(answerId);
    if (answer.style.display === "none" || answer.style.display === "") {
        answer.style.display = "block";
    } else {
        answer.style.display = "none";
    }
}
