import Alpine from 'alpinejs';
import { tiptapEditor } from './tiptap-editor.js';
import Chart from 'chart.js/auto';
import { moodPage } from './mood-page.js';
import { dashboardPage } from './dashboard-page.js';

window.Alpine = Alpine;
window.tiptapEditor = tiptapEditor;
window.Chart = Chart;

Alpine.data('moodPage', moodPage);
Alpine.data('dashboardPage', dashboardPage);

Alpine.start();


