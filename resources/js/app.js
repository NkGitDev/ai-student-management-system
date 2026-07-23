// resources/js/app.js
import './bootstrap';
import '../css/app.css';


// Sidebar toggle
// function toggleSidebar() {
//             const sidebar = document.querySelector('#sidebar');
//             sidebar.classList.toggle('collapsed');
//         }


// Theme toggle 

// Function to set theme
    function setTheme(theme) {
        document.documentElement.setAttribute('data-bs-theme', theme);
        localStorage.setItem('theme', theme);
        document.body.className = theme + '-theme'; // e.g., 'light-theme' ya 'dark-theme'
        updateIcon(theme);
    }

    // Function to update icon
    function updateIcon(theme) {
        const icon = document.getElementById('theme-icon');
        if (theme === 'light') {
            icon.className = 'bi bi-sun-fill'; // Light mode icon
        } else {
            icon.className = 'bi bi-moon-fill'; // Dark mode icon
        }
    }

    // Event listener for toggle button
    document.getElementById('theme-toggle').addEventListener('click', () => {
        const currentTheme = localStorage.getItem('theme') || 'light';
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        setTheme(newTheme);
    });

    // Apply saved theme on page load
    window.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);
    });

