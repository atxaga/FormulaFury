import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createRoot } from 'react-dom/client';

const appName = 'FormulaFury';

createInertiaApp({
    title: (title) => `${title} ${appName}`,
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.jsx'); 
        const match = pages[`./Pages/${name}.jsx`]; 
    
        if (!match) {
            console.error(`⚠️ Error: No se encontró el componente "${name}".`);
            throw new Error(`Componente no encontrado: ${name}`);
        }
    
        return match().then((module) => module.default);
    },
    setup({ el, App, props }) {
        const root = createRoot(el);

        root.render(<App {...props} />);
    },
    progress: {
        color: '#4B5563',
    },
});
