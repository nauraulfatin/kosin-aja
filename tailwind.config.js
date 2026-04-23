import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  // Tentukan di mana Tailwind akan mencari class CSS untuk diproses
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php', // Semua Blade template Laravel
  ],

  // Pengaturan tema dan perluasan font, warna, dll
  theme: {
    extend: {
      // Menambahkan font keluarga 'Figtree' untuk digunakan di seluruh aplikasi
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
      // Anda bisa menambahkan konfigurasi lainnya di sini
    },
  },

  // Daftar plugin yang digunakan oleh Tailwind CSS
  plugins: [forms], // Menggunakan plugin forms untuk styling form
};