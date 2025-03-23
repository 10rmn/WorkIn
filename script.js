document.addEventListener('DOMContentLoaded', () => {
    console.log('Welcome to the Job Portal!');

    const heroButton = document.querySelector('.btn');
    heroButton.addEventListener('click', () => {
        window.location.href = 'jobs.html';
    });
});
