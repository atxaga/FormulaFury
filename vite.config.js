import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

// Asegúrate de cargar las variables de entorno
import dotenv from 'dotenv';
dotenv.config();

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/js/app.jsx'],
      refresh: true,
    }),
    react(),
  ],
  server: {
    host: '0.0.0.0', 
    port: 5173,      
    hmr: {
      host: '10.14.0.235', 
      port: 5173,
    },
  },
  resolve: {
    alias: {
      '@': '/resources/js', 
    },
  },
});
