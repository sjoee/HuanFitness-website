document.addEventListener('DOMContentLoaded', function() {
    const loginBtn = document.getElementById('loginBtn');
    const registerBtn = document.getElementById('registerBtn');
    const loginSection = document.getElementById('login');
    const registerSection = document.getElementById('register');
    const dashboardSection = document.getElementById('dashboard');

    loginBtn.addEventListener('click', function(e) {
        e.preventDefault();
        loginSection.classList.toggle('hidden');
        registerSection.classList.add('hidden');
    });

    registerBtn.addEventListener('click', function(e) {
        e.preventDefault();
        registerSection.classList.toggle('hidden');
        loginSection.classList.add('hidden');
    });

    // Form submission handling
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const weightForm = document.getElementById('weightForm');
    const exerciseForm = document.getElementById('exerciseForm');
    const waterForm = document.getElementById('waterForm');
    const nutritionistForm = document.getElementById('nutritionistForm');

    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Here you would typically send a request to your server to authenticate the user
        console.log('Login form submitted');
        dashboardSection.classList.remove('hidden');
    });

    registerForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Here you would typically send a request to your server to register the user
        console.log('Register form submitted');
    });

    weightForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Here you would typically send the weight data to your server
        console.log('Weight logged');
    });

    exerciseForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Here you would typically send the exercise data to your server
        console.log('Exercise logged');
    });

    waterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Here you would typically send the water consumption data to your server
        console.log('Water consumption logged');
    });

    nutritionistForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Here you would typically send the nutritionist consultation request to your server
        console.log('Nutritionist consultation requested');
    });
});
