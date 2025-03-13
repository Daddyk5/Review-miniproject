import './bootstrap'; // Laravel's default bootstrap (includes axios, etc.)
import Chart from 'chart.js/auto'; // For using Chart.js graphs
import Alpine from 'alpinejs'; // For Alpine.js dropdowns and other components

// Make them available globally
window.Chart = Chart;
window.Alpine = Alpine;

// Start Alpine.js
Alpine.start();
